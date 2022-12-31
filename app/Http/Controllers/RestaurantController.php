<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function getRestAjax()
    {
        $rest =[
            'nom' => 'MyRest',
            'email' => 'myrest@dashboard.com',
            'numtel' => '0501010202',
            'baseline' => 'soyer bienvenue a myRest',
            'description' => 'description de mons rest',
            'capital' => '10000 DH',
            'apropos' => 'Myrest est un restaurant',
            'adresse' => '144, rue Almaarifa',
            'heures_ouv' => [ '08:00', '00:00' ],
                   ];

        return response()->json($rest);
    }

    public function RestaurantView(){
        return view('backend.restaurant.index');
    }
}
