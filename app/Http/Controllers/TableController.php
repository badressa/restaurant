<?php

namespace App\Http\Controllers;

use App\Models\Table;
use Illuminate\Http\Request;

class TableController extends Controller
{
    public function TableView(){
        $data['alldata'] = Table::all();
        return view('backend.tables.index', $data);
     }
 
     public function TableAdd(){
         return view('backend.tables.table_add');
     }
 
     public function TableStore(Request $request){
         
         $validatedData = $request->validate([
             'num' => 'required|integer|unique:tables',
             'maxcapacite' => 'integer',
    
         ]);

         $data = new Table();
         $data->num = $request->num;
         $data->maxcapacite = $request->maxcapacite;
         $data->status = ($request->status==null) ? 1 : 0;
         $data->location = $request->location;
         $data->save();
 
         $notification = array(
             'message' => 'User Inserted Successfully',
             'alert-type' => 'success'
         );
 
         return redirect()->route('table.view')->with($notification);
     }
 
     public function TableEdit($id){
 
         $editData = Table::find($id);
         return view('backend.tables.table_edit',compact('editData'));
     }
 
     public function TableUpdate(Request $request, $id){

        $data = Table::find($id);

        if($request->num!=$data->num){
            $validatedData = $request->validate([
                'num' => 'required|integer|unique:tables',
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
             'message' => 'table modifié avec succès',
             'alert-type' => 'success'
         );
 
         return redirect()->route('table.view')->with($notification);
     }
 
     public function TableStatusUpdate($id){
         
         $data = Table::find($id);
         $data->status = !$data->status;
         $data->save();
 
         $notification = array(
             'message' => 'table modifié avec succès',
             'alert-type' => 'success'
         );
         
         return redirect()->route('table.view')->with($notification);
     }
}
