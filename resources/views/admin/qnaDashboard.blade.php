
@extends('layout.admin-layout')


@section('space-work')

<h2 class="mb-4">Q&A</h2>





<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addQnaModal">
   Add Q&A
  </button>
  


























  
  <!--Add Exam Modal -->
  <div class="modal fade mx-3" id="addQnaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">

      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Add Q & A</h5>
          <button id="addAnswer" class="ml-5 btn btn-info"> Add Answer</button>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
       
<form id="addQna">
    @csrf
        <div class="modal-body">

            <div class="row">
                <div class="col">
          <input type="text" class="w-100" required name="Question" placeholder="Enter Question">

                </div>
            </div>

        </div>
        <div class="modal-footer">
            <span class="error" style="color:red"></span>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add Q &A</button>
        </div>


    </form>
      </div>
 

    </div>
  </div>


<script>
    $(document).ready(function(){
//form submission

$("#addQna").submit(function(e){

    e.preventDefault();
    
    if($(".answers").length <2){
        $(".error").text("please add minimum two answers");
setTimeout(() => {
    $(".error").text("");
}, 2000);
    }
    else{
var checkIsCorrect=false;

for(let i=0; i<$(".is_correct").length; i++){


    if($(".is_correct:eq("+i+")").prop("checked") == true){

        checkIsCorrect=true;
        $(".is_correct:eq("+i+")").val($(".is_correct:eq("+i+")").next().find("input").val());
    }


    }

if(checkIsCorrect){

    var formData= $(this).serialize();

    $.ajax({
        url:"{{ route('addQna')}}",
        type:"POST",
        data:formData,
        success:function(data){
          
            if(data.success ==true)
        {

location.reload();
        }
        else{
            alert(data.message);
        }
        }
    })


}else{


        $(".error").text("Please select anyone correct answer");
setTimeout(() => {
    $(".error").text("");
}, 2000);
    

}
}



});

//add Answers
$("#addAnswer").click(function(){

    if($(".answers").length >=6){
        $(".error").text("you can add maximum six answers");
setTimeout(() => {
    $(".error").text("");
}, 2000);
    }
else{

            var html= `  <div class="row answers mt-2">
            <input type="radio"  name="is_correct" class="is_correct" />
                        <div class="col">
                <input type="text" class="w-100" required name="answers[]" placeholder="Enter Answer" required>

                        </div>
                        <button class="btn btn-danger RemoveButton">Remove </button>
                    </div>`

                    $(".modal-body").append(html);
}

});
$(document).on("click", ".RemoveButton",function(e) {

    $(this).parent().remove();

});

    });
</script>




@endsection

