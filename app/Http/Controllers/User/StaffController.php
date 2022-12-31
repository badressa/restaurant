<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    public function StaffView(){
    	$data['allData'] = User::where('type','admin')->get();
    	return view('backend.staff.index',$data);
     }
 
     public function staffAdd(){
         return view('backend.staff.staff_add');
     }
 
     public function staffStore(Request $request){

         $validatedData = $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|min:8|max:60|confirmed',
            'gender' => 'required',
         ]);
         
         if($request->role == 'admin' ){
            $data = new User();
            $data->name = $request->lname." ".$request->fname ;
            $data->email = $request->email?? null ;
            $data->password = Hash::make($request->password) ?? null ;
            $data->hbt = $request->hbt ?? null ;
            $data->fname = $request->fname ?? null ;
            $data->lname = $request->lname ?? null ;
            $data->tel = $request->tel ?? null ;
            $data->sexe = $request->gender ?? null ;
            $data->type = $request->type ?? null ;
            $data->role = $request->role ?? null ;
            $data->typesalaire = $request->typesalaire?? null ;
            $data->poste = $request->poste ?? null ;
            $data->etatserveur = $request->etatserveur ?? null ;
            $data->iddiplome = $request->iddiplome ?? null ;
            $data->save();
         }else{
             
            if(empty($request->session()->get('data'))){
                $data = new User();
                $data->fill($validatedData);
                $request->session()->put('data', $data);
            }else{
                $data = $request->session()->get('data');
                $data->fill($validatedData);
                $request->session()->put('data', $data);
            }
      
            return redirect()->route('staff.create.step.two');
         }
         
 
         $notification = array(
             'message' => 'le personelle inséré avec succès',
             'alert-type' => 'success'
         );
 
         return redirect()->route('staff.view')->with($notification);
     }



     
  
    /**
     * Show the step One Form for creating a new data.
     *
     * @return \Illuminate\Http\Response
     */
    public function createStepTwo(Request $request)
    {
        $data = $request->session()->get('data');
        return view('backend.staff.employee.create-step-two',compact('data'));
    }
  
    /**
     * Show the step One Form for creating a new data.
     *
     * @return \Illuminate\Http\Response
     */
    public function postCreateStepTwo(Request $request)
    {
        $validatedData = $request->validate([
            'salaire' => 'required',
        ]);
  
        $data = $request->session()->get('data');
        $data->fill($validatedData);
        $request->session()->put('data', $data);
  
        return redirect()->route('staff.create.step.three');
    }
  
    /**
     * Show the step One Form for creating a new data.
     *
     * @return \Illuminate\Http\Response
     */
    public function createStepThree(Request $request)
    {
        $data = $request->session()->get('data');
        return view('backend.staff.employee.create-step-three',compact('data'));
    }
  
    /**
     * Show the step One Form for creating a new data.
     *
     * @return \Illuminate\Http\Response
     */
    public function postCreateStepThree(Request $request)
    {
        $data = $request->session()->get('data');
        $data->save();
  
        $request->session()->forget('data');
  
        return redirect()->route('datas.index');
    }
 
     public function StaffEdit($id){
         
        $data['roles'] = User::select('role')->where('type', 'admin')->distinct()->get();
        $data['editData'] = User::find($id);

        return view('backend.staff.staff_edit',$data);
     }
 
     public function StaffUpdate(Request $request, $id){
        
        // make shure that email changed to add |unique:users , if not sys will throw error
        $validatedData = $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
        
         ]);
         
        
        $data = User::find($id);
            $data->name = $request->lname." ".$request->fname ;
            $data->email = $request->email ;
            $data->hbt = null ?? $request->hbt ;
            $data->fname = null ?? $request->fname ;
            $data->lname = null ?? $request->lname ;
            $data->tel = null ?? $request->tel ;
            $data->sexe = null ?? $request->gender ;
            $data->role = null ?? $request->role ;
        $data->save();

         $notification = array(
             'message' => 'le personel modifié avec succès',
             'alert-type' => 'success'
         );
 
         return redirect()->route('staff.view')->with($notification);
     }
 
     public function IngrediantStatusUpdate($id){
         
         $data = User::find($id);
         $data->status = !$data->status;
         $data->save();
 
         $notification = array(
             'message' => 'ingrediants modifié avec succès',
             'alert-type' => 'success'
         );
 
         return redirect()->route('ingrediant.view')->with($notification);
     }
 
     public function IngrediantDelete($id){
         
         $data = User::find($id);
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
