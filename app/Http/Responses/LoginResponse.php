<?php

namespace App\Http\Responses;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{

    // public function toResponse($request)
    // {
        
    //     // below is the existing response
    //     // replace this with your own code
    //     // the user can be located with Auth facade
        
    //     return $request->wantsJson()
    //                 ? response()->json(['two_factor' => false])
    //                 : redirect()->intended(config('fortify.home'));
    // }

    public function toResponse($request)
    {
        $role = Auth::user()->role;
      
        if ($request->wantsJson()) {
            return response()->json(['two_factor' => false]);
        }

        switch ($role) {
            case 'admin':
                return redirect()->intended(config('fortify.home'));
            case 'client':
                return redirect()->intended('/welcome');
            default:
                return redirect('/');
        }
    }

}