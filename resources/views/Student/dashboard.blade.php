@extends('layout.student-layout')



@section('space-work')

<h2>Exams</h2>
  

 <table class="table table-boderd table-striped mt-5">

    <thead>

        <th>#</th>
        <th>Exam Name</th>
        <th>Subject Name</th>
        <th>Date</th>
        <th>Time</th>
        <th>Total Attempt</th>
        <th>Available Attempt</th>
        <th>Copy Link</th>
   </thead>

  <tbody>

   @if (count($exam) > 0)

   @php  $count =1; @endphp
    @foreach ($exam as $ex)

    <tr>
        <td>{{$count ++}}</td>
        <td>{{$ex->exam_name}}</td>
        <td>{{$ex->subjects->subject}}</td>
        <td>{{$ex->date}}</td>
        <td>{{$ex->time}}Hrs</td>
        <td>{{$ex->attempt}}</td>
        <td>{{$ex->attempt}} Time</td>




    </tr>
        
    @endforeach
       

   @else

     <tr>
        <td colspan="8">No Exam Available</td>
     </tr>
   @endif
  </tbody>




 </table>
@endsection