<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Consumption;
use App\Models\Ingredient;
use App\Models\IngredientsRecipeConsumption;
use App\Models\Order;
use App\Models\Recette;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function PayOrder(Request $request){

        $price = $request->price;
        $price = explode(' ',$price);
        $recette_ids = [];
        // after checking payement
        $order = new Order();
        $order->datelivraison = date("Y-m-d"); 
        $order->total_price = $price[0];      
        $order->livrisontype = 1;
        $order->payee = 1;
        $order->typepayement = 1;
        $order->save();
         
    
        $items = session()->get('product');

        foreach ($items as $item) {
            $recette = Recette::find($item['id']);
            $recette_ids[] = $item['id'];
            
            $product =   new Consumption();
            $product->libelle = $recette->libelle;
            $product->prix = $item['prix'] ;
            $product->reduction = 0 ;
            $product->coupon = 0 ;
            $product->article_id = $item['id'] ;
            $product->order_id = $order->id ;
            $product->save();                  
        }
        
        
        $itemsIng = session()->get('recipeingredients');
        foreach ($itemsIng as $itemIng) {
            if(in_array($itemIng['recipeid'],$recette_ids)){
                //chech if there is ingredients then loop
                if($itemIng['ingredients']){
                    foreach($itemIng['ingredients'] as $ing){
                        $ingredient = Ingredient::find($ing);

                        $productIng =   new IngredientsRecipeConsumption();
                        $productIng->libelle = $ingredient->nom ;
                        $productIng->prix_unitaire = $ingredient->prix_unitaire;
                        $productIng->recette_id = $itemIng['recipeid'] ;
                        $productIng->ingredient_id = $ing;
                        $productIng->order_id = $order->id ;
                        $productIng->save(); 
                    }   
                }
            }                     
        }
        
        session()->put('product', null);
        session()->put('items',null);
       
        //instead of sendent index data redirect to route
        //$data['a_mosts_consumed'] = Consumption::selectRaw('`article_id`, count("article_id") AS cnt')->with(['article', 'article.ingrediants'])->groupBy('article_id')->orderBy('cnt', 'DESC')->get();
        // change to rediret
        $notification = "commande ajoutée avec succès";
        return redirect()->route('yami.index')->with($notification);
     
    }
}
