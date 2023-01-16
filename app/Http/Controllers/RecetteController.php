<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use App\Models\ItemFormat;
use App\Models\ItemMenu;
use App\Models\ReceiptIngrediant;
use App\Models\Recette;
use App\Models\RecetteCategory;
use App\Models\RecipeMenu;
use Illuminate\Http\Request;

class RecetteController extends Controller
{
    public function RecetteView(){
        $data['alldata'] = Recette::all();
        $data['categories'] = RecetteCategory::all();
        $data['ingredients'] = Ingredient::all();
        
        return view('backend.recettes.index', $data);
     }
 
     public function RecetteAdd(){
         $data['categories'] = RecetteCategory::all();
         $data['formats'] = ItemFormat::all();
         return view('backend.recettes.recette_add', $data);
     }
 
     public function RecetteStore(Request $request){

         $validatedData = $request->validate([
            'libelle' => 'required',
            'photo' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'prix_ht' => 'required|integer',
            'tva' => 'required|integer|min:0|max:100',
            'prix_tcc' => 'required|integer',
            'reduction' => 'integer|min:0|max:100'
            
         ]);

        $defaultCategory = RecetteCategory::where('nom','Others')->get()->last();
        $defaultCategoryId =  $defaultCategory->id;
    
        $data = new Recette();
        $data->libelle = $request->libelle;
        $data->prix_ht = $request->prix_ht;
        $data->tva = $request->tva;
        $data->prix_tcc = $request->prix_tcc;
        $data->description = $request->description;
        $data->reduction = $request->reduction;
        $data->disponible = ($request->disponible==null) ? 1 : 0;
        $data->quantite_predifinis = $request->quantite_predifinis;
        $data->durabilite = $request->durabilite;
        $data->idCategorie = ($request->idCategorie==null)?$defaultCategoryId:$request->idCategorie;
        
        if ($request->file('photo')) {


    		$file = $request->file('photo');
    		//@unlink(public_path('images/recettes/'.$data->photo));
    		$filename = date('YmdHi').$file->getClientOriginalName();
    		$file->move(public_path('images/recettes'),$filename);
    		$data->photo = $filename;

    		// $name = date('YmdHi').$request->file('photo')->getClientOriginalName();
            // $path = $request->file('photo')->store('images/recettes');
    		// $data->photo = $path;
    	}
    	$data->save();
    
        

    	$notification = array(
    		'message' => 'User Profile Updated Successfully',
    		'alert-type' => 'success'
    	);

    	return redirect()->route('recette.view')->with($notification);
     }
 
     public function RecetteEdit($id){

         $data['recette'] = Recette::find($id);
         $data['recette_ingredients'] = ReceiptIngrediant::with('ingrediant')->where('recette_id', $id )->get();
         $data['recette_ingredients'] = ReceiptIngrediant::with('ingrediant')->where('recette_id', $id )->get();
         $data['categories'] = RecetteCategory::all();
         $data['formats'] = ItemFormat::all();
         return view('backend.recettes.recette_edit',$data);
     }
 
     public function RecetteUpdate(Request $request, $id){
        $validatedData = $request->validate([
            'libelle' => 'required',
            'photo' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'prix_ht' => 'required|integer',
            'tva' => 'required|integer|min:0|max:100',
            'prix_tcc' => 'required|integer',
            'reduction' => 'integer|min:0|max:100'
            
         ]);
        
        $defaultCategory = RecetteCategory::where('nom','Others')->get()->last();
        $defaultCategoryId =  $defaultCategory->id;
        
        $data = Recette::find($id);
        $data->libelle = $request->libelle;
        $data->prix_ht = $request->prix_ht;
        $data->tva = $request->tva;
        $data->prix_tcc = $request->prix_tcc;
        $data->description = $request->description;
        $data->reduction = $request->reduction;
        $data->disponible = ($request->disponible==null) ? 1 : 0;
        $data->quantite_predifinis = $request->quantite_predifinis;
        $data->durabilite = $request->durabilite;
        $data->idCategorie = ($request->idCategorie==null)?$defaultCategoryId:$request->idCategorie;
        if ($request->file('photo')) {
    		$file = $request->file('photo');
    		@unlink(public_path('images/recettes/'.$data->photo));
    		$filename = date('YmdHi').$file->getClientOriginalName();
    		$file->move(public_path('images/recettes'),$filename);
    		$data->photo = $filename;
    	}
        $data->save();
 
        $notification = array(
             'message' => 'recettes modifié avec succès',
             'alert-type' => 'success'
        );
 
        return redirect()->route('recette.view')->with($notification);
     }
 
     public function RecetteStatusUpdate($id){
         
         $data = Recette::find($id);
         $data->disponible = !$data->disponible;
         $data->save();
 
         $notification = array(
             'message' => 'recette status modifié avec succès',
             'alert-type' => 'success'
         );
 
         return redirect()->route('recette.view')->with($notification);
     }

     public function RecetteDelete($id){
         
        $data = Recette::find($id);
        $data->delete();

        $notification = array(
            'message' => 'recette suprimme avec succes',
            'alert-type' => 'success'
        );

        return redirect()->route('recette.view')->with($notification);
    }

     public function RecetteDetails($id){

        $data['recette'] = Recette::find($id);
        $data['recette_ingredients'] = ReceiptIngrediant::with('ingrediant')->where('recette_id', $id )->get();
        $data['recette_ingredients'] = ReceiptIngrediant::with('ingrediant')->where('recette_id', $id )->get();
        // $data['recettes'] = Recette::all();
        return view('backend.recettes.details', $data);
    }

    


      public function CategoryView(){
       
        $data['alldata'] = RecetteCategory::all();
        return view('backend.recettes.category.index', $data);
    
     }
 
    //  public function CategoryAdd(){
    //      $data['alldata'] = RecetteCategory::all();
    //      return view('backend.recettes.recette_add', $data);
    //  }
 
     public function CategoryStore(Request $request){
         $validatedData = $request->validate([
             'nom' => 'required',
             'quantite_unite' => 'integer',
             'prix_unitaire' => 'integer',
         ]);
         
         $data = new RecetteCategory();
         $data->nom = $request->nom;
         $data->save();
 
         $notification = array(
             'message' => 'User Inserted Successfully',
             'alert-type' => 'success'
         );
 
         return redirect()->route('recette.category.view')->with($notification);
     }
 
    //  public function CategoryEdit($id){
 
    //      $editData = Ingredient::find($id);
    //      return view('backend.ingrediants.ingrediant_edit',compact('editData'));
    //  }
 
     public function CategoryUpdate(Request $request){

        $validatedData = $request->validate([
            'nom' => 'required',
        ]);

        $t = explode( '.', $request->key );

        $id = $t[0];
        $key = $t[1];
       

         $data = RecetteCategory::find($id);
         $data->nom = $request->nom[$key];
         $data->save();
 
         $notification = array(
             'message' => 'ingrediants modifié avec succès',
             'alert-type' => 'success'
         );
 
         return redirect()->route('recette.category.view')->with($notification);
     }


     public function IngrediantStore(Request $request){



        $idrecette = $request->recette_id;
        foreach($request->idingrediant as $key => $value ){
            if($value!=null){
                //make condition to enshure that qte valabl dans la  cuisine ou stock
                $data = new ReceiptIngrediant();
                $data->qte = $request->qte[$key] ;
                $data->unite = $request->unite[$key];
                $data->ingredient_id = $value;
                $data->recette_id = $idrecette;
                $data->save();
            }
        }

        $notification = array(
            'message' => 'recette ingredient iné avec succès',
            'alert-type' => 'success'
        );
    
        return redirect()->route('recette.view')->with($notification);

            
     }


     public function IngrediantUpdate(Request $request,$id){
        
        $data = ReceiptIngrediant::find($id);
        $data->qte = $request->qte;
        $data->save();

        $notification = array(
            'message' => 'recette ingredient modifié avec succès',
            'alert-type' => 'success'
        );
    
        return redirect()->back()->with($notification);
    }
    public function IngrediantDelete(Request $request,$id){

       $data = ReceiptIngrediant::find($id);
       $data->delete();

       $notification = array(
           'message' => 'recette ingredient supprimé avec succès',
           'alert-type' => 'success'
       );
   
       return redirect()->back()->with($notification);
    }

     
 
}
