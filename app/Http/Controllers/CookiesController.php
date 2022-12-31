<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;


class CookiesController extends Controller
{
    public function getCookie(Request $request)
    {
        $value2 = $request->cookie('test-cookie-2');
        dd($value2);
    }
}
