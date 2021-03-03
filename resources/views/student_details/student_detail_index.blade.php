@extends('layouts.student_detail_app')
@section('content')

<div class="row">
   <meta name="csrf-token" content="{{ csrf_token() }}">
   <div class="panel-body">
      <div class="col-xs-7 col-sm-7 col-md-7">
         <div class="table-responsive">
            <div class="panel panel-default">      				
               @include('student_details.student_detail_list')   
            </div>
         </div>
      </div>
      <div class="col-xs-5 col-sm-5 col-md-5">
         <div class="table-responsive">
            <div class="panel panel-default">
               <div class="header_student_detail_form panel-heading">STUDENT ADD DATA</div>
               <form method="get" id="student_detail_form">
                  <span id="student_detail_form_result"></span>
                  {{ csrf_field() }}
                  <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}"> 
                  <div class="form-group">
                     <label for="student_name">NAME</label>
                     <input type="text" class="form-control" name="student_name" id="student_name" placeholder="Enter Student Name">
                  </div> 
                  <input type="hidden" name="hidden_id" id="hidden_id" class="form-control">
                  <input type="hidden" name="student_action" id="student_action" value="ADD" />                  
                  <button type="button" class="btn btn-danger" id="reset" data-dismiss="modal">RESET</button>
                  <input type="submit" name="student_action_button" id="student_action_button" class="btn btn-success" value="ADD">
               </form>
            </div>
         </div>
      </div>
   </div>
</div>

<div class="row">
      <div id="student_detail_confirm_Modal" class="modal fade" role="dialog">
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
                  <button type="button" name="student_detail_ok_button" id="student_detail_ok_button" class="btn btn-danger">OK</button>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
               </div>
            </div>
         </div>
      </div>
   </div>
@endsection