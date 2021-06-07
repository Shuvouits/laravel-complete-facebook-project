<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function index(){
        $get_data = "SELECT * FROM students";
        $run_data = DB::select($get_data);
        $data = $run_data;
        
        return $run_data;
      // return view('table', compact('data'));
    }

    public function store(Request $request){
        $ID = $request->input('ID');
        $Name = $request->input('Name');
        $Department = $request->input('Department');
        $City = $request->input('City');
        $Phone = $request->input('Phone');

        //$get_data_insert = "INSERT INTO students (ID, Name, Department, City, Phone) VALUES ('$ID','$Name','$Department','$City','$Phone')";
        //$run_data = DB::select($get_data_insert);
        $get_data_insert = "INSERT INTO students (ID, Name, Department, City, Phone) VALUES ('$ID','$Name','$Department','$City','$Phone') ";
        $run_data = DB::select($get_data_insert);

        if($run_data){
            return "Inserted";
        }else{
            return "Data is not insert";
        }
        
    }

    public function delete($id){
        $get_data = "DELETE FROM students WHERE ID = $id";
        $run_data = DB::select($get_data);
        //return redirect('/data');
        return 'Data Deleted Successfully';

    }

    public function edit(Request $request, $id){
        $Name = $request->input('Name');
        $Department = $request->input('Department');
        $City = $request->input('City');
        $Phone = $request->input('Phone');
        $get_data = "UPDATE students SET Name='$Name', Department='$Department', City='$City', Phone='$Phone' WHERE ID=$id ";
        $run_data = DB::select($get_data);
        //return redirect('/data');

        if($run_data){
            return 'Data is not Update';
        }else{
            return 'data is Updated';
        }
    }

    public function hellow(Request $request)
    {
        $email = $request->input('email');
        echo $email;
    }

}
