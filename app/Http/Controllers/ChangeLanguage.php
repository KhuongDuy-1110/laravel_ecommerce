<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class ChangeLanguage extends Controller
{
    public function change(Request $request)
    {
        // $lang = $request->language;
        // $language = config('app.locale');
        // if($lang == "en")
        //     $language == "en";
        // if($lang == "vi")
        //     $language == "vi";
        // Session::put('language',$language);
        // return redirect()->back();
        echo '123';
    }
}
