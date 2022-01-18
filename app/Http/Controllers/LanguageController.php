<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use Session;

class LanguageController extends Controller
{
    public function change(Request $request)
    {
        $lang = $request->language;
        $language = config('app.locale');
        if($lang == 'en')
        {
            $language = 'en';
        }
        else if($lang == 'vi')
        {
            $language = 'vi';
        }
        $request->session()->put('language',$language);
        return redirect(url('/'));
    }
}
