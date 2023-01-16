<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use App\Models\ItemFormat;
use App\Models\ItemMenu;
use App\Models\Recette;
use App\Models\RecetteCategory;
use App\Models\RecipeMenu;
use Illuminate\Http\Request;

class ItemMenuConroller extends Controller
{
    public function MenuView(){
        $data['alldata'] = ItemMenu::all();
        $data['categories'] = RecetteCategory::all();
        $data['ingredients'] = Ingredient::all();

        return view('backend.menu.index', $data);
    }

    public function MenuStore(Request $request){

        $validatedData = $request->validate([
           'nom' => 'required',
           'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',           
        ]);
        
       $data = new ItemMenu();
       $data->nom = $request->nom;
     
       $data->status = ($request->status==null) ? 1 : 0;
        
       if ($request->file('image')) { 


             $file = $request->file('image');
    		//@unlink(public_path('images/recettes/'.$data->photo));
    		$filename = date('YmdHi').$file->getClientOriginalName();
    		$file->move(public_path('images/menus'),$filename);
    		$data->image = $filename;
       }
       $data->save();
   
       $notification = array(
           'message' => 'menu ajouté avec succés',
           'alert-type' => 'success'
       );

       return redirect()->route('menu.view')->with($notification);
    }

    public function MenuEdit($id){

        $data['menu'] = ItemMenu::find($id);
        $data['menu_recettes'] = RecipeMenu::with('recettes')->where('menu_id',$id)->get();
    
        $data['formats'] = ItemFormat::all();
        $data['categories'] = RecetteCategory::all();
        $data['recettes'] = Recette::all();
        return view('backend.menu.menu_edit',$data);
    }


    public function MenuUpdate(Request $request, $id ){

        $validatedData = $request->validate([
           'nom' => 'required',
           'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',           
        ]);

       $data =  ItemMenu::find($id);
       $data->nom = $request->nom;
       $data->status = ($request->status==null) ? 1 : 0;
       if ($request->file('image')) { 

             $file = $request->file('image');
    		@unlink(public_path('images/menu/'.$data->photo));
    		$filename = date('YmdHi').$file->getClientOriginalName();
    		$file->move(public_path('images/menus'),$filename);
    		$data->image = $filename;
       }
       $data->save();
   
       $notification = array(
           'message' => 'menu modifiée avec succés',
           'alert-type' => 'success'
       );

       return redirect()->route('menu.view')->with($notification);
    }

    public function MenuStatusUpdate($id){
         
        $data = ItemMenu::find($id);
        $data->status = !$data->status;
        $data->save();

        $notification = array(
            'message' => 'recette status modifié avec succès',
            'alert-type' => 'success'
        );

        return redirect()->route('menu.view')->with($notification);
    }

    public function MenuDetails($id){

        $data['menu'] = ItemMenu::find($id);
        $data['menu_recettes'] = RecipeMenu::with('recettes')->where('menu_id',$id)->get();
        $data['recettes'] = Recette::all();
        // dd($data);
        return view('backend.menu.details', $data);
    }

    public function StoreMenuRecette(Request $request){

       
        $validatedData = $request->validate([
            'recette_id' => 'required|unique:recipe_menus,recette_id',
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',           
         ]);

         
        $idmenu = $request->menu_id;
        foreach($request->idrecette as $key => $value ){
            if($value!=null){
                $data = new RecipeMenu();
                $data->qte = $request->qte[$key] ;
                $data->recette_id =  $value ;
                $data->menu_id = $request->menu_id ;
                $data->save();
            }
        }
        $notification = array(
            'message' => 'recette status modifié avec succès',
            'alert-type' => 'success'
        );
    
        return redirect()->route('menu.view')->with($notification);
    }

    public function MenuDelete($id){

        $data= ItemMenu::find($id);
        $data->delete();
  
        $notification = array(
            'message' => 'menu supprimé avec succès',
            'alert-type' => 'success'
        );
    
        return redirect()->route('menu.view')->with($notification);

    }



    public function RecipeStore(Request $request){

        $idmenu = $request->menu_id;
        foreach($request->idrecette as $key => $value ){
            if($value!=null){
                //make condition to enshure that qte valabl dans la  cuisine ou stock
                $data = new RecipeMenu();
                $data->qte = $request->qte[$key] ;
                $data->recette_id = $value;
                $data->menu_id = $idmenu;
                $data->save();
            }
        }

        $notification = array(
            'message' => 'recette status modifié avec succès',
            'alert-type' => 'success'
        );
    
        return redirect()->back()->with($notification);
    
     }


     public function RecipeUpdate(Request $request,$id){
        
        $data = RecipeMenu::find($id);
        $data->qte = $request->qte;
        $data->save();

        $notification = array(
            'message' => 'menu recettes modifié avec succès',
            'alert-type' => 'success'
        );
    
        return redirect()->back()->with($notification);
    }
    public function RecipeDelete(Request $request,$id){

       $data = RecipeMenu::find($id);
       $data->delete();

       $notification = array(
           'message' => 'menu recettes supprimé avec succès',
           'alert-type' => 'success'
       );
   
       return redirect()->back()->with($notification);
    }


    
}
