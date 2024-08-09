@extends('layout.layout-common')


@section('space-work')

   @php
    $time = explode($exam[0]['time']);
   @endphp

<div class="container"> 

   

<p style="color: black">Welcome ,{{Auth::user()->name}}</p>


<h1 class="text-center">{{ $exam[0]['exam_name']}}</h1>
   <h4 class="text-right">{{ $exam[0]['time']}}</h4>
    @php $count =1; @endphp

@if ($success ==true)
                      <form action="{{ route ('examSubmit')}}" method="POST" class="mb-5" onsubmit="return isValid()">
                        @csrf
                        <input type="hidden" name="exam_id" value="{{ $exam[0]['id']}}">
                    @if (count($qna) >0)
                             
                    @foreach ($qna as $data )
                    
                    <div>
                      <h5>Q.{{$count ++;}}   {{$data['questions'][0]['question']  }}</h5>
                      <input type="hidden" name="q[]" value="{{$data['questions'][0]['id']  }}">
                    <input type="hidden" name="ans_{{$count -1}}" id="ans_{{$count -1}}" >
                      @php
                      $count1 =1;
                  @endphp
                        
                      @foreach ( $data['answers'] as $answer )

                    <p> <span style="font-weight: bold"> {{$count1 ++}}).</span>  {{ $answer['answer']}}
                      <input type="radio" name="radio_{{$count-1}}" data-id="{{$count-1}}" class="select_ans" value="{{ $answer['id']}}">
                    </p>         
               
                      @endforeach
                    
                    </div>  
                    @endforeach
             <div class="text-center">
               <input type="submit" class="btn btn-info"value="submit">
             </div>
                  </form>
   @else 
    
<h3 style="color: red" class="text-center">Questions and Answers are not Available </h3>  
  @endif

@else
<h3 style="color: red" class="text-center">{{$msg}}</h3>    
@endif
</div>


<script>
  $(document).ready(function(){

    //timer setting logic 
   
   
    $(".select_ans").click(function(){
      console.log("yes i clicked");
      
  var no=$(this).attr("data-id");

  $("#ans_"+no).val($(this).val());

    });

  });


  
  function isValid() {

var result=true;

var qlength =parseInt("{{$count}}") -1;

$(".errormsg").remove();
for (let i=1; i<=qlength; i++) {

  if($("#ans_"+i).val() == ""){

    result =false;

    $("#ans_"+i).parent().append('<span style="color:red"  class="errormsg">Please select any answer </span>');


    setTimeout(() => {
     
    }, 5000);
  }
}

return result;
}
</script>

@endsection

