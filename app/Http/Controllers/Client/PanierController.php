<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Consumption;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PanierController extends Controller
{
    public function addToCard(Request $request){

        $items  =  session()->get('product');
        $getTotalPrice  =  session()->get('totalprice');
        $itemexist = false;
        $totalPrice = 0;

        if($items != null){

            foreach ($items as &$item) {
                if ($item['id'] == $request->id) {
                    $itemexist = true;
                    $product = $item;
    
                }
          
            }
            
        }

        if( $request->id != null && $itemexist==false ){
            $product = array( 'id'=> $request->id, 'qte'=>$request->qte, 'prix'=> $request->prix, 'ingredients'=> array());

            // $totalPrice = 
            $request->session()->push('product', $product);
            $request->session()->put('items', count(session()->get('product')) );
        }else{
            // foreach ($items as &$item) {
            //     if ($item['id'] == $request->id) {
            //         $product =  $item;
            //     }
            // }
        }

        if($items != null){
            foreach ($items as &$item) {
                $totalPrice +=  $item['qte'] *  $item['prix'] ;
            }    
        }
        

        session()->put( 'totalprice' , $totalPrice );

        $items  =  session()->get('product');
        
        if($items != null){
            foreach ($items as &$item) {
                if ($item['id'] == $request->id) {
                    $totalPrice +=  $item['qte'] *  $item['prix'];
                }    
            }
        }
            
        
        

         //check if id already taken or not 
         $itemnum = session()->get('items');
         $product = array( 'id'=> $request->id, 'qte'=>$request->qte, 'items'=> $itemnum , 'prix'=> $request->prix , 'prix_tcc'=> $totalPrice,'ingredients'=> array());
         return response()->json($product);
        
    }

    public function addOneToCard(Request $request){

        $items =  session()->get('product');

        $totalPrice = 0;
       
        
        foreach ($items as &$item) {
            if ($item['id'] == $request->id) {
                $item['qte']++;
                $product =  $item;
            }
            $totalPrice +=  $item['qte'] *  $item['prix'];
        }

        session()->put( 'totalprice' , $totalPrice );
        session()->put('product', $items);

        $itemnum = session()->get('items');
        $product['items'] =  $itemnum ;
        
        $product['prix_tcc'] = session()->get( 'totalprice') ;
        return response()->json($product);
       
   }

   public function subOneToCard(Request $request){

    $items =  session()->get('product');

        $totalPrice = 0;
       
        
        foreach ($items as &$item) {
            
            if ($item['id'] == $request->id) {
                if($item['qte']>1) $item['qte']--;
                $product =  $item;
            }

            $totalPrice +=  $item['qte'] *  $item['prix'];
        }

        session()->put( 'totalprice' , $totalPrice );
        session()->put('product', $items);

        $itemnum = session()->get('items');
        $product['items'] =  $itemnum ;
        
        $product['prix_tcc'] = session()->get( 'totalprice') ;
        return response()->json($product);
    }

    public function deleteFromCard(Request $request){
        $items =  session()->get('product');
        $newitems = [] ;
        $totalPrice = 0;

        foreach ($items as &$item) {
            if ($item['id'] == $request->id) {
                $product=  $item;
            }else{
                $newitems +=  $item;
                $totalPrice +=  $item['qte'] *  $item['prix'];
            }    
        }

        session()->put('product', null);
        session()->put( 'totalprice' , $totalPrice );
        
        if(count($newitems)>0) session()->push('product', $newitems);

        $itemnum = session()->get('items')-1;
        session()->put('items', $itemnum);
        $product['items'] = $itemnum;

        $product['prix_tcc'] = session()->get( 'totalprice') ;

        return response()->json($product);
        }
        public function addIngredientRecipeToCard(Request $request){
            
            $ingredients = session()->get('recipeingredients');
            if($ingredients!=null){

                $recipeexist=false;
                foreach($ingredients as &$in){  
                    if(isset($in['recipeid'])){                     
                        if($in['recipeid']==$request->idr){
                            $recipeexist=true;
                            if(!in_array($request->idi,$in['ingredients'])){
                                array_push($in['ingredients'],$request->idi);
                            }
                        }  
                    } 
                }
                if($recipeexist==false){
                    $ingredients[] = ['recipeid'=>$request->idr,'ingredients'=> array($request->idi)];
                }
            }
            else{
                $ingredients[] = ['recipeid'=>$request->idr,'ingredients'=> array($request->idi)];
            }
            session()->put('recipeingredients',$ingredients);
      
            $data['idr'] = $request->idr;
            $data['idi'] = $request->idi;
            $data['ingredients'] = $ingredients;

            return response()->json($data);

        }
        public function DeleteIngredientRecipeFromCard(Request $request){
            $ingredients = session()->get('recipeingredients');
            if($ingredients!=null){
                
                $recipeexist=false;
                foreach($ingredients as &$in){  
                    static $i=0;
                    if(isset($in['recipeid'])){               
                        if($in['recipeid']==$request->idr){
                            $recipeexist=true;
                            if(in_array($request->idi,$in['ingredients'])){
                                if(count($in['ingredients'])>1){
                                    array_splice($in['ingredients'],array_search($request->idi, $in['ingredients']),1);
                                }
                                else{
                                    array_splice($ingredients,$i,1);
                                }

                            }
                        } 
                    }
                    $i++;
                }
            }
           
            session()->put('recipeingredients',$ingredients);
      
            $data['idr'] = $request->idr;
            $data['idi'] = $request->idi;
            $data['ingredients'] = $ingredients;

            return response()->json($data);
           //return view('frontend.test.index', $data);
        }


        public function addOrder(){
            
            $itemnum = session()->get('items');
            $data['items'] = $itemnum;

            $items =  session()->get('product');
            $totalPrice = 0;
        
            
            foreach ($items as &$item) {
                $totalPrice +=  $item['qte'] *  $item['prix'];
            }
            $data['totalPrice'] = $totalPrice;

            return view('frontend.payment.index', $data);
           
        }
        
}
