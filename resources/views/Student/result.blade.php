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

   <a href="#" data-id="{{ $att->id }}">Review Q&A</a>

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





@endsection