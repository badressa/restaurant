<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Controllers\RestaurantController;
use App\Models\Reservation;
use App\Models\Table;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;
use GuzzleHttp\Client ;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use SebastianBergmann\Diff\Diff;

class TableResController extends Controller
{
    public function TableSelect(Request $request) {
        
        $reservationValid = true;
        $errorMessage = [];
        
        //heure_debut,heure_fin,date_reservation,nbrpersonne,client,email,tel"
        if($request->all()){
            // $query = http_build_query(array('request' => $request));
            // $rt = route('reserv.session',['request' => $query]);
            // Http::get($rt);
            // $client = new Client();
            // $req = $client->get($r)
            // $res = $client->send();
            session()->put('resinfo', $request->all());   
        }
        
        $cookie = str_replace("XSRF-TOKEN=", "XSRF-TOKEN=laravel_session_data_",$request->header('cookie'));
        $request->headers->set('cookie',$cookie);
       
        $req = $request->all() != null ? $request->all() : session()->get('resinfo');

        $timeregex = "/^([0-1]?[0-9]|2[0-3]):[0-5][0-9]$/";
       
        //note for dynamic time zones countries(MA,FR,...) check if DateTimeZone not null
        $timeZone = DateTimeZone::listIdentifiers(DateTimeZone::PER_COUNTRY, "MA") ;
        $timeZoneFirst =  $timeZone[0];
        //create current DateTime
        $d = new DateTime("now", new DateTimeZone($timeZoneFirst));
       
    
        $datetimenow= $d->format('Y-m-d H:i:s');
        $datenow= $d->format('Y-m-d');

        
       
        // $response = Http::get(route('rest.ajax'));
        // $restinfo = json_decode($response->body(), true);
        //$reservation = Reservation::where('date_reservation','>=',date('Y-m-d H:i:s') )->get();
        //or 
        $rest = new RestaurantController();
        $restinfo =  $rest->getRestAjax();
        $restinfo = $restinfo->getOriginalContent();
        $restopening = $restinfo['heures_ouv'];

        if(preg_match($timeregex, $restopening[0]) && preg_match($timeregex, $restopening[1])){
            if($restopening[1] = "00:00"){
                $closeDateTime = new DateTime($datenow ." ".$restopening[1], new DateTimeZone($timeZoneFirst));
                $closeDate = $closeDateTime->modify('+1 day')->format('Y-m-d H:i:s');
                
                $preventOrderDateTime = new DateTime($closeDate, new DateTimeZone($timeZoneFirst));
                $preventOrderTime = $preventOrderDateTime->modify('-10 minutes')->format('Y-m-d H:i:s');
                
            }else{
                $closeDateTime = new DateTime($datenow ." ".$restopening[1], new DateTimeZone($timeZoneFirst));
                $preventOrderTime = $closeDateTime->modify('-15 minutes')->format('Y-m-d H:i:s');
                $closeDate = $closeDateTime->format('Y-m-d H:i:s');
            }

            $openDateTime = new DateTime($datenow ." ".$restopening[0] ,new DateTimeZone($timeZoneFirst));
            $openDate = $openDateTime->format('Y-m-d H:i:s'); 

            if($openDateTime->diff($closeDateTime)->invert == 1){
                $reservationValid = false;
                $errorMessage[] = "Problèmes d'horaire du restaurant. Veuillez nous contacter pour la réparation." ;
            }
        }else{
            $reservationValid = false;
            $errorMessage[] = "Problèmes d'horaire du restaurant. Veuillez nous contacter pour la réparation." ;
        }

        if(isset($req) || true){
            if(preg_match($timeregex, $req['heure_debut']) && preg_match($timeregex, $req['heure_fin'])){

                $resEnd = new DateTime($datenow ." ".$req['heure_fin'], new DateTimeZone($timeZoneFirst));
                $resStart = new DateTime($datenow ." ".$req['heure_debut'] ,new DateTimeZone($timeZoneFirst));
                
                $resDiff = $resEnd->diff($resStart);
                $resEnd = $resEnd->format('Y-m-d H:i:s');
                
                $resStart = $resStart->format('Y-m-d H:i:s'); 
                //dd($resEnd > $resStart, $resStart , $resEnd , $resDiff);
                
                
                if( $resStart > $resEnd || $resDiff->h > 2){
                    $errorMessage[] = "la réservation ne doit pas dépasser 2 heures et l'heure de début doit être inférieure à l'heure de fin ";
                    $reservationValid = false;
                }elseif($resDiff->h == 0 && $resDiff->i <20){
                    $errorMessage[] = "la durée de la réservation doit être plus que 20 minutes et l'heure de début doit être inférieure à l'heure de fin ";
                    $reservationValid = false;
                }
                $minesQuarter = clone $d;
                $minesQuarter->modify('-15 minutes')->format('Y-m-d H:i:s');
                $plusQuarter =  clone $d;
                $plusQuarter->modify('+15 minutes')->format('Y-m-d H:i:s');
                
                if($resStart < $minesQuarter || $resEnd < $plusQuarter ){
                    $errorMessage[] = "la marge du temps qu'on accepte est 15 minutes (-15m heure-d , +15 heure-f). Nous vous rappelons que l'heure(au Maroc) de soumission est ".$d->format('H:i') ;
                    $reservationValid = false;
                }
                
                if($openDate <= $resStart && $resEnd <= $closeDate){
                    if($resStart > $preventOrderTime){
                        $reservationValid = false;
                        $errorMessage[] = "Désolé de vous informer que nous n'acceptons pas de réservation lorsqu'il reste à fermer le restaurant 10 minutes."; 
                    }
                }else{
                    $reservationValid = false;
                    $errorMessage[] = "vous devez saisir des horaires compatibles avec l'ouverture de notre restaurant [$restopening[0],$restopening[1]]";
                }
                if($openDateTime->diff($closeDateTime)->invert == 1 || $openDateTime->modify('+2 hour')->diff($closeDateTime)->invert == 1){
                    $reservationValid = false;
                    $errorMessage[] = "Problèmes d'horaire du restaurant. Veuillez nous contacter pour la réparation." ;
                }
                
            }else{
                $reservationValid = false;
                $errorMessage[] = "Problèmes du requêtes de reservation.Veuillez nous contacter pour la réparation." ;
            }
        }else{
            $reservationValid = false;
            $errorMessage[] = "Problèmes du requêtes de reservation.Veuillez nous contacter pour la réparation." ;
        }
        if($reservationValid = false){
            $data['error'] = $errorMessage;
            return redirect()->with('error',$data);
        }
        
        
       

        //SELECT ROW ,  COUNT(col) AS colcount from `tables` Group BY `row` ORDER BY  colcount DESC;
        //SELECT Col ,  COUNT(row) AS rowcount from `tables` Group BY `col` ORDER BY rowcount DESC;
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
        return view('frontend.table.exp', $data);
    }

    public function ResStore(Request $request){
         
        //  $validatedData = $request->validate([
        //      'num' => 'required|integer|unique:reservations',
        //      'maxcapacite' => 'integer',
        //  ]);
        //  $validatedData = $request->validate([
        //     'tel' => 'required|integer|unique:users',
        //     'email' => 'required|email|unique:users',
        // ]);

        // $user = new  User();
        // $user->email = $request->email;
        // $user->tel = $request->tel;
        // $user->password = '';
        // $user->save();
       
        
        
        // $data = new Reservation();
        // $data->heure_debut = $request->heure_debut ;
        // $data->heure_fin  = $request->heure_fin ;
        // $data->date_reservation  = $request->date_reservation ;
        // $data->nbrpersonne  = $request->nbrpersonne ;
        // $data->status  =  ($request->status == null) ? 1 : 0 ;
        // $data->payee  = ($request->payee == null) ? 1 : 0 ;
        // $data->client_id  = $request->client_id ;
        // $data->table_id  = $request->table_id ;
        // $data->save();
 
        //  $notification = array(
        //      'message' => ' inséré avec succès',
        //      'alert-type' => 'success'
        //  );
 
        //  $notification = "ajoutée avec succès";
        //return redirect()->route('yami.index')->with($notification);
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
