<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\TbStudentMark;
use App\TbStudentDetail;
use Validator;

class StudentMarkController extends Controller
{
    
	 public function index(){
    	$students = TbStudentDetail::all(['id','student_name']);     
      $marks = TbStudentMark::select('tb_student_marks.*','tb_student_details.student_name')
                  ->leftJoin('tb_student_details', 'tb_student_marks.student_id', '=', 'tb_student_details.id')
                  ->orderBy('tb_student_marks.id', 'desc')
                  ->paginate(5);
    	return view('student_marks.student_mark_index',compact('marks'),compact('students'));
    }

    
   

    public function insert(Request $request){
     
      $rules = [];

      //dd(array($request->input('myOptions')));
      //dd($request->input('mark1'));

      //$rules = array( 'student_id'     => 'required|not_in:0|unique:marks');

      $student_id = array($request->input('student_id'));

      foreach($student_id  as $key => $value) {
            $rules["student_id.{$key}"] = 'required|not_in:0';
        }

      foreach($request->input('mark1') as $key => $value) {
            $rules["mark1.{$key}"] = 'required|numeric';
        }
      foreach($request->input('mark2') as $key => $value) {
            $rules["mark2.{$key}"] = 'required|numeric';
        }
      foreach($request->input('mark3') as $key => $value) {
            $rules["mark3.{$key}"] = 'required|numeric';
        }     
      foreach($request->input('total') as $key => $value) {
            $rules["total.{$key}"] = 'required|numeric';
        }     
      foreach($request->input('rank') as $key => $value) {
            $rules["rank.{$key}"] = 'required';
        }  
       foreach($request->input('result') as $key => $value) {
            $rules["result.{$key}"] = 'required';
        }       

      $error = Validator::make($request->all(), $rules);
      if($error->fails())
      {
       return response()->json(['error'  => $error->errors()->all()]);
      }     

     /* $form_data = array('student_id' => $request->student_id,
                         'mark1' => $request->mark1,
                         'mark2' => $request->mark2,
                         'mark3' => $request->mark3,
                         'mark4' => $request->mark4,
                         'mark5' => $request->mark5,
                         'total' => $request->total,
                         'percentage' => $request->percentage,
                         'rank' => $request->rank
                        );*/

     $marks  = Input::only('student_id','mark1','mark2','mark3','total','rank','result');

            $student_id   = $marks['student_id'];
            $mark1        = $marks['mark1'];
            $mark2        = $marks['mark2'];
            $mark3        = $marks['mark3'];
            $total        = $marks['total'];           
            $rank         = $marks['rank'];
            $result       = $marks['result'];

            foreach( $student_id as $key => $n ) {
                TbStudentMark::create(
                    array(
                        'student_id'      => $student_id[$key],
                        'mark1'           => $mark1[$key],                   
                        'mark2'           => $mark2[$key],                   
                        'mark3'           => $mark3[$key],                   
                                          
                        'total'           => $total[$key],                   
                              
                        'rank'            => $rank[$key],     

                        'result'          => $result[$key]              
                    )
                );
            }
      
      return response()->json(['success' => 'Data Inserted Successfully.']);
  
    
    }

    public function find_rank(Request $request){
            $data = TbStudentMark::all(['id','student_id','total']); 
            return response()->json($data);
    }

  public function edit($id){
    if(request()->ajax()){
        $data = TbStudentMark::findOrFail($id);       
        return response()->json(['data' => $data]);
      }
   }


   public function update(Request $request){
    
        $rules = array( 'edit_student_id' => 'required',
                        'edit_mark1'      => 'required',
                        'edit_mark2'      => 'required',
                        'edit_mark3'      => 'required',
                        'edit_total'      => 'required',
                        'edit_rank'       => 'required',
                        'edit_result'     => 'required',
         );
        $error = Validator::make($request->all(),$rules);
        if($error->fails()){
            return response()->json(['errors'=>$error->errors()->all()]);
        }
        $form_data = array('student_id'   => $request->edit_student_id,
                            'mark1'       => $request->edit_mark1, 
                            'mark2'       => $request->edit_mark2, 
                            'mark3'       => $request->edit_mark3,
                            'total'       => $request->edit_total, 
                            'rank'        => $request->edit_rank,
                            'result'      => $request->edit_result
                            
                             );
        
        TbStudentMark::whereId($request->hidden_id)->update($form_data);
        return response()->json(['success' => 'Data Updated Successfully.']);

    }

     public function delete($id){
        $data = TbStudentMark::findOrFail($id);
        $data->delete();
    }









}
