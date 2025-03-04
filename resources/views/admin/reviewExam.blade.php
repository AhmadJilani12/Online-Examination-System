@extends('layout.admin-layout')


@section('space-work')

<h2 class="mb-4">Student Exam</h2>


  <table class="table table-striped table-borderd mt-3">

    <thead>
        <tr>
            <th>#</th>
    
            <th>Name</th>
            <th>Exam</th>
            <th>Status</th>
            
            <th>Review</th>

         
        </tr>
        
    </thead>

    <tbody>
@if ( count ($attempts)>0)
      @php $counter =1;  @endphp
  @foreach ($attempts as $attempt)
      <tr>
        <td>{{$counter++}} </td>
        <td>{{$attempt->user->name}} </td>
        <td>{{$attempt->exam->exam_name}} </td>
        <td>
            @if ($attempt->status == 0)
             <span style="color: red">Pending</span>
                @else
                <span style="color: green">Approved</span>
            @endif
        </td>

        <td>
            @if ($attempt->status == 0)
              <a href="#" data-toggle="modal" data-target="#reviewExamModal" class="reviewEx" data-id="{{$attempt->id}}">Review And Approved</a>
                @else
                completed
            @endif
        </td>

      </tr>
  @endforeach
@else
    <tr>
        <td colspan="5">Student not Attempts Exam!</td>
    </tr>
@endif


    </tbody>
  </table>




  <!--Review And Approved Exam Modal -->
  <div class="modal fade" id="reviewExamModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">

      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Review Exam</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="reviewForm">
            @csrf
            <input type="hidden" name="attempt_id" id="attempt_id">
        <div class="modal-body review-exam">

    Loading...
        </div>


        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary approve-btn">Approve </button>
        </div>


    </form>
      </div>
 

    </div>
  </div>





  <script>
$(document).ready(function(){

    $(".reviewEx").click(function(){

        var id =$(this).attr("data-id");
        $("#attempt_id").val(id);

        var html ='';

        $.ajax({
            url:"{{route('reviewQna')  }}",
            type:"GET",
            data:{attempt_id:id},
            success:function(data){
                if(data.success == true)
            {

                
                      var data=data.data;

                      if(data.length > 0)
                      {
                          
                   for(let i=0;i<data.length;i++)
                   {
                    
                    let isCorrect='<span style="color:red" class="fa fa-close">   </span>';
                    

                           if(data[i]['answer']['is_correct'] == 1 ){

                             isCorrect='<span style="color:green" class="fa fa-check">   </span>';
                           }

                    html+= `
                    <div class="row"> 
                         <div class="col-sm-12">
                        <h6> Q.(`+(i+1)+`). `+data[i]['question']['question'] +` </h6>

                        <p> Ans:-`+data[i]['answer']['answer'] +` `+isCorrect+`     </p>
                        </div> 
                         </div>
                    `;
                   }

                      }else{
                        html +=`<h6> Student Not Attempt any question  </h6> 
                        <p>If you Approve this Exam Student will Fail   </p>
                        
                        `
                      }
            } 
            else{
                 html += ` Having some server issue !`
            }

            $('.review-exam').html(html);
            }


        });
    });

    //approve exam

    $("#reviewForm").submit(function(event){

      event.preventDefault();

    $('.approve-btn').html(' Please wait <i class="fa fa-spinner  fa-spin">  </i>  ')  
      var formData =  $(this).serialize();

      $.ajax({
 url:"{{ route('approvedQna') }}",
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