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
      <td style="display: none"> {{$ex->id}}</td>
        <td>{{$count ++}}</td>
        <td>{{$ex->exam_name}}</td>
        <td>{{$ex->subjects->subject}}</td>
        <td>{{$ex->date}}</td>
        <td>{{$ex->time}}Hrs</td>
        <td>{{$ex->attempt}} Time</td>
  
        <td>{{$ex->attempt_counter}} </td>
        <td> <a href="#" class="copy" data-code="{{$ex->entrance_id}}"> <i class="fa fa-copy"></i> </a> </td>




    </tr>
        
    @endforeach
       

   @else

     <tr>
        <td colspan="8">No Exam Available</td>
     </tr>
   @endif
  </tbody>
</table>


<script>

  $(document).ready(function(){

    $(".copy").click(function(){

      $(this).parent().prepend('<span class="copied_text"> Copied </span>');

      var code =$(this).attr('data-code');
      var url = "{{URL::to('/')}}/exam/"+code;


      var $temp=$("<input>");
      $("body").append($temp);

      $temp.val(url).select();
      document.execCommand("copy");
      $temp.remove();

      setTimeout(() => {
        
        $('.copied_text').remove();

      }, 1000);

    });

  });
</script>
@endsection