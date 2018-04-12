<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    function index(Request $request) {
        $isAssociation = false;

        if($request->session()->exists('association') && 1 == $request->session()->get('association.member_is_role')) {
            $isAssociation = true;
        }


        $pageTitle = __('messages.initiatives_page_title');
        $metaDescription = __('messages.initiatives_page_meta_description');
        $heading1 = __('messages.home_heading_1');
        $heading2 = __('messages.home_heading_2');
        $heading3 = __('messages.home_heading_3');
        $text1 = __('messages.home_text_1');
        $text2 = __('messages.home_text_2');
        $text3 = __('messages.home_text_3');
        $link1 = __('messages.home_link_1');
        $link2 = __('messages.home_link_2');
        $link3 = __('messages.home_link_3');


        return view('home.index')
            ->with('pageTitle', $pageTitle)
            ->with('metaDescription', $metaDescription)
            ->with('heading1', $heading1)
            ->with('heading2', $heading2)
            ->with('heading3', $heading3)
            ->with('text1', $text1)
            ->with('text2', $text2)
            ->with('text3', $text3)
            ->with('link1', $link1)
            ->with('link2', $link2)
            ->with('link3', $link3)
            ->with('isAssociation', $isAssociation);
    }
}
