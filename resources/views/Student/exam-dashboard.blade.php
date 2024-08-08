@extends('layout.layout-common')


@section('space-work')

<div class="container"> 

<p style="color: black">Welcome ,{{Auth::user()->name}}</p>


<h1 class="text-center">{{ $exam[0]['exam_name']}}</h1>


@if ($success ==true)
   
  @if (count($qna) >0)
    
  @php
      $count =1;
  @endphp

  
  @foreach ($qna as $data )
   
    
     <h5>Q.{{$count ++;}}   {{$data['questions'][0]['question']  }}</h5>
  
     @php
     $count1 =1;
 @endphp
      
     @foreach ( $data['answers'] as $answer )

   <p> <span style="font-weight: bold"> {{$count1 ++}}.)</span>{{ $answer['answer']}}</p>         
     @endforeach
  @endforeach
      
   @else 
    
<h3 style="color: red" class="text-center">Questions and Answers are not Available </h3>  
  @endif

@else
<h3 style="color: red" class="text-center">{{$msg}}</h3>    
@endif
</div>

@endsection