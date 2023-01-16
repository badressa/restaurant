<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Controllers\RestaurantController;
use App\Models\Consumption;
use App\Models\Contact;
use App\Models\ItemMenu;
use App\Models\Recette;
use App\Models\RecetteCategory;
use App\Models\RecipeMenu;
use App\Models\Table;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ClientController extends Controller
{
    public function Home() {
       $data['items'] = session()->get('items');
    //    $test = DB::table("consumptions")
    //    ->selectRaw('`article_id`, count("article_id") AS cnt')->groupBy("article_id")
    //    ->get();
       $data['a_mosts_consumed'] = Consumption::selectRaw('`article_id`, count("article_id") AS cnt')->with(['article', 'article.ingrediants'])->groupBy('article_id')->orderBy('cnt', 'DESC')->get();
       return view('yami.index', $data);
    }
    public function Reservation() {
        $data['items'] = session()->get('items');

        //dd(session()->getId());
        $timeregex = "/^([0-1]?[0-9]|2[0-3]):[0-5][0-9]$/";

        //note for dynamic time zones countries(MA,FR,...) check if DateTimeZone not null
        $timeZone = DateTimeZone::listIdentifiers(DateTimeZone::PER_COUNTRY, "MA") ;
        $timeZoneFirst =  $timeZone[0];
        //create current DateTime
        $d = new DateTime("now", new DateTimeZone($timeZoneFirst));
        $datetimenow= $d->format('Y-m-d H:i:s');
        $datenow= $d->format('Y-m-d');

        session()->put('resinfo', null);
        $rest = new RestaurantController();
        $restinfo =  $rest->getRestAjax();
        $restinfo = $restinfo->getOriginalContent();
        $restopening = $restinfo['heures_ouv'];

        if(preg_match($timeregex, $restopening[0]) && preg_match($timeregex, $restopening[1])){
            if($restopening[1] = "00:00"){
                $closeDateTime = new DateTime($datenow ." ".$restopening[1], new DateTimeZone($timeZoneFirst));
                $closeDateTime = $closeDateTime->modify('+1 day')->format('H:i');
                
                $preventOrderDateTime = new DateTime($closeDateTime, new DateTimeZone($timeZoneFirst));
                $preventOrderTime = $preventOrderDateTime->modify('-30 minutes')->format('H:i');
                //dd($preventOrderTime);
            }
            else{
                $closeDateTime = new DateTime($datenow ." ".$restopening[1], new DateTimeZone($timeZoneFirst));
                $preventOrderTime = $closeDateTime->modify('-15 minutes')->format('H:i');
                $closeDateTime = $closeDateTime->format('H:i');
            }

            $openDateTime = new DateTime($datenow ." ".$restopening[0] ,new DateTimeZone($timeZoneFirst));
            $openDateTime = $openDateTime->format('H:i'); 
        }
                $minesQuarter = clone $d;
                $minesQuarter= $minesQuarter->modify('-15 minutes')->format('Y-m-d H:i:s');
                $data['minesQuarter'] = $minesQuarter;
                $plusQuarter =  clone $d;
                $plusQuarter= $plusQuarter->modify('+15 minutes')->format('Y-m-d H:i:s');
                $data['plusQuarter'] = $plusQuarter;
        $data['tablemaxrow'] = Table::selectRaw(" MAX(row) AS rowmax ")->orderby('rowmax','desc')->first()->rowmax;
        $data['tables'] = Table::with('reservations')->orderBy('row', 'asc')->orderBy('col', 'asc')->get();
        $data['tablemaxcol'] = Table::selectRaw(" MAX(col) AS colmax ")->orderby('colmax','desc')->first()->colmax;
        $data['rowcount'] = Table::selectRaw("row  ,COUNT(col) AS rowcount ")->groupby('row')->orderby('rowcount','desc')->get();
    
        //$data['reservations'] = Reservation::all();//where(date+day>=DateFunction-day)
        
        $itemnum = session()->get('items');
        $data['items'] = $itemnum;

        $items =  session()->get('product');
        
        
        //$data['errorMsg'] = $errorMessage;
        
        $data['resinfo'] = session()->get('resinfo');

        $data['opent'] =  $openDateTime?$openDateTime:'';
        $data['preventt'] =  $preventOrderTime?$preventOrderTime:'';
        $data['closet'] =  $closeDateTime?$closeDateTime:'';
     
        return view('frontend.reservation.index', $data);
    }
    
    public function About() {
        $data['items']=session()->get('items');
        return view('frontend.about.index', $data);
    }
    
    public function Menu() {
        //look for plage or mapping inside Recette model or where req inside req with elequont sel from where (select where)
        //$t= Recette::with(['idreceipts','ingrediants'])->get();
   
        $data['items'] = session()->get('items');
        $data['recipeIng'] = session()->get('recipeingredients');
        $data['product'] = session()->get('product');
        $data['menu'] = ItemMenu::where('status',0)->get()->last();
        $id = ItemMenu::where('status',0)->get()->last()->id;

        //check disponible receipts
        $data['menu_recettes'] = RecipeMenu::with(['recettes','recettes.ingrediants'])->where('menu_id',$id)->get();
        $data['recipe_categories'] = RecetteCategory::with(['recetteMenuCategories','recettes','recettes.recipemenus','recettes.ingrediants'])->get();
        // $data['recipe_categories'] = RecetteCategory::with(['recettes'])->get();
        $data['recettes'] = Recette::all();
        //dd($data['recipe_categories']);
        return view('frontend.menu.index', $data);
    }
    
    public function Contact() {
        $data['items'] = session()->get('items');
        return view('frontend.contact.index', $data);
    }

    public function Panier() {

        $items =  session()->get('product');
        $totalPrice = 0;
        if($items != null){
            foreach ($items as &$item) {
                $totalPrice +=  $item['qte'] *  $item['prix'] ;
            }    
        }
        
        
        $strIds = '';
    
        if( session()->get('product')!=null ){
            foreach ($items as &$item) {
                $strIds .=  $item['id'].',';
            }
        }
   
         $data['items'] = session()->get('items');

        // $id = $request->id;

        $ids = explode(',',$strIds);
        
        $data['menu_recettes'] = Recette::whereIn('id', $ids)->get();
        $data['totalPrice'] = $totalPrice;
      
        // $asset_request = asset_request::whereIn('id', $ids)->get();
        // $data['menu'] = ItemMenu::get()->last();
        // $id = ItemMenu::get()->last()->id;
        // $data['menu_recettes'] = RecipeMenu::with('receipts')->where('menu_id',$id)->get();
        // //get recipts
        // //$data[0]->receipts->where('disponible',true)->get();
        // $data['recettes'] = Recette::all();
       
        return view('frontend.panier.index', $data);
    }

    public function Table($id) {
        // check if table exist and available
        $data['items'] = session()->get('items');
        $data['id'] =  $id;
        $data['table'] =  Table::find($id);
        return view('frontend.table.index', $data);
    }

    public function ContactMessage(Request $request){
         $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        $contact = new Contact();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->message = $request->message;
        $contact->client_id = auth()->user()?auth()->user()->id:null;
        $contact->save();
        
        //return index vue wuitj route;
        $notification = "contact ajoutée avec succès";
        return redirect()->route('yami.index')->with($notification);
   
    }

    public function Test(Request $request){
        $data['items'] = session()->get('items');

        //dd(session()->getId());
        $timeregex = "/^([0-1]?[0-9]|2[0-3]):[0-5][0-9]$/";

        //note for dynamic time zones countries(MA,FR,...) check if DateTimeZone not null
        $timeZone = DateTimeZone::listIdentifiers(DateTimeZone::PER_COUNTRY, "MA") ;
        $timeZoneFirst =  $timeZone[0];
        //create current DateTime
        $d = new DateTime("now", new DateTimeZone($timeZoneFirst));
        $datetimenow= $d->format('Y-m-d H:i:s');
        $datenow= $d->format('Y-m-d');

        session()->put('resinfo', null);
        $rest = new RestaurantController();
        $restinfo =  $rest->getRestAjax();
        $restinfo = $restinfo->getOriginalContent();
        $restopening = $restinfo['heures_ouv'];

        if(preg_match($timeregex, $restopening[0]) && preg_match($timeregex, $restopening[1])){
            if($restopening[1] = "00:00"){
                $closeDateTime = new DateTime($datenow ." ".$restopening[1], new DateTimeZone($timeZoneFirst));
                $closeDateTime = $closeDateTime->modify('+1 day')->format('H:i');
                
                $preventOrderDateTime = new DateTime($closeDateTime, new DateTimeZone($timeZoneFirst));
                $preventOrderTime = $preventOrderDateTime->modify('-30 minutes')->format('H:i');
                //dd($preventOrderTime);
            }
            else{
                $closeDateTime = new DateTime($datenow ." ".$restopening[1], new DateTimeZone($timeZoneFirst));
                $preventOrderTime = $closeDateTime->modify('-15 minutes')->format('H:i');
                $closeDateTime = $closeDateTime->format('H:i');
            }

            $openDateTime = new DateTime($datenow ." ".$restopening[0] ,new DateTimeZone($timeZoneFirst));
            $openDateTime = $openDateTime->format('H:i'); 
        }
                $minesQuarter = clone $d;
                $minesQuarter= $minesQuarter->modify('-15 minutes')->format('Y-m-d H:i:s');
                $data['minesQuarter'] = $minesQuarter;
                $plusQuarter =  clone $d;
                $plusQuarter= $plusQuarter->modify('+15 minutes')->format('Y-m-d H:i:s');
                $data['plusQuarter'] = $plusQuarter;
        $data['tablemaxrow'] = Table::selectRaw(" MAX(row) AS rowmax ")->orderby('rowmax','desc')->first()->rowmax;
        $data['tables'] = Table::with('reservations')->orderBy('row', 'asc')->orderBy('col', 'asc')->get();
        $data['tablemaxcol'] = Table::selectRaw(" MAX(col) AS colmax ")->orderby('colmax','desc')->first()->colmax;
        $data['rowcount'] = Table::selectRaw("row  ,COUNT(col) AS rowcount ")->groupby('row')->orderby('rowcount','desc')->get();
    
        //$data['reservations'] = Reservation::all();//where(date+day>=DateFunction-day)
        
        $itemnum = session()->get('items');
        $data['items'] = $itemnum;

        $items =  session()->get('product');
        
        
        //$data['errorMsg'] = $errorMessage;
        
        $data['resinfo'] = session()->get('resinfo');

        $data['opent'] =  $openDateTime?$openDateTime:'';
        $data['preventt'] =  $preventOrderTime?$preventOrderTime:'';
        $data['closet'] =  $closeDateTime?$closeDateTime:'';
        return view('test.index', $data);
    }
    
}

