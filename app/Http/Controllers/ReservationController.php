<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Table;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function ResView(){

            // Declare two dates
                // $start_date = strtotime(date('Y-m-d', strtotime('-30 days')) );
                // $end_date = strtotime(date('Y-m-d'));
                
                // // Get the difference and divide into
                // // total no. seconds 60/60/24 to get
                // // number of days

                //     dd( ($end_date - $start_date)/60/60/24 );

        //Declare two dates from current date to end 
        // $from = date('Y-m-d') ;// in current time not included mine date with daytimestamp
        // $to = date("Y-m-t", strtotime($from) );
        
        // $data['alldata'] = Reservation::whereBetween('date_reservation', [$from, $to])->get();
        $data['alldata'] = Reservation::with(['client','table'])->get();
      
        return view('backend.reservations.index', $data);
     }
 
     public function ResAdd(){
         //or add name and day of birth to verify client
         $data['clients'] = Table::all();
         $data['clients'] = User::all();

         return view('backend.reservations.reservation_add');
     }
     //fucntion getclient for getting client with json
 
     public function ResStore(Request $request){
         
        //  $validatedData = $request->validate([
        //      'num' => 'required|integer|unique:reservations',
        //      'maxcapacite' => 'integer',
        //  ]);
       
        
        
        $data = new Reservation();
        $data->heure_debut = $request->heure_debut ;
        $data->heure_fin  = $request->heure_fin ;
        $data->date_reservation  = $request->date_reservation ;
        $data->nbrpersonne  = $request->nbrpersonne ;
        $data->status  =  ($request->status == null) ? 1 : 0 ;
        $data->payee  = ($request->payee == null) ? 1 : 0 ;
        $data->client_id  = $request->client_id ;
        $data->table_id  = $request->table_id ;
        $data->save();
 
         $notification = array(
             'message' => ' inséré avec succès',
             'alert-type' => 'success'
         );
 
         return redirect()->route('reservation.view')->with($notification);
     }
 
     public function ResEdit($id){
 
         $editData = Reservation::find($id);
         return view('backend.reservations.reservation_edit',compact('editData'));
     }
 
     public function ResUpdate(Request $request, $id){

        $data = Reservation::find($id);

        if($request->num!=$data->num){
            $validatedData = $request->validate([
                'num' => 'required|integer|unique:reservations',
                'maxcapacite' => 'integer',
             ]);
        }else{
            $validatedData = $request->validate([
                'num' => 'required|integer',
                'maxcapacite' => 'integer',
             ]);
        }
         
        $data->num = $request->num;
        $data->maxcapacite = $request->maxcapacite;
        $data->status = ($request->status==null) ? 1 : 0;
        $data->location = $request->location;
        $data->save();
 
        $notification = array(
            'message' => 'reservation modifié avec succès',
            'alert-type' => 'success'
        );
 
        return redirect()->route('reservation.view')->with($notification);
     }
 
     public function ResStatusUpdate($id){
         
        $data = Reservation::find($id);
        $data->status = !$data->status;
        $data->save();

        $notification = array(
            'message' => 'reservation modifié avec succès',
            'alert-type' => 'success'
        );

        return redirect()->route('reservation.view')->with($notification);

     }



     public function GetClients(Request $request){
    	// $year_id = $request->year_id;
    	// $class_id = $request->class_id;
    	// $allData = AssignStudent::with(['student'])->where('year_id',$year_id)->where('class_id',$class_id)->get();
    	// return response()->json($allData);
        
        $type = 0;
        if(isset($request->type)){
            $type = $request->type;
        }
        // Search result
        if($type == 1){
            

            $result = User::where('name','like','%'.$request->search.'%')->get();

            $search_arr = array();

            // while($fetch = mysqli_fetch_assoc($result)){
            //     $id = $fetch['id'];
            //     $name = $fetch['name'];

            //     $search_arr[] = array("id" => $id, "name" => $name);
            // }

            return response()->json($result);
        }

        // get User data
        if($type == 2){
            
            $result = User::where('id','=',$request->userid)->get();

            // $return_arr = array();
            // while($fetch = mysqli_fetch_assoc($result)){
            //     $username = $fetch['username'];
            //     $email = $fetch['email'];

            //     $return_arr[] = array("username"=>$username, "email"=> $email);
            // }

            return response()->json($result);
        }

    }

    public function GetTables(Request $request){
    	
        
        $type = 0;
        if(isset($request->type)){
            $type = $request->type;
        }
        // Search result
        if($type == 1){
            

            $result = Table::where('num','like','%'.$request->table_search.'%')->get();

            $search_arr = array();

            return response()->json($result);
        }

        // get User data
        if($type == 2){
            
            $result = Table::where('id','=',$request->tableid)->get();
            return response()->json($result);
        }

    }

}
