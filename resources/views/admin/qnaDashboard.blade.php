
@extends('layout.admin-layout')


@section('space-work')

<h2 class="mb-4">Q&A</h2>





<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addQnaModal">
   Add Q&A
  </button>
  
  



  <table class="table table-striped table-borderd mt-3">

    <thead>
        <tr>
            <th>#</th>
    
            <th>Question</th>
      
            <th>Answer</th>
         
        </tr>
        
    </thead>

    <tbody>
@if (count($question)>0)

@foreach ($question as $question)

<tr>

    <td>{{$question->id}}</td>
    
<td>{{$question->question}}</td>

<td> 
<a href="#" class="ansButton" data-id="{{$question->id}}"  data-toggle="modal" data-target="#showAnsModal"  >See Answer</a>

</td>
</tr>


@endforeach


@else


<tr>
    <td colspan="3">Questions And Answers not foud</td>
</tr>

@endif



    </tbody>
  </table>



 
  <!--Show QNA Modal -->
  <div class="modal fade mx-3" id="showAnsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">

      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">show Answers</h5>

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
       
        <div class="modal-body">

<table class="table">

<thead>
    <th>#</th>
    <th>Answer</th>
    <th>Is Correct</th>
</thead>

<tbody class="showAnswers">

</tbody>


    </table>           

        </div>
        <div class="modal-footer">
            <span class="error" style="color:red"></span>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
     
        </div>


    
      </div>
 

    </div>
  </div>

  <!--Add QNA Modal -->
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
        <div class="modal-body mapp">

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

                    $(".mapp").append(html);
}

});
$(document).on("click", ".RemoveButton",function(e) {

    $(this).parent().remove();

});


//show answer code

$(".ansButton").click(function() {
   
    var qid = $(this).attr("data-id");
    var htmls = '';

    var questionJson = {{ Js::from($questionJson) }};
    var questionJson = JSON.parse(questionJson);

    for (let i = 0; i < questionJson.length; i++) {

       
        
        if (qid == questionJson[i].id) {
          

            var answer_length = questionJson[i].answer.length;

            for (let j = 0; j < answer_length; j++) {
                let is_correct = "No";
                if (questionJson[i].answer[j].is_correct == 1) {
                    is_correct = "Yes";
                }
                htmls += `
                    <tr> 
                        <td>` + (j + 1) + ` </td>
                        <td> ` + questionJson[i].answer[j].answer + ` </td>
                        <td> ` + is_correct + `</td>
                    </tr>
                `;
            }

            break;
        }
    }

    $(".showAnswers").html(htmls);
});


    });
</script>




@endsection

