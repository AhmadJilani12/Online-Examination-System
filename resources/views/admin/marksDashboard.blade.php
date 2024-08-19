
@extends('layout.admin-layout')


@section('space-work')

<h2 class="mb-4">Marks</h2>



  <table class="table table-striped table-borderd mt-3">

    <thead>
        <tr>
            <th>#</th>
            <th>Exam Name</th>
            <th>Marks/Q</th>
            <th>Total Marks</th>
            <th>Passing Marks</th>
            <th>Edit</th>

          
         
        </tr>
        
    </thead>

    <tbody>

  @if (count($exam)>0)

  @php
      $count=1;
  @endphp
   
  @foreach ($exam as $ex)
   <tr>
    <td>{{$count++}}</td>
    <td>{{$ex->exam_name}}</td>
    <td>{{$ex->marks}}</td>
    <td>{{ count($ex->getQnaExam) * $ex->marks }}</td>
    <td>{{ $ex->pass_marks }}</td>
   
    <td> 
        <button class="btn btn-primary editMarks" data-id="{{$ex->id}}"  data-pass-marks="{{$ex->pass_marks}}"  data-Marks="{{$ex->marks}}" data-totalq="{{ count($ex->getQnaExam) }}"  data-toggle="modal" data-target="#editMarks">Edit</button>
    </td>
   </tr>
      
  @endforeach

  @else
      <tr>
        <td colspan="5">Exams not Found</td>
      </tr>
  @endif
    </tbody>
  </table>


  


  <!--Edit Exam Modal -->
  <div class="modal fade" id="editMarks" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">

      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Marks</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="MarkChange">
          @csrf
        <div class="modal-body">
            <input type="hidden" name="exam_id" id="exam_id">
  <div class="row">

    <div class="col-sm-3">
      <label >Marks/Q</label>
    </div>

    <div class="col-sm-6">
    
        <input type="text" 
        onkeypress="return  event.charCode >= 48 &&  event.charCode <=57 || event.charCode == 46"
        name="marks" id="marks" placeholder="Enter Marks/Q" required>

    </div>

  </div>

  <div class="row mt-3">

    <div class="col-sm-3">
      <label >Total Marks</label>
    </div>

    <div class="col-sm-6">
        
        
        <input type="text" disabled  placeholder="TotalMarks" id="tmarks">

    </div>

  </div>







  <div class="row mt-3">

    <div class="col-sm-3">
      <label >Passing  Marks</label>
    </div>

    <div class="col-sm-6">
        
      <input type="text" 
      onkeypress="return  event.charCode >= 48 &&  event.charCode <=57 || event.charCode == 46"
      name="passmarks" id="passmarks" placeholder="Enter Passing Marks" required>
        

    </div>

  </div>


        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Update Marks</button>
          </div>

    </form>
        
      </div>
 

    </div>
  </div>


<script>

    $(document).ready(function(){
        var totalqna =0;
$('.editMarks').click(function(){
  var exam_id = $(this).attr('data-id');
  var marks = $(this).attr('data-Marks');
  var totalq = $(this).attr('data-totalq');
  

  

  $("#marks").val(marks);
  $("#exam_id").val(exam_id);
  $("#tmarks").val((marks*totalq).toFixed(1));
  $("#passmarks").val( $(this).attr('data-pass-marks'));



  totalqna=totalq;

  
});

$("#marks").keyup(function(){

    
  $("#tmarks").val(($(this).val() * totalqna ).toFixed(1));
});

$("#passmarks").keyup(function(){

  
});


   $("#MarkChange").submit(function(e){
  e.preventDefault();


  $(".pass-error").remove();
    var tmarks = $("#tmarks").val();
    
    var passmarks = $("#passmarks").val();

    if( parseFloat(passmarks) >= parseFloat(tmarks))
    {

      $("#passmarks").parent().append('<p style="color:red;" class="pass-error">Passing Marks will be less than total Marks!!    </p>');

      setTimeout(() => {
        
        $(".pass-error").remove();
        
      }, 2000);

      return false;
    }

 var formData = $(this).serialize();
  $.ajax({

     url:"{{ route('updateMarks') }}",
     type:"POST",
     data:formData,
     success:function(data){

        if(data.success == true) {

            location.reload();
        }
        else{
            alert(data.msg);
        }
     }
  });
   });


    });
</script>






  
  


@endsection

