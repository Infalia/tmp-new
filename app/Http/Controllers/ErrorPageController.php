<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\User;

class ErrorPageController extends Controller
{
    function page404()
    {
        $user = User::find(Auth::id());
        $route = Route::current();

        $sidebarOption1 = __('messages.sidebar_option_1');
        $sidebarOption2 = __('messages.sidebar_option_2');
        $sidebarOption3 = __('messages.sidebar_option_3');
        $sidebarOption4 = __('messages.sidebar_option_4');
        $sidebarOption5 = __('messages.sidebar_option_5');
        $sidebarOption6 = __('messages.sidebar_option_6');
        $sidebarOption7 = __('messages.sidebar_option_7');
        $sidebarOption8 = __('messages.sidebar_option_8');


        $pageTitle = __('messages.404_page_title');
        $metaDescription = __('messages.404_page_meta_description');
        $profileBasicHeading1 = __('messages.404_heading_1');
        $pageBodyText1 = __('messages.404_text_1');
        

        return view('error_pages.404')
            ->with('sidebarOption1', $sidebarOption1)
            ->with('sidebarOption2', $sidebarOption2)
            ->with('sidebarOption3', $sidebarOption3)
            ->with('sidebarOption4', $sidebarOption4)
            ->with('sidebarOption5', $sidebarOption5)
            ->with('sidebarOption6', $sidebarOption6)
            ->with('sidebarOption7', $sidebarOption7)
            ->with('sidebarOption8', $sidebarOption8)
            ->with('pageTitle', $pageTitle)
            ->with('metaDescription', $metaDescription)
            ->with('profileBasicHeading1', $profileBasicHeading1)
            ->with('pageBodyText1', $pageBodyText1)
            ->with('user', $user)
            ->with('routeUri', $route->uri);
    }
}
