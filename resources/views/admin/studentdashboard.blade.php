
@extends('layout.admin-layout')


@section('space-work')

<h2 class="mb-4">Students</h2>

  
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addStudentModal">
    Add Student
   </button>

   <a href="{{ route('exportStudent') }}" class="btn btn-warning">Export Students</a>

  <table class="table table-striped table-borderd mt-3">

    <thead>
        <tr>
            <th>#</th>
    
            <th>Name</th>
            <th>Email</th>
            <th>Edit</th>
            <th>Delete</th>
          
         
        </tr>
        
    </thead>

    <tbody>
@if (count($student)>0)

@foreach ($student as $std)

<tr>

    <td>{{$std->id}}</td>
    
<td>{{$std->name}}</td>
<td>{{$std->email}}</td>

<td>
   
  <button type="button" class="btn btn-info editButton" data-id="{{$std->id}}" data-name="{{$std->name}}"    data-email="{{$std->email}}"
    data-toggle="modal" data-target="#editStudentModal">
    Edit
   </button>



</td>


<td>
  
   
  <button type="button" class="btn btn-danger deleteButton" data-id="{{$std->id}}" 
    data-toggle="modal" data-target="#deleteStudentModal">
    Delete
   </button>
</td>


</tr>


@endforeach


@else


<tr>
    <td colspan="3">Student Not found</td>
</tr>

@endif



    </tbody>
  </table>



  
  <!--Add Student Modal -->
  <div class="modal fade mx-3" id="addStudentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">

      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Add Student</h5>

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
       
<form id="addStudent">
    @csrf
        <div class="modal-body ">

            <div class="row">
                <div class="col">
          <input type="text" class="w-100" required name="name" placeholder="Enter Student Name "/>
        

                </div>

            </div>


            <div class="row mt-2">
                <div class="col">
          <input type="email" class="w-100" required name="email" placeholder="Enter Student Email "/>
        

                </div>

            </div>



        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary AddButton">Add Q &A</button>
        </div>


    </form>
      </div>
 

    </div>
  </div>












  <!--Edit Student Modal -->
  <div class="modal fade mx-3" id="editStudentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">

      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Edit Student</h5>

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
       
<form id="editStudent">
    @csrf
        <div class="modal-body ">
<input type="hidden" name="id" id="id">
            <div class="row">
                <div class="col">
          <input type="text" class="w-100" required name="name" id="name" placeholder="Enter Student Name "/>
        

                </div>

            </div>


            <div class="row mt-2">
                <div class="col">
          <input type="email" class="w-100" required name="email" id="email" placeholder="Enter Student Email "/>
        

                </div>

            </div>



        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary updateButton">Update Student</button>
        </div>


    </form>
      </div>
 

    </div>
  </div>


  <!--Delete Student Modal -->
  <div class="modal fade mx-3" id="deleteStudentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">

      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Delete Student</h5>

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
       
<form id="deleteStudent">
    @csrf
        <div class="modal-body ">
<input type="hidden" name="id" id="stid">
       
<p>Are you Sure you want to Delete this ?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary updateButton">Delete</button>
        </div>


    </form>
      </div>
 

    </div>
  </div>


<script>
    $(document).ready(function(){

        $("#addStudent").submit(function(e){
         e.preventDefault();
         $(".AddButton").prop("disabled",true);

         var formData = $(this).serialize();
           $.ajax({

            url:"{{ route('addStudent')}}",
            type:"POST",
            data:formData,
            success:function(data){
                if(data.success == true)
                {

                   location.reload();
                }
                else{
                    alert(data.msg);
                }
            }
           });

        });



        //editButton Click and Show value
        $(".editButton").click(function(){
   
          $("#id").val($(this).attr('data-id'));
          $("#name").val($(this).attr('data-name'));
          $("#email").val($(this).attr('data-email'));

        });




        $("#editStudent").submit(function(e){
         e.preventDefault();
         
         var formData = $(this).serialize();

         $(".updateButton").prop('disabled', true);
           $.ajax({

            url:"{{ route('editStudent')}}",
            type:"POST",
            data:formData,
            success:function(data){
                if(data.success == true)
                {

                   location.reload();
                }
                else{
                    alert(data.msg);
                }
            }
           });

        });



        $(".deleteButton").click(function(){
          

        var id=  $(this).attr("data-id");

        $("#stid").val(id);
});




$("#deleteStudent").submit(function(e){
         e.preventDefault();
         
         var formData = $(this).serialize();

           $.ajax({

            url:"{{ route('deleteStudent')}}",
            type:"POST",
            data:formData,
            success:function(data){
                if(data.success == true)
                {

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

