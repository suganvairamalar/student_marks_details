 @if(!empty($student_details))               
               <table class="table table-striped table-bordered table-hover" width="100%">
                  <thead>  
                   <form id="student_detail_search_form" action="/student_details">  
                  <tr>
                      <td class="col-md-3 col-lg-3 col-xs-3 col-sm-3"><select class="form-control" name="search_dropdown" id="search_dropdown">
                          <option value="">Select Search</option>
                          <option value="student_name">STUDENT NAME</option>                         
                        </select></td>
                           <td class="col-md-3 col-lg-3 col-xs-3 col-sm-3" >
                           {{ csrf_field() }}
                           {{ method_field('GET') }}
                           <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                           <input type="text" class="form-control" name="search" id="search">
                     </td>
                     <td class="col-lg-2 col-xs-2 col-sm-2 col-md-2">
                     <button type="submit" class="btn btn-warning" id="student_detail_search_submit" name="student_detail_search_submit">
                     <span class="glyphicon glyphicon-search"></span></button> 
                     <a href="{{route('student_detail.index')}}" class="btn btn-primary"><span class="reloadbtn glyphicon glyphicon-refresh"></span></a>                     
                     </td>                     
                  </tr>   
                  </form>              
                     <tr class="bg-primary">
                        <th class="col-lg-1 col-xs-1 col-sm-1 col-md-1">S.NO</th>
                        <th class="col-lg-4 col-xs-4 col-sm-4 col-md-4">NAME</th>                        
                        <th class="col-lg-4 col-xs-4 col-sm-4 col-md-4">ACTION</th>
                     </tr>
                  </thead>
                  <tbody >
                     <?php $i=0; ?>
                     @foreach($student_details as $student_detail)
                     <?php $i++; ?>
                     <tr>
                        <td  class="col-xs-1 col-sm-1 col-md-1">{{ $i }}</td>                       
                        <td  class="col-lg-4 col-xs-4 col-sm-4 col-md-4">{{ $student_detail->student_name }}</td>
                      
                        <td  class="col-lg-4 col-xs-4 col-sm-4 col-md-4">
                           <!-- class="btn btn-info glyphicon glyphicon-th detailbtn" -->
                           <button type="button" name="edit" id="{{ $student_detail->id }}" class="edit btn btn-warning glyphicon glyphicon-edit btn-md"></button> <!-- class="btn btn-warning btn-sm editbtn" -->
                           <button type="button" name="delete" id="{{ $student_detail->id }}" class="delete btn btn-danger glyphicon glyphicon-trash btn-md"></button> <!-- class="btn btn-danger btn-sm deletebtn" -->
                        </td>
                     </tr>
                     @endforeach       
                  </tbody>
               </table>
            @endif    
            {!! $student_details->appends(Request::capture()->except('page'))->render() !!}
            <!-- {!!$student_details->render()!!}  -->