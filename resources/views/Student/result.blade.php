@extends('layout.student-layout')



@section('space-work')


<h2>Result</h2>

<table class="table">

    <thead>
  
    <tr>
        <th>#</th>
        <th>Exam </th>
        <th>Result</th>
        <th>Status</th>
    </tr>

          
</thead>

<tbody>

    @if (count ($attempt)> 0)
@php
    $counter = 1;
@endphp
    @foreach ($attempt as $att)

    <tr>
        <td>{{ $counter++; }}</td>
        <td>{{ $att->exam->exam_name}}</td>
        <td>
            @if ($att->status == 0)

            Not Declared
                @else

                @if ($att->marks >= $att->exam->pass_marks)

                <span style="color: green">Passed</span>
                    @else

                    <span style="color: red">Failed</span>
                @endif
            @endif 
             </td>


             <td>
                @if ($att->status == 0)
              <span style="color: red">Pending</span>
   @else

   <a href="#" data-id="{{ $att->id }}" data-toggle="modal" data-target="#reviewQnaModal" class="Rview"  >Review Q&A</a>

                @endif
             </td>
    </tr>
        
    @endforeach

    @else

    <tr>
        <td colspan="4">You not attempt any Exam</td>
    </tr>
        
    @endif
</tbody>
</table>




  <!--See Result Modal -->
  <div class="modal fade" id="reviewQnaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">

      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Result</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body review-exam reviewqna">

    Loading...
        </div>


        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       
        </div>
      </div>
 

    </div>
  </div>





  
  <!--Show explanation Modal -->
  <div class="modal fade" id="ExplanationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">

      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Explanation</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body review-exam ">

            <p id="explanation"></p>

        </div>


        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
   
        </div>
      </div>
 

    </div>
  </div>

  <script>


    $(document).ready(function(){

$('.Rview').click(function(){

    var attemptid = $(this).attr("data-id");

    $.ajax({
        url:"{{ route('reviewStudentQna') }}",
        type:"GET",

        data:{attempt_id:attemptid},
        success:function(data){
            var html = '';
            
            if(data.success  == true){

                console.log(data);
                
                var data=data.data;

                if(data.length > 0)
            {

                for(let i=0;i<data.length;i++){

                    let answer=data[i]['answer']['answer'];
                    let is_correct='<span style="color:red" class="fa fa-close">   </span>';


                    if(data[i]['answer']['is_correct'] == 1)
                {
                    is_correct='<span style="color:green" class="fa fa-check">   </span>';
                }
                

                    html+= `
                    <div class="row">      
                        <div class="col-sm-12"> 
                            
                            <h6>Q(`+(i+1)+`).  `+data[i]['question']['question']+ `   </h6>
                 <p> Ans:- `+answer+` &nbsp; &nbsp;`+is_correct+`   </p> `;

                 if(data[i]['question']['explanation'] != null)
                 {  
               html += ` <p> <a href="#" class="explanation" data-explanation = `+data[i]['question']['explanation']+`  data-toggle="modal" data-target="#ExplanationModal"  >  See Explanation  </a>   </p> `

                 }
                 html += `
                            
                            </div>
                        
                        </div>
                    `

                }
            }
            else{

                html +='<h6> You did not attempt any question  </h6>'
            }



            }
            else{
               html += '<p> Having some issue on server side  </p>'
            }
            

            $('.reviewqna').html(html);

        }

    });

});

                $(document).on('click','.explanation',function(){

                    var explanation =$(this).attr('data-explanation');
                    $("#explanation").text(explanation);


                    
                });

    });

  </script>






@endsection