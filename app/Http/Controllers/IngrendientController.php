<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class IngrendientController extends Controller
{
    public function ingrediantView(){
       $data['alldata'] = Ingredient::all();
       return view('backend.ingrediants.index', $data);
    }

    public function ingrediantAdd(){
        return view('backend.ingrediants.ingrediant_add');
    }

    public function IngrediantStore(Request $request){
        $validatedData = $request->validate([
    		'nom' => 'required',
            'quantite_unite' => 'integer',
            'prix_unitaire' => 'integer',
    	]);
        
    	$data = new Ingredient();
        $data->nom = $request->nom;
        $data->quantite_unite = $request->quantite_unite ;
        $data->prix_unitaire = $request->prix_unitaire;
        $data->unite = $request->unite;
        $data->categorie = $request->categorie;
    	$data->save();

    	$notification = array(
    		'message' => 'User Inserted Successfully',
    		'alert-type' => 'success'
    	);

    	return redirect()->route('ingrediant.view')->with($notification);
    }

    public function IngrediantEdit($id){

        $editData = Ingredient::find($id);
        return view('backend.ingrediants.ingrediant_edit',compact('editData'));
    }

    public function IngrediantUpdate(Request $request, $id){
        $validatedData = $request->validate([
    		'nom' => 'required',
            'quantite_unite' => 'integer'
    	]);
        
    	$data = Ingredient::find($id);
        $data->nom = $request->nom;
        $data->quantite_unite = $request->quantite_unite ;
        $data->prix_unitaire = $request->prix_unitaire;
        $data->unite = $request->unite;
        $data->categorie = $request->categorie;
    	$data->save();

    	$notification = array(
    		'message' => 'ingrediants modifié avec succès',
    		'alert-type' => 'success'
    	);

    	return redirect()->route('ingrediant.view')->with($notification);
    }

    public function IngrediantStatusUpdate($id){
        
    	$data = Ingredient::find($id);
        $data->status = !$data->status;
    	$data->save();

    	$notification = array(
    		'message' => 'ingrediants modifié avec succès',
    		'alert-type' => 'success'
    	);

    	return redirect()->route('ingrediant.view')->with($notification);
    }

    public function IngrediantDelete($id){
        
    	$data = Ingredient::find($id);
        if($data->quantite_unite - ( $data->quantite_endommage + $data->quantite_consomme)<0.5 ){
            $data->delete();

            $notification = array(
                'message' => 'ingrediant supprimé avec succès',
                'alert-type' => 'success'
            );

            return redirect()->route('ingrediant.view')->with($notification);
        }else{

            $notification = array(
                'message' => 'ingrediant est en cours en consommation',
                'alert-type' => 'danger'
            );

            return redirect()->route('ingrediant.view')->with($notification);

        }
            
    }
    
}
