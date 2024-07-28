@extends('layout.admin-layout')




@section('space-work')

<h2 class="mb-4">Subjects</h2>


<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addSubjectModal">
   Add Subject
  </button>
  




  <table class="table table-striped mt-3">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Subject</th>
        <th scope="col">Edit</th>
        <th scope="col">Delete</th>
      </tr>
    </thead>
    <tbody>
   @if (count($subjects) > 0)
       
   @foreach ($subjects as  $subject)
       
<tr>
<td>{{$subject->id}}</td>

<td>{{$subject->subject}}</td>
<td>

  <button class="btn btn-info editButton" data-id="{{$subject->id}}"data-toggle="modal" data-target="#editSubjectModal" data-subject="{{$subject->subject}}" > Edit</button>
</td>

<td>


  <button class="btn btn-danger deleteButton" data-id="{{$subject->id}}"data-toggle="modal" data-target="#deleteSubjectModal"  > Delete</button>
</td>

</tr>

   @endforeach

   @else

   <tr>
<td colspan="4">Subjects not Found</td>
</tr>
   @endif
    </tbody>
  </table>






  <!--Edit Modal -->
  <div class="modal fade" id="editSubjectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">


<form id="editSubject"> 
@csrf

      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Edit Subject</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <label >Subject</label>

        
        <input type="hidden" name="id" id="edit_subject_id"/>
        <input type="text" name="subject"   id="edit_Subject" required/>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </div>
    </form>

    </div>
  </div>



  <!--Delete Modal -->
  <div class="modal fade" id="deleteSubjectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">


<form id="deleteSubject"> 
@csrf

      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Delete Subject</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
       
          <p>Are you Sure you want to delete Subject?</p>

        
        <input type="hidden" name="id" id="delete_subject_id"/>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">Delete</button>
        </div>
      </div>
    </form>

    </div>
  </div>






  <!--Add Subject Modal -->
  <div class="modal fade" id="addSubjectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">

      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Add Subject</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="addSubject"> 
          @csrf

        <div class="modal-body">
        <label >Subject</label>

        <input type="text" name="subject" placeholder="Enter Subject name"  required/>

        </div>


        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add</button>
        </div>


        </form>
     
      </div>
 

    </div>
  </div>




<script>
    $(document).ready(function() {

$("#addSubject").submit(function(e){

    e.preventDefault();


    var formData = $(this).serialize();

    $.ajax({
url:"{{route('AddSubject')}}",
type:"POST",
data:formData,
success:function(data){
    if (data.success === true) {




        location.reload(); 

    }
else{

    alert(data.msg);
}


},


error: function(xhr) {
        console.log("AJAX request failed");
    }


});


});




//edit Subject

$(".editButton").click(function(){

var subject_id =  $(this).attr('data-id');
 var subject = $(this).attr('data-subject');

$("#edit_Subject").val(subject);
$("#edit_subject_id").val(subject_id);

});



$("#editSubject").submit(function(e){

e.preventDefault();



var formData = $(this).serialize();

$.ajax({
url:"{{route('editSubject')}}",
type:"POST",
data:formData,
success:function(data){
if (data.success === true) {

    location.reload(); 

}
else{

alert(data.msg);
}


},


error: function(xhr) {
    console.log("AJAX request failed");
}


});


});


//delete subject 
$(".deleteButton").click(function(){

  var subject_id = $(this).attr('data-id');

$("#delete_subject_id").val(subject_id);


});




$("#deleteSubject").submit(function(e){

e.preventDefault();



var formData = $(this).serialize();

$.ajax({
url:"{{route('deleteSubject')}}",
type:"POST",
data:formData,
success:function(data){
if (data.success === true) {

    location.reload(); 

}
else{

alert(data.msg);
}


},


error: function(xhr) {
    console.log("AJAX request failed");
}


});


});










    });
</script>
@endsection