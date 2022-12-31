<?php

use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Client\PanierController;
use App\Http\Controllers\Client\PaymentController ;
use App\Http\Controllers\Client\TableResController;
use App\Http\Controllers\IngrendientController;
use App\Http\Controllers\ItemMenuConroller;
use App\Http\Controllers\RecetteController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\StaffController as ControllersStaffController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\User\StaffController;
use App\Http\Responses\LoginResponse;
use App\Models\RecetteCategory;
use Facade\FlareClient\Http\Client;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::middleware('visitepage')->get('/',[ClientController::class, 'Home'])->name('yami.index');
Route::get('/reservation/session/{request?}',[TableResController::class, 'SetSession'])->name('reserv.session');
Route::get('/lo', function () {
    return view('auth.login');
});

Route::prefix('myrest')->group(function(){

    Route::get('/ajax', [RestaurantController::class, 'getRestAjax'])->name('rest.ajax');
    
    Route::middleware('visitepage')->get('/',[ClientController::class, 'Home'])->name('yami.index');
    
    Route::middleware('visitepage')->get('/about',[ClientController::class, 'About'] )->name('yami.about');
    Route::get('/table/{id}',[ClientController::class, 'Table'] )->name('yami.table');
    
    Route::middleware('visitepage')->get('/menu',[ClientController::class, 'Menu'])->name('yami.menu');
    
    Route::middleware('visitepage')->get('/contact',[ClientController::class, 'Contact'])->name('yami.contact');
    Route::post('contact/send/message',[ClientController::class, 'ContactMessage'])->name('contact.message');

    Route::middleware('visitepage')->get('/reservation',[ClientController::class, 'Reservation'])->name('yami.reservation');
    Route::match(['get', 'post'],'/reservation/set/table',[TableResController::class, 'TableSelect'])->name('table.select');
    
    Route::get('/table',[ClientController::class, 'Table'])->name('yami.table');

    Route::middleware('visitepage')->get('/card',[ClientController::class, 'Panier'])->name('yami.panier');
    Route::get('/card/addToCard',[PanierController::class, 'AddToCard'])->name('panier.addtocard');
    Route::get('/card/addOneToCard',[PanierController::class, 'AddOneToCard'])->name('panier.addonetocard');
    Route::get('/card/subOneToCard',[PanierController::class, 'subOneToCard'])->name('panier.subonetocard');
    Route::get('/card/deleteFromCard',[PanierController::class, 'deleteFromCard'])->name('panier.deletefromcard');
    Route::get('/card/add/ingredientrecipe',[PanierController::class, 'AddIngredientRecipeToCard'])->name('panier.addingrecipetocard');
    Route::get('/card/delete/ingredientrecipe',[PanierController::class, 'DeleteIngredientRecipeFromCard'])->name('panier.deleteingrecipeincard');

    Route::middleware('visitepage')->get('/card/commit',[PanierController::class, 'addOrder'])->name('panier.addorder');

    Route::middleware('visitepage')->get('/card/commit',[PanierController::class, 'addOrder'])->name('panier.addorder');
    Route::post('/card/payement',[PaymentController::class, 'payOrder'])->name('order.pay');

});


Route::middleware(['type:admin','auth'])->group(function () {

    Route::get('/d', function () {
        return view('/dashboard');
        });


    //middleware(['auth:sanctum', 'verified'])->
    Route::get('/dashboard', function () {
        return view('admin.index');
    })->name('dashboard');

    Route::prefix('restaurant')->group(function(){
        
        Route::get('/ajax', [RestaurantController::class, 'getRestAjax']);
        Route::get('/view', [RestaurantController::class, 'RestaurantView'])->name('restaurant.view');
        // Route::get('/add', [IngrendientController::class, 'IngrediantAdd'])->name('ingrediant.add');
        // Route::post('/store', [IngrendientController::class, 'IngrediantStore'])->name('ingrediant.store');
        // Route::get('/edit/{id}', [IngrendientController::class, 'IngrediantEdit'])->name('ingrediant.edit');
        // Route::post('/update/{id}', [IngrendientController::class, 'IngrediantUpdate'])->name('ingrediant.update');

        // Route::get('/delete/{id}', [IngrendientController::class, 'IngrediantDelete'])->name('ingrediant.delete');

        
    }); 


    Route::prefix('ingredient')->group(function(){
        Route::get('/view', [IngrendientController::class, 'IngrediantView'])->name('ingrediant.view');
        Route::get('/add', [IngrendientController::class, 'IngrediantAdd'])->name('ingrediant.add');
        Route::post('/store', [IngrendientController::class, 'IngrediantStore'])->name('ingrediant.store');
        Route::get('/edit/{id}', [IngrendientController::class, 'IngrediantEdit'])->name('ingrediant.edit');
        Route::post('/update/{id}', [IngrendientController::class, 'IngrediantUpdate'])->name('ingrediant.update');

        Route::get('/delete/{id}', [IngrendientController::class, 'IngrediantDelete'])->name('ingrediant.delete');

        Route::get('/update/ingrediant/{id}', [IngrendientController::class, 'IngrediantStatusUpdate'])->name('ingrediant.status.edit');
        
    }); 

    Route::prefix('recette')->group(function(){
        // receipt
        Route::get('/view', [RecetteController::class, 'RecetteView'])->name('recette.view');
        Route::get('/add', [RecetteController::class, 'RecetteAdd'])->name('recette.add');
        Route::post('/store', [RecetteController::class, 'RecetteStore'])->name('recette.store');
        Route::get('/edit/{id}', [RecetteController::class, 'RecetteEdit'])->name('recette.edit');
        Route::post('/update/{id}', [RecetteController::class, 'RecetteUpdate'])->name('recette.update');
        Route::get('/delete/{id}', [RecetteController::class, 'RecetteDelete'])->name('recette.delete');
        Route::get('/update/status/{id}', [RecetteController::class, 'RecetteStatusUpdate'])->name('recette.status.edit');
        // receipts categories
        Route::get('/view/category', [RecetteController::class, 'CategoryView'])->name('recette.category.view');
        Route::post('/store/category', [RecetteController::class, 'CategoryStore'])->name('recette.category.store');
        Route::get('/edit/category/{id}', [RecetteController::class, 'CategoryEdit'])->name('recette.category.edit');
        Route::post('/update', [RecetteController::class, 'CategoryUpdate'])->name('recette.category.update');
        // recipe ingrediant
        Route::post('/store/ingrediant', [RecetteController::class, 'IngrediantStore'])->name('recette.ingrediant.store');
        Route::post('/edit/ingrediant/{id}', [RecetteController::class, 'IngrediantUpdate'])->name('recette.ingrediant.update');
        Route::post('/delete/ingrediant/{id}', [RecetteController::class, 'IngrediantDelete'])->name('recette.ingrediant.delete');
        //details
        Route::get('/details/{ip}', [RecetteController::class, 'RecetteDetails'])->name('recette.details');

    });
        
    Route::prefix('menu')->group(function(){
        // menu
        Route::get('/view', [ItemMenuConroller::class, 'MenuView'])->name('menu.view');
        Route::post('/store', [ItemMenuConroller::class, 'MenuStore'])->name('menu.store');

        Route::post('/recette/store', [ItemMenuConroller::class, 'StoreMenuRecette' ])->name('menu.recette.store');
        Route::get('/edit/{id}', [ItemMenuConroller::class, 'MenuEdit'])->name('menu.edit');
        Route::post('/update/{id}', [ItemMenuConroller::class, 'MenuUpdate'])->name('menu.update');
        Route::get('/update/status/{id}', [ItemMenuConroller::class, 'MenuStatusUpdate'])->name('menu.status.edit');
        Route::get('/delete/{id}', [ItemMenuConroller::class, 'MenuDelete'])->name('menu.delete');

        Route::get('/details/{ip}', [ItemMenuConroller::class, 'MenuDetails'])->name('menu.details');
        // recipe menu 
        Route::post('/store/recipe', [ItemMenuConroller::class, 'RecipeStore'])->name('menu.recipe.store');
        Route::post('/edit/recipe/{id}', [ItemMenuConroller::class, 'RecipeUpdate'])->name('menu.recipe.update');
        Route::post('/delete/recipe/{id}', [ItemMenuConroller::class, 'RecipeDelete'])->name('menu.recipe.delete');
    
    });

    Route::prefix('table')->group(function(){
        // recipe
        Route::get('/view', [TableController::class, 'TableView'])->name('table.view');
        Route::get('/add', [TableController::class, 'TableAdd'])->name('table.add');
        Route::post('/store', [TableController::class, 'TableStore'])->name('table.store');
        Route::get('/edit/{id}', [TableController::class, 'TableEdit'])->name('table.edit');
        Route::post('/update/{id}', [TableController::class, 'TableUpdate'])->name('table.update');
        Route::get('/delete/{id}', [TableController::class, 'TableDelete'])->name('table.delete');
        Route::get('/update/status/{id}', [TableController::class, 'TableStatusUpdate'])->name('table.status.edit');
    });

    Route::prefix('reservation')->group(function(){
        // reservation
        Route::get('/view', [ReservationController::class, 'ResView'])->name('reservation.view');
        Route::get('/add', [ReservationController::class, 'ResAdd'])->name('reservation.add');
        Route::post('/store', [ReservationController::class, 'ResStore'])->name('reservation.store');
        Route::get('/edit/{id}', [ReservationController::class, 'ResEdit'])->name('reservation.edit');
        Route::post('/update/{id}', [ReservationController::class, 'ResUpdate'])->name('reservation.update');
        Route::get('/update/status/{id}', [ReservationController::class, 'ResStatusUpdate'])->name('reservation.status.edit');
        Route::get('/update/payed/{id}', [ReservationController::class, 'ReservationPayed'])->name('reservation.payed.edit');
        Route::post('/get/clients/', [ReservationController::class, 'GetClients'])->name('reservation.getclients');
        Route::get('/get/tables/', [ReservationController::class, 'GetTables'])->name('reservation.gettables');
    });

    Route::prefix('staff')->group(function(){
        // staff
        Route::get('/view', [StaffController::class, 'StaffView'])->name('staff.view');
        Route::get('/add', [StaffController::class, 'StaffAdd'])->name('staff.add');
        Route::post('/store', [StaffController::class, 'StaffStore'])->name('staff.store');
        Route::get('/edit/{id}', [StaffController::class, 'StaffEdit'])->name('staff.edit');
        Route::post('/update/{id}', [StaffController::class, 'StaffUpdate'])->name('staff.update');
        // Route::get('/update/status/{id}', [StaffController::class, 'StaffStatusUpdate'])->name('staff.status.edit');
    
        Route::get('create-step-two', [StaffController::class, 'createStepTwo'])->name('staff.create.step.two');
        Route::post('post/create-step-two', [StaffController::class, 'postCreateStepTwo'])->name('staff.create.step.two.post');
    
        Route::get('products/create-step-three', [StaffController::class, 'createStepThree'])->name('staff.create.step.three');
        Route::post('products/create-step-three', [StaffController::class, 'postCreateStepThree'])->name('staff.create.step.three.post');
    
        Route::post('/delete/{id}', [StaffController::class, 'StaffDelete'])->name('staff.delete');
    });

     // Route::get('/view', [ReservationController::class, 'ResView'])->name('reservation.view');
    // Route::get('/add', [ReservationController::class, 'ResAdd'])->name('reservation.add');
    // Route::post('/store', [ReservationController::class, 'ResStore'])->name('reservation.store');
    // Route::get('/edit/{id}', [ReservationController::class, 'ResEdit'])->name('reservation.edit');
    // Route::post('/update/{id}', [ReservationController::class, 'ResUpdate'])->name('reservation.update');
    // Route::get('/update/status/{id}', [ReservationController::class, 'ResStatusUpdate'])->name('reservation.status.edit');
    // Route::get('/update/payed/{id}', [ReservationController::class, 'ReservationPayed'])->name('reservation.payed.edit');



});




Route::prefix('auth')->group(function(){
    //authentification
    Route::get('/login', function () {
        return view('auth.login');
    });
    Route::get('/register', function () {
    
        return view('auth.register');
    });
   
});

Route::prefix('client')->group(function(){
    //authentification
    Route::get('/index', function () {
    
        return view('client.index');
    });
    Route::get('/register', function () {
    
        return view('auth.register');
    });
});

Route::get('/welcome', function () {
    return view('client.index');
});