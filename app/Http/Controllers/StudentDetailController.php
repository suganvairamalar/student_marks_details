<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\TbStudentDetail;
use Validator;
use Session;
use Input;
use DB;


class StudentDetailController extends Controller
{
     public function index(Request $request){        
        if($request->search==""){           
             $student_details = TbStudentDetail::orderBy('id','desc')->paginate(5);           
           return view('student_details.student_detail_index',compact('student_details'));
        }
        else{
            $student_details = TbStudentDetail::orderBy('id','desc');
                   
                      if ($request->get('search_dropdown')=='student_name') {
                      $student_details->where('student_name','LIKE','%'.$request->get('search').'%');
                      }  
                      $student_details=$student_details->paginate(5);
                      $student_details->appends($request->only('search'));

            return view('student_details.student_detail_index',compact('student_details'));
        }
    }

   

    public function insert(Request $request){
       $rules = array(   'student_name'             => 'required'
                          );
        
        $error = Validator::make($request->all(),$rules);
        if($error->fails()){
            return response()->json(['errors'=>$error->errors()->all()]);
        }
        $form_data = array(  'student_name'           => $request->student_name
                             );
        //dd($form_data);
        TbStudentDetail::create($form_data);
        return response()->json(['success' => 'Data Inserted Successfully.']);
    }


    public function edit($id){
        if(request()->ajax()){
            $data = TbStudentDetail::findOrFail($id);
            return response()->json(['data'=> $data]);
        }

    }

    public function update(Request $request){
        $rules = array(  'student_name'             => 'required');
        
        $error = Validator::make($request->all(),$rules);
        if($error->fails()){
            return response()->json(['errors'=>$error->errors()->all()]);
        }
        $form_data = array( 'student_name'   => $request->student_name
                             );
        //dd($form_data);
        TbStudentDetail::whereId($request->hidden_id)->update($form_data);
        return response()->json(['success' => 'Data Updated Successfully.']);

    }

    public function delete($id){
        $data = TbStudentDetail::findOrFail($id);
        $data->delete();
    }

}
