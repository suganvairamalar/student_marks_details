@extends('layouts.student_mark_app')
@section('content')
<div class="jumbotron">
   <div class="row">
      <div class="pull-left">
         <button type="button" name="mark_create_record" id="mark_create_record" class="btn btn-success btn-sm">MARK ADD</button>
      </div>
      <div class="pull-right">
      </div>
   </div>
   <div class="row">
      @include('student_marks.student_mark_list')   
   </div>
</div>

<div class="row">
   <div id="mark_form_Modal" class="modal fade" role="dialog">
      <div class="modal-dialog modal-xl">
         <div class="modal-content">
            <div class="modal-header bg-danger">
               <label class="modal-title">MARK ADD FORM</label>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="start_cloes"><span aria-hidden="true">&times;</span>
               </button>
            </div>
            <form method="post" id="mark_form">
               <span id="mark_form_result"></span>
               <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
               {{ csrf_field() }}
               <div class="modal-body">
                  <div class="table-responsive" id="detailMark" class="detailMark">
                     <table id="tbl_detailMark" width="100%"  border="0">
                        <tbody>
                        <thead>
                           <tr class="">
                              <th class="col-xs-2 col-sm-2 col-md-2">STUDENT NAME</th>
                              <th class="col-xs-1 col-sm-1 col-md-1">MARK1</th>
                              <th class="col-xs-1 col-sm-1 col-md-1">MARK2</th>
                              <th class="col-xs-1 col-sm-1 col-md-1">MARK3</th>                             
                              <th class="col-xs-1 col-sm-1 col-md-1">TOTAL</th>                             
                              <th class="col-xs-1 col-sm-1 col-md-1">RANK</th>
                               <th class="col-xs-1 col-sm-1 col-md-1">RESULT</th>
                              <th class="col-xs-1 col-sm-1 col-md-1"><button type="button" class="btn btn-success" name="btn_add_mark" id="btn_add_mark"><span class="glyphicon glyphicon-plus"></span></button></th>
                           </tr>
                        </thead>
                        <tr id="data_tr" class="data_tr">
                           <td class="col-xs-2 col-sm-2 col-md-2 tdselect">
                              <select class="form-control student_id" name="student_id[]" id="student_id">
                                 <option disabled="disabled" selected="true" value="0">Select Student</option>
                                 @foreach($students as $student)
                                 <option value="{!!$student->id!!}">{!!$student->student_name!!}</option>
                                 @endforeach
                              </select>
                           </td>
                           <td class="col-xs-1 col-sm-1 col-md-1 td2"><input type="text" name="mark1[]" id="mark1" class="form-control name"  placeholder=""/></td>
                           <td class="col-xs-1 col-sm-1 col-md-1 td2"><input type="text" name="mark2[]" id="mark2" class="form-control name"  placeholder="" /></td>
                           <td class="col-xs-1 col-sm-1 col-md-1 td2"><input type="text" name="mark3[]" id="mark3" class="form-control name"  placeholder="" /></td>
                         
                           <td class="col-xs-1 col-sm-1 col-md-1 td2"><input type="text" name="total[]" id="total" class="form-control total" readonly placeholder="" />                             
                           </td>                          
                           <td class="col-xs-1 col-sm-1 col-md-1 td2"><input type="text" name="rank[]" id="rank" class="form-control rank" placeholder="" /><span id="rank_span" style="display:none"></span></td>
                            <td class="col-xs-1 col-sm-1 col-md-1 td2"><input type="text" name="result[]" id="result" class="form-control result"  placeholder="" />
                              <span id="result_span" style="display:none"></span>
                            </td>
                           <td class="col-xs-1 col-sm-1 col-md-1 td1"><button type="button" class="btn btn-danger" name="btn_remove_mark" id="btn_remove_mark" class="btn btn-remove"><span class="glyphicon glyphicon-remove"></span></button>
                           </td>
                        </tr>
                        </tbody>
                     </table>
                     <b>Number of row(s):</b> <span id="counter" style="color:#FF69B4;font-size:16px;font-weight: bold;font-style: italic;"></span>         
                  </div>
               </div>
               <div class="modal-footer bg-danger">
                  <input type="hidden" name="mark_action" id="mark_action" />  
                  <button type="button" class="btn btn-secondary" id="cloes" data-dismiss="modal">CLOSE</button>     
                  <input type="submit" name="mark_action_button" id="mark_action_button" class="btn btn-primary" value="ADD">
               </div>
            </form>
         </div>
      </div>
   </div>
</div>

<div class="row">
   <div id="edit_mark_form_Modal" class="modal fade" role="dialog">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header bg-primary">
              <label class="modal-title">EDIT THE RECORD</label>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="start_cloes"><span aria-hidden="true">&times;</span>
               </button>
            </div>
            <form method="post" id="edit_mark_form" class="form-horizontal edit_mark_form">
               <div class="modal-body bg-success">
                  <span id="edit_mark_form_result"></span>
                  {{ csrf_field() }}
                  <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                 
                  <div class="form-group">
                     <label class="control-label1 col-md-4 col-lg-4 col-xs-4 col-sm-4">STUDENT</label>
                     <div class="col-md-8 col-lg-8 col-xs-8 col-sm-8">
                        <select class="form-control" name="edit_student_id" id="edit_student_id" disabled="disabled">
                           <option disabled="disabled" selected="true" value="0">Select Student</option>
                           @foreach($students as $student)
                           <option value="{!!$student->id!!}">{!!$student->student_name!!}</option>
                           @endforeach
                        </select>
                     </div>
                  </div>

                  <div class="form-group">
                     <label class="control-label1 col-md-4 col-lg-4 col-xs-4 col-sm-4">MARK1</label>
                     <div class="col-md-8 col-lg-8 col-xs-8 col-sm-8">
                        <input type="text" class="form-control editmark" name="edit_mark1" id="edit_mark1" placeholder="Enter a Mark1">
                     </div>
                  </div>

                  <div class="form-group">
                     <label class="control-label1 col-md-4 col-lg-4 col-xs-4 col-sm-4">MARK2</label>
                     <div class="col-md-8 col-lg-8 col-xs-8 col-sm-8">
                        <input type="text" class="form-control editmark" name="edit_mark2" id="edit_mark2" placeholder="Enter a Mark2">
                     </div>
                  </div>

                  <div class="form-group">
                     <label class="control-label1 col-md-4 col-lg-4 col-xs-4 col-sm-4">MARK3</label>
                     <div class="col-md-8 col-lg-8 col-xs-8 col-sm-8">
                        <input type="text" class="form-control editmark" name="edit_mark3" id="edit_mark3" placeholder="Enter a Mark3">
                     </div>
                  </div>

                  
                  <div class="form-group totalmark">
                     <label class="control-label1 col-md-4 col-lg-4 col-xs-4 col-sm-4">TOTAL</label>
                     <div class="col-md-8 col-lg-8 col-xs-8 col-sm-8">
                        <input type="text" class="form-control edit_total" name="edit_total" id="edit_total" readonly placeholder="Enter a Total">
                     </div>
                  </div>                

                  <div class="form-group">
                     <label class="control-label1 col-md-4 col-lg-4 col-xs-4 col-sm-4">RANK</label>
                     <div class="col-md-8 col-lg-8 col-xs-8 col-sm-8">
                        <input type="text" class="form-control edit_rank" name="edit_rank" id="edit_rank" placeholder="Enter a Total">
                     </div>
                  </div>

                   <div class="form-group">
                     <label class="control-label1 col-md-4 col-lg-4 col-xs-4 col-sm-4">RESULT</label>
                     <div class="col-md-8 col-lg-8 col-xs-8 col-sm-8">
                        <input type="text" class="form-control" name="edit_result" id="edit_result" placeholder="Enter a result">
                     </div>
                  </div>

               </div>
               <div class="modal-footer bg-primary">
                  <input type="hidden" name="hidden_id" id="hidden_id" class="form-control"> 
                  <input type="hidden" name="hidden_edit_student_id" id="hidden_edit_student_id" class="form-control"> 
                  <input type="hidden" name="hidden_edit_rank" id="hidden_edit_rank" class="form-control"> 
                  <input type="hidden" name="hidden_edit_total" id="hidden_edit_total" class="form-control">
                  <input type="hidden" name="hidden_edit_result" id="hidden_edit_result" class="form-control">

                  <button type="button" class="btn btn-success" id="cloes" data-dismiss="modal">CLOSE</button>     
                  <input type="submit" name="edit_mark_action_button" id="edit_mark_action_button" class="btn btn-warning" value="UPDATE">
               </div>
            </form>
         </div>
      </div>
   </div>
</div>

<div class="row">
      <div id="student_mark_confirm_Modal" class="modal fade" role="dialog">
         <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header bg-danger">
                  <label class="modal-title">CONFIRMATION</label>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
               </div>
               <div class="modal-body">
                  <p style="color:red;font-size:16px;font-weight: bold;font-style: italic;">Are you sure !! want to delete this record?</p>
               </div>
               <div class="modal-footer bg-danger">
                  <button type="button" name="student_mark_ok_button" id="student_mark_ok_button" class="btn btn-danger">OK</button>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
               </div>
            </div>
         </div>
      </div>
   </div>
@endsection