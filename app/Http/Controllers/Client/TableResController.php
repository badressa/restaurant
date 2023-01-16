<?php

namespace App\Http\Controllers\Client;

use App\Events\PodcastProcessed;
use App\Http\Controllers\Controller;
use App\Http\Controllers\RestaurantController;
use App\Http\Requests\ReservationStoreRequest;
use App\Models\Reservation;
use App\Models\Table;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;
use GuzzleHttp\Client ;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Pusher\Pusher;
use SebastianBergmann\Diff\Diff;
use Stripe;

class TableResController extends Controller
{
    public $reservationValid = true;
    public $errorMessage = [] ;


    // public function TableSelect(Request $request){
    //     //PodcastProcessed::dispatch($request->heure_debut);
    //     event(new PodcastProcessed('ddadad'));
    //     return redirect()->back()->withInput();
    // }
    
    public function ReservationTable(Request $request) {

        //$request->merge(['timingError']);
        if($request->all()){
            session()->put('resinfo', $request->all());   
            // $cookie = str_replace("XSRF-TOKEN=", "XSRF-TOKEN=laravel_session_data_",$request->header('cookie'));
            // $request->headers->set('cookie',$cookie);
        }
    
       
        $req = $request->all() != null ? $request->all() : session()->get('resinfo');
       // return response()->json($req);

        $timeregex = "/^([0-1]?[0-9]|2[0-3]):[0-5][0-9]$/";
        $timeregex2 = "/^00:[0-5][0-9]$/";
       
        //note for dynamic time zones countries(MA,FR,...) check if DateTimeZone not null
        $timeZone = DateTimeZone::listIdentifiers(DateTimeZone::PER_COUNTRY, "MA") ;
        $timeZoneFirst =  $timeZone[0];
        //create current DateTime
        $d = new DateTime("now", new DateTimeZone($timeZoneFirst));
       
    
        $datetimenow= $d->format('Y-m-d H:i:s');
        $datenow= $d->format('Y-m-d');
        
        $rest = new RestaurantController();
        $restinfo =  $rest->getRestAjax();
        $restinfo = $restinfo->getOriginalContent();
        $restopening = $restinfo['heures_ouv'];

        if(preg_match($timeregex, $restopening[0]) && preg_match($timeregex, $restopening[1])){
            if($restopening[1] = "00:00"){
                $closeDateTime = new DateTime($req['date_reservation'] ." ".$restopening[1], new DateTimeZone($timeZoneFirst));
                $closeDate = $closeDateTime->modify('+1 day')->format('Y-m-d H:i:s');
                
                $preventOrderDateTime = new DateTime($closeDate, new DateTimeZone($timeZoneFirst));
                $preventOrderTime = $preventOrderDateTime->modify('-10 minutes')->format('Y-m-d H:i:s');
                
            }else{
                $closeDateTime = new DateTime($req['date_reservation'] ." ".$restopening[1], new DateTimeZone($timeZoneFirst));
                $preventOrderTime = $closeDateTime->modify('-15 minutes')->format('Y-m-d H:i:s');
                $closeDate = $closeDateTime->format('Y-m-d H:i:s');
            }

            $openDateTime = new DateTime($req['date_reservation'] ." ".$restopening[0] ,new DateTimeZone($timeZoneFirst));
            $openDate = $openDateTime->format('Y-m-d H:i:s'); 

            if($openDateTime->diff($closeDateTime)->invert == 1){
                $this->reservationValid = false;
                $this->errorMessage[] = "Problèmes d'horaire du restaurant. Veuillez nous contacter pour la réparation." ;
            }
        }else{
            $this->reservationValid = false;
            $this->errorMessage[] = "Problèmes d'horaire du restaurant. Veuillez nous contacter pour la réparation." ;
        }
        // if($this->reservationValid == false){
        //     $data['restErrors'] = $this->errorMessage; 
        //     $this->reservationValid = true;
        //     $this->errorMessage = []  ;
        // }

        if(isset($req) || true){
            if(preg_match($timeregex, $req['heure_debut']) && preg_match($timeregex, $req['heure_fin'])){

                $resStart = new DateTime($req['date_reservation']." ".$req['heure_debut'] ,new DateTimeZone($timeZoneFirst));
                if($req['heure_fin'] == "00:00" ){
                    $resEnd = new DateTime($req['date_reservation'] ." ".$req['heure_fin'], new DateTimeZone($timeZoneFirst));
                    $resEnd = $resEnd->modify('+1 day');
                    
                }else{
                    $resEnd = new DateTime($req['date_reservation'] ." ".$req['heure_fin'], new DateTimeZone($timeZoneFirst));  
                }
                $resDiff = $resEnd->diff($resStart);
                $resEnd = $resEnd->format('Y-m-d H:i:s');
                
                $resStart = $resStart->format('Y-m-d H:i:s'); 
                //dd($resEnd > $resStart, $resStart , $resEnd , $resDiff);
                
                
                if( $resStart > $resEnd || $resDiff->h > 2){
                    $this->errorMessage[] = "la réservation ne doit pas dépasser 2 heures et l'heure de début doit être inférieure à l'heure de fin ";
                    $this->reservationValid = false;
                }elseif($resDiff->h == 0 && $resDiff->i <20){
                    $this->errorMessage[] = "la durée de la réservation doit être plus que 20 minutes et l'heure de début doit être inférieure à l'heure de fin ";
                    $this->reservationValid = false;
                }
                $minesQuarter = clone $d;
                $minesQuarter= $minesQuarter->modify('-15 minutes')->format('Y-m-d H:i:s');
                $data['minesQuarter'] = $minesQuarter;
                $plusQuarter =  clone $d;
                $plusQuarter= $plusQuarter->modify('+15 minutes')->format('Y-m-d H:i:s');
                $data['plusQuarter'] = $plusQuarter;
                
                if($resStart <= $minesQuarter || $resEnd <= $plusQuarter ){
                    $this->errorMessage[] = "la marge du temps qu'on accepte est 15 minutes (-15m heure-d , +15 heure-f). Nous vous rappelons que l'heure(au Maroc) de soumission est ".$d->format('H:i');
                    $this->reservationValid = false;
                }
                
                if($openDate <= $resStart && $resEnd <= $closeDate){
                    if($resStart > $preventOrderTime){
                        $this->reservationValid = false;
                        $this->errorMessage[] = "Désolé de vous informer que nous n'acceptons pas de réservation lorsqu'il reste à fermer le restaurant 10 minutes."; 
                    }
                }else{
                    $this->reservationValid = false;
                    $this->errorMessage[] = "vous devez saisir des horaires compatibles avec l'ouverture de notre restaurant [$restopening[0],$restopening[1]] ou verifiez la date si elle est passée";
                }
                if($openDateTime->diff($closeDateTime)->invert == 1 || $openDateTime->modify('+2 hour')->diff($closeDateTime)->invert == 1){
                    $this->reservationValid = false;
                    $this->errorMessage[] = "Problèmes d'horaire du restaurant. Veuillez nous contacter pour la réparation." ;
                }
                
            }else{
                $this->reservationValid = false;
                $this->errorMessage[] = "Problèmes du requêtes de reservation.Veuillez nous contacter pour la réparation." ;
            }
        }else{
            $this->reservationValid = false;
            $this->errorMessage[] = "Problèmes du requêtes de reservation.Veuillez nous contacter pour la réparation." ;
        }


        $heure_msg = 'Problèmes du requête [:attribute] de reservation.Veuillez nous contacter pour la réparation ou attaque suspendu';
        
        $guestValidation = ['email' => 'email|unique:users',
        'client'=> ['required', 'string:250'],
        'tel' => 'string|max:15|regex:/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/',];
        $validation = [
            'heure_debut'=> ['required','regex:/^([0-1]?[0-9]|2[0-3]):[0-5][0-9]$/'],
            'heure_fin'=> ['required','regex:/^([0-1]?[0-9]|2[0-3]):[0-5][0-9]$/'],
            'date_reservation'=> ['required', 'date_format:Y-m-d'],
            'nbrpersonne'=> ['required', 'int','min:1', 'max:12'],
            'table_id' => ['sometimes', 'required']
        ];
        if(!auth()->check()){
            $validation += $guestValidation;
        }    
        
        $validator = Validator::make($request->all(), $validation,
        $messages = [

            'heure_fin.regex' => $heure_msg,
            'heure_debut' => $heure_msg,
            'required' => 'ce champs :attribute est obligatoire',
            'email.email' => ':attribute forme est incorect ou non acceptable dans notre site',
            'regex' => 'la forme de :attribute est non valide ',
            'nbrpersonne.min' => ':attribute ne peut être moins que 1',
            'nbrpersonne.max' => ':attribute ne peut être plus que 12',
            'unique' => ':attribute est déja dans notre liste'
        
        ]
        );
        
        // $validator->after(function ($validator) {
        //     if ($this->reservationValid == false) {
        //         $validator->errors()->add(
        //             'timingerrors', $this->errorMessage
        //         );
        //     }
        // });
       
        if ($this->reservationValid == false) {
            $validator->errors()->add(
                'timingerrors', $this->errorMessage
            );
        }
    
         
        $validated = $validator->validated();
        $reservations = Reservation::where('date_reservation','>=', $datenow)->get();

        // if($this->reservationValid == false){
        //     $request->setTimingErrors($this->errorMessage);
        //     $request->withValidator($validator);
        //     //return response()->json($this->errorMessage);
        // }

        
        if($validated && ($this->reservationValid == true)){
            return response()->json(['success' => ' succès', 'reservations'=>$reservations]);
         }
        else{
            return response()->json(['errors' => $validator->errors()]);
            
        }
         

       
        
        // if($this->reservationValid == false){
        //     return redirect()->back()->withInput()->with('timingerror',$this->errorMessage[0]);
        // }
     
        

       
    }

    public function getTable(){
        $data['tablemaxrow'] = Table::selectRaw(" MAX(row) AS rowmax ")->orderby('rowmax','desc')->first()->rowmax;
        $data['tables'] = Table::with('reservations')->orderBy('row', 'asc')->orderBy('col', 'asc')->get();
        $data['tablemaxcol'] = Table::selectRaw(" MAX(col) AS colmax ")->orderby('colmax','desc')->first()->colmax;
        $data['rowcount'] = Table::selectRaw("row  ,COUNT(col) AS rowcount ")->groupby('row')->orderby('rowcount','desc')->get();
    
        $data['reservations'] = Reservation::all();//where(date+day>=DateFunction-day)
        
        $itemnum = session()->get('items');
        $data['items'] = $itemnum;

        $items =  session()->get('product');
        
        
        //$data['errorMsg'] = $errorMessage;
        
        $data['resinfo'] = session()->get('resinfo');
        
        //$data['test'] = session()->get('resinfo');
        //return view('test.index', $data);
        // if($this->reservationValid == true) 
        //return view('frontend.table.exp', $data);
    }
    public function getReservation(){
        $data['tablemaxrow'] = Table::selectRaw(" MAX(row) AS rowmax ")->orderby('rowmax','desc')->first()->rowmax;
        $data['tables'] = Table::with('reservations')->orderBy('row', 'asc')->orderBy('col', 'asc')->get();
        $data['tablemaxcol'] = Table::selectRaw(" MAX(col) AS colmax ")->orderby('colmax','desc')->first()->colmax;
        $data['rowcount'] = Table::selectRaw("row  ,COUNT(col) AS rowcount ")->groupby('row')->orderby('rowcount','desc')->get();
    
        $data['reservations'] = Reservation::all();//where(date+day>=DateFunction-day)
        
        $itemnum = session()->get('items');
        $data['items'] = $itemnum;

        $items =  session()->get('product');
        
        
        //$data['errorMsg'] = $errorMessage;
        
        $data['resinfo'] = session()->get('resinfo');
        
        //$data['test'] = session()->get('resinfo');
        //return view('test.index', $data);
        // if($this->reservationValid == true) 
        //return view('frontend.table.exp', $data);
    }
    public function ReservationTabSelect(Request $request){
       

        $validation = [
            'table_id' => ['required','min:1','max:12']
        ];
          
        $validator = Validator::make($request->all(), $validation,
        $messages = [
            'required' => 'ce champs :attribute est obligatoire',      
        ]
        );

        if ($request->session()->exists('resinfo')) {
            $request->session()->put('resinfo.table_id', $request->table_id);  
            $cookie = str_replace("XSRF-TOKEN=", "XSRF-TOKEN=laravel_session_data_",$request->header('cookie'));
            $request->headers->set('cookie',$cookie);
        }   

        $validated = $validator->validated();
        if($validated){
            return response()->json(['success' => ' succès', 'requestall' => $request->all()  ]);

        }else{
            return response()->json(['success' => $validator->errors(), 'requestall' => $request->all() ]);
        }
        //return response()->json(session()->get('resinfo'));
    }

    public function ReservationStore(Request $request){

        // dd($request->all());
        //  $validatedData = $request->validate([
        //      'num' => 'required|integer|unique:reservations',
        //      'maxcapacite' => 'integer',
        //  ]);
        //  $validatedData = $request->validate([
        //     'tel' => 'required|integer|unique:users',
        //     'email' => 'required|email|unique:users',
        // ]);
        
        $req = session()->get('resinfo'); 
        $client_id =0;       
        
        
        if(!auth()->check()){
            $user = new  User();
            $user->name = $request->username;
            $user->email = $req['email'];
            $user->tel = $req['tel'];
            $user->password = 'client';
            $user->save();
            $client_id = $user->id;
        }else{
            $client_id = auth()->user()->id;

        }
        
        
        // $stripe = new \Stripe\StripeClient(env('STRIPE_SK'));

        // $stripe->paymentIntents->create([
        //     'amount' => $request->amount*100, 
        //     'currency' => 'USD',
        //     'payment_method' => 'pm_card_visa',
        //     "source" => $request->stripeToken,
        //     "description" => "This is reservation payment",
        //      ]
        // );
        // Stripe\Stripe::setApiKey(env('STRIPE_SK'));
        // Stripe\Charge::create ([
        //         "amount" => $request->amount*100,
        //         "currency" => "MAD",
        //         "source" => $request->stripeToken,
        //         "description" => "This is test payment",
        // ]);


        
   
      
        
        $data = new Reservation();
        $data->heure_debut = $req['heure_debut'] ;
        $data->heure_fin  = $req['heure_fin'] ;
        $data->date_reservation  = $req['date_reservation'] ;
        $data->nbrpersonne  = $req['nbrpersonne'] ;
        $data->status  =  0 ;
        $data->payee  =  0 ;
        $data->client_id  = $client_id;
        $data->table_id  = $req['table_id'];
        $data->save();

         $notification = "la reservation est effectuée avec succès";
        return redirect()->route('yami.index')->with($notification);
    }

    // function SetSession(Request $request){
    //     parse_str($request->url(),$request);
    //     dd($request['request']);
    //     if($request['request'] !== null){
    //         session()->put('resinfo', $request['request']);
    //     }
    //     $data['test'] = session()->get('resinfo');
    //     // if($request->all() !== null){
    //     //     session()->put('resinfo', $request->all());
    //     // }
    //     // $data['test'] = $request->all();
        
    //     // return view('test.index', $data);
        
    // }
   
    public function setCookie($name,Request $request){
        $minutes = 120;
        $response = new Response('Set Cookie');
        $response->withCookie(cookie($name, $request->all()));
        return $response;
    }
    public function getCookie($name, Request $request){
        $value = $request->cookie($name);
        return $value;
    }

     
}
