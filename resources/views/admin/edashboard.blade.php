@extends('layout.admin-layout')


@section('space-work')

<h2 class="mb-4">Exams</h2>





<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addExamModal">
   Add Exam
  </button>
  




<table class="table table-striped table-borderd mt-3">

    <thead>
<tr>

    <th>#</th>
    <th>Exam Name</th>
    <th>Subject</th>
    <th>Date</th>
    <th>Time</th>
    <th>Attempt</th>
    <th>Add Questions</th>
    <th>Edit</th>
<th>Delete</th>

</tr>

    </thead>

    <tbody>
        @if (count($exam)>0)

@foreach ($exam as $ex )

<tr>
    <td>{{$ex->id}}</td>
    <td>{{$ex->exam_name}}</td>
    <td>{{$ex->subjects->subject}}</td>
    <td>{{$ex->date}}</td>
    <td>{{$ex->time}} Hrs</td>
    <td>{{$ex->attempt}} Time</td>
    <td> 

      <a href="" class="addQuestion" data-id="{{$ex->id}}"  data-toggle="modal" data-target="#addQnaModal"  >Add Question</a>
    </td>
    <td>
      <button class="btn btn-info editButton" data-id="{{$ex->id}}" data-toggle="modal" data-target="#editExamModal">Edit</button>
   

    </td>

    <td>
      <button class="btn btn-danger deleteButton" data-id="{{$ex->id}}" data-toggle="modal" data-target="#deleteExamModal">Delete</button>
    </td>

    
</tr>


@endforeach
    

        @else
        <tr>
            <td colspan="5">Exam not Found</td>
        </tr>
        @endif
    </tbody>

</table>



  <!--Edit Exam Modal -->
  <div class="modal fade" id="editExamModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">

      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Edit Exam</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="editExam"> 

          @csrf

          <input type="hidden" name="exam_id" id="exam_id" />
        <div class="modal-body">

        <input type="text" name="exam_name" id="exam_name" placeholder="Enter Exam name" class="w-100"  required/>
<br/><br/>

<select name="subject_id" id="subject_id" required  class="w-100">

    <option value="">Select Subject</option>

    @if (count($subjects)>0)

    @foreach ($subjects as $subject)
    <option value="{{$subject->id}}">{{$subject->subject}}</option>
    
    @endforeach
        
    @endif
</select>


<br/><br/>


<input type="date" name="date" id= "date" class="w-100"  required min="@php echo date('Y-m-d'); @endphp"/>

<br/><br/>


<label for="hours">Duration Hours:</label>
<input type="number" id="hours" name="hours" min="0" class="w-100" required><br><br>

<label for="minutes">Duration Minutes:</label>
<input type="number" id="minutes" name="minutes" min="0" max="59" class="w-100" required><br><br>


<label for="attempt">Attempt:</label>

<input type="number" id="attempt" name="attempt" placeholder="Enter Exam Attempt Time" min="1" class="w-100" required><br><br>

        </div>


        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Update </button>
        </div>


        </form>
     
      </div>
 

    </div>
  </div>







  <!--Delete Exam Modal -->
  <div class="modal fade" id="deleteExamModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">

      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Delete Exam</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="deleteExam"> 

          @csrf

          <input type="hidden" name="delete_exam_id" id="delete_exam_id" />
        <div class="modal-body">

<p>Are you Sure you want to delete this ?</p>       


        </div>


        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">Delete </button>
        </div>


        </form>
     
      </div>
 

    </div>
  </div>


  
  <!--Add  Question Modal -->
  <div class="modal fade" id="addQnaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">

      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Add Q&A</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="addQna"> 
          @csrf
        <div class="modal-body">  
          
          <input type="hidden" name="exam_id" id="addExamId"/>

         <input type="search" name="search" class="w-100" placeholder="Search here"/>

         <br>
         <br>

         <table class="table">

          <thead>
            <th>Select</th>
            <th>Question</th>
          </thead>

          <tbody class="addBody">

          </tbody>
         </table>

       

        



        </div>


        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add Q&A </button>
        </div>


        </form>
     
      </div>
 

    </div>
  </div>






















  
  <!--Add Exam Modal -->
  <div class="modal fade" id="addExamModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">

      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Add Exam</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="addExam"> 
          @csrf

        <div class="modal-body">

        <input type="text" name="exam_name" placeholder="Enter Exam name" class="w-100"  required/>
<br/><br/>

<select name="subject_id" required  class="w-100">

    <option value="">Select Subject</option>

    @if (count($subjects)>0)

    @foreach ($subjects as $subject)
    <option value="{{$subject->id}}">{{$subject->subject}}</option>
    
    @endforeach
        
    @endif
</select>


<br/><br/>


<input type="date" name="date" class="w-100"  required min="@php echo date('Y-m-d'); @endphp"/>

<br/><br/>



<label for="hours">Duration Hours:</label>
<input type="number" id="hours" name="hours" min="0" class="w-100" required><br><br>

<label for="minutes">Duration Minutes:</label>
<input type="number" id="minutes" name="minutes" min="0" max="59" class="w-100" required><br><br>


<label for="attempt">Attempt:</label>

<input type="number" id="attempt" name="attempt" placeholder="Enter Exam Attempt Time" min="1" class="w-100" required><br><br>

        </div>


        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add Exam</button>
        </div>


        </form>
     
      </div>
 

    </div>
  </div>


<script>

$(document).ready(function(){

    $("#addExam").submit(function(e){

        e.preventDefault();
        
        var formData = $(this).serialize();
        $.ajax({

url:"{{route('addExam')}}",
type:"POST",
data:formData,
success:function(data){

if(data.success== true){

location.reload();
}
else{

    alert(data.msg);
}

}});
        });





        $("#editExam").submit(function(e){

e.preventDefault();

var formData = $(this).serialize();
$.ajax({

url:"{{route('updateExam')}}",
type:"POST",
data:formData,
success:function(data){

if(data.success== true){

location.reload();
}
else{

alert(data.msg);
}

}});
});



















$(".editButton").click(function(){

var id=$(this).attr("data-id");

$("#exam_id").val(id);

$url='{{route("getExamDetail","id")}}';


$url=$url.replace('id',id);


$.ajax({

  url:$url,
  type:"GET",
success:function(data){

  if(data.success == true){

console.log(data.data);

    var exam=data.data;

    $("#exam_name").val(exam[0].exam_name);
    $("#subject_id").val(exam[0].subject_id);
    $("#date").val(exam[0].date);
    $("#attempt").val(exam[0].attempt);

     var time =exam[0].time;


   
   var timearr=  time.split(":");
  
   var hour = parseInt(timearr[0], 10);
var min = parseInt(timearr[1], 10);

console.log("Hour:", hour); 
console.log("Minutes:", min);

$("#hours").val(hour);
$("#minutes").val(min);
    

}
else{

  alert(data.msg);
}


}
});

});

//delete Exam

$(".deleteButton").click(function(){


var id=$(this).attr('data-id');
$("#delete_exam_id").val(id);



});





$("#deleteExam").submit(function(e){

e.preventDefault();

var formData = $(this).serialize();
$.ajax({

url:"{{route('deleteExam')}}",
type:"POST",
data:formData,
success:function(data){

if(data.success== true){

location.reload();
}
else{

alert(data.msg);
}

}});
});



   //add question part 

   $(".addQuestion").click(function(){
   

  var id =  $(this).attr("data-id");

  $("#addExamId").val(id);


         $.ajax({
          
          url:"{{route('getQuestions')}}",
          type:"GET",
        data:{exam_id:id},

        success:function(data)
        {
           if(data.success ==true){

          var questions =   data.data;
          var html ='';

          if(questions.length >0)
          {
                 for(let i=0; i<questions.length; i++)
                 {

                  html += `
                    <tr>  <td> <input type="checkbox" value ="`+questions[i]['id']+`" name="question_ids[]"  </td> 
                      
                         <td> `+questions[i]['question']+`   </td>
                      </tr>
                  `;
                 }
          }
          else{
        html += `
          <tr> <td colspan="2">Questions not Availble </td>  </tr>
        `

          }
     


          $('.addBody').html(html);
           }
           else{
            alert(data.msg);
           }
          
        }

         });

    

   });

 

   

$("#addQna").submit(function(e){

e.preventDefault();

var formData = $(this).serialize();
$.ajax({

url:"{{route('addquestions')}}",
type:"POST",
data:formData,
success:function(data){

if(data.success== true){

location.reload();
}
else{

alert(data.msg);
}

}});
});






    });



</script>







@endsection
