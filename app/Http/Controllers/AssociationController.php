<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use App\Association;
use App\AssociationImage;

class AssociationController extends Controller
{
    function associations()
    {
        $pageTitle = __('messages.associations_page_title');
        $metaDescription = __('messages.associations_page_meta_description');
        $heading1 = __('messages.associations_heading_1');
        $heading2 = __('messages.associations_heading_2');
        $detailsBtn = __('messages.associations_btn_1');
        $editBtn = __('messages.form_edit_btn');
        $closeBtn = __('messages.close');
        $noRecordsMsg = __('messages.associations_msg_1');


        //$associations = association::where('is_published', 1)->get()->sortBy('title');
        $associations = association::where('is_published', 1)->orderBy('title', 'asc')->paginate(10);


        return view('associations.associations')
            ->with('pageTitle', $pageTitle)
            ->with('metaDescription', $metaDescription)
            ->with('heading1', $heading1)
            ->with('heading2', $heading2)
            ->with('detailsBtn', $detailsBtn)
            ->with('editBtn', $editBtn)
            ->with('closeBtn', $closeBtn)
            ->with('noRecordsMsg', $noRecordsMsg)
            ->with('associations', $associations);
    }

    function associationForm()
    {
        $pageTitle = __('messages.association_form_page_title');
        $metaDescription = __('messages.association_form_page_meta_description');
        $associationFormHeading1 = __('messages.association_form_heading_1');
        $titleLbl = __('messages.form_title_lbl');
        $titlePldr = __('messages.form_title_pldr');
        $descriptionLbl = __('messages.form_descr_lbl');
        $descriptionPldr = __('messages.form_descr_pldr');
        $phoneLbl = __('messages.form_phone_lbl');
        $phonePldr = __('messages.form_phone_pldr');
        $phone2Lbl = __('messages.form_phone_2_lbl');
        $phone2Pldr = __('messages.form_phone_2_pldr');
        $websiteLbl = __('messages.form_website_lbl');
        $websitePldr = __('messages.form_website_pldr');
        $emailLbl = __('messages.form_email_lbl');
        $emailPldr = __('messages.form_email_pldr');
        $imageUploadFileSizeMsg = __('messages.form_image_msg_1');
        $imageUploadErrorMsg = __('messages.form_image_msg_2');
        $imageUploadFileTypeMsg = __('messages.form_image_msg_3');
        $imageUploadFileNumberMsg = __('messages.form_image_msg_4');
        $removeImageBtn = __('messages.form_remove_btn');
        $saveBtn = __('messages.form_save_btn');
        $cancelBtn = __('messages.form_cancel_btn');


        return view('associations.association-form')
            ->with('pageTitle', $pageTitle)
            ->with('metaDescription', $metaDescription)
            ->with('associationFormHeading1', $associationFormHeading1)
            ->with('titleLbl', $titleLbl)
            ->with('titlePldr', $titlePldr)
            ->with('descriptionLbl', $descriptionLbl)
            ->with('descriptionPldr', $descriptionPldr)
            ->with('phoneLbl', $phoneLbl)
            ->with('phonePldr', $phonePldr)
            ->with('phone2Lbl', $phone2Lbl)
            ->with('phone2Pldr', $phone2Pldr)
            ->with('websiteLbl', $websiteLbl)
            ->with('websitePldr', $websitePldr)
            ->with('emailLbl', $emailLbl)
            ->with('emailPldr', $emailPldr)
            ->with('imageUploadFileSizeMsg', $imageUploadFileSizeMsg)
            ->with('imageUploadErrorMsg', $imageUploadErrorMsg)
            ->with('imageUploadFileTypeMsg', $imageUploadFileTypeMsg)
            ->with('imageUploadFileNumberMsg', $imageUploadFileNumberMsg)
            ->with('removeImageBtn', $removeImageBtn)
            ->with('saveBtn', $saveBtn)
            ->with('cancelBtn', $cancelBtn);
    }

    function storeAssociation(Request $request)
    {
        $rules = array();
        $title = $request->input('title');
        $phone = $request->input('phone');
        $phone2 = $request->input('phone_2');
        $email = $request->input('email');
        $website = $request->input('website');
        $description = $request->input('description');
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        $address = $request->input('address');
        $inputMapData = $request->input('input_map_data');
        $lastInsertedId = null;


        $messages = [
            'required' => __('messages.association_form_error.required')
        ];

        
        $rules['title'] = 'required|max:255';
        $rules['phone'] = 'required|max:20';
        if(!empty($phone2)) {
            $rules['phone_2'] = 'required|max:20';
        }
        $rules['email'] = 'required|email';
        $rules['website'] = 'active_url';
        if(!empty($website)) {
            $rules['website'] = ['regex:/^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/'];
        }
        $rules['description'] = 'required';
        $rules['latitude'] = 'required|numeric';
        $rules['longitude'] = 'required|numeric';
        $rules['address'] = 'required|max:255';

        

        $validator = Validator::make($request->all(), $rules);


        if($validator->fails()) {
            // $err = $validator->messages();

            return response()->json([
                'errors' => $validator->messages()
            ]);
        }
        else {
            $association = new Association(
                ['title' => $title,
                 'phone_1' => $phone,
                 'phone_2' => $phone2,
                 'email' => $email,
                 'website' => $website,
                 'description' => $description,
                 'latitude' => $latitude,
                 'longitude' => $longitude,
                 'address' => $address,
                 'is_published' => 0,
                 'input_map_data' => $inputMapData,
                 'created_at' => date('Y-m-d H:i:s')
                ]);


            $isInserted = $association->save();

            if($isInserted) {
                $lastInsertedId = $association->id;
            }
        }


        return response()->json([
            'assocId' => $lastInsertedId,
            'message' => __('messages.association_form_success.stored')
        ]);
    }

    function imageUpload(Request $request)
	{
        $association = new Association();
        $associationId = $request->input('assocId');
        $images = array();


        if($request->hasFile('files')) {
            $files = $request->file('files');
            
            foreach($files as $file) {
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $picture = sha1($filename . time()) . '.' . $extension;
                $destinationPath = storage_path() . '/app/public/associations/';
                $file->move($destinationPath, $picture);
                $destinationUrl = env('APP_URL').'/storage/associations/';
                
                // Add image urls to array
                $images[] = $picture;


                $associationImage = new AssociationImage(
                    ['name' => $picture,
                     'url' => $destinationUrl.$picture,
                     'size' => $this->getFileSize($destinationPath.$picture),
                     'created_at' => date('Y-m-d H:i:s')
                    ]);

                $isInserted = $association->find($associationId)->images()->save($associationImage);
            }

            return response()->json([
                'files' => $images,
                'message' => __('messages.association_form_success.stored')
            ]);
		}
    }
    
    function getFileSize($filePath, $clearStatCache = false)
    {
		if($clearStatCache) {
			if (version_compare(PHP_VERSION, '5.3.0') >= 0) {
				clearstatcache(true, $filePath);
			} else {
				clearstatcache();
			}
		}

		return $this->fixIntegerOverflow(filesize($filePath));
	}

    function fixIntegerOverflow($size)
    {
		if ($size < 0) {
			$size += 2.0 * (PHP_INT_MAX + 1);
		}
        
		return $size;
	}
}
