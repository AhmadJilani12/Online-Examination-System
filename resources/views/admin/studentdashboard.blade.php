
@extends('layout.admin-layout')


@section('space-work')

<h2 class="mb-4">Students</h2>


  <table class="table table-striped table-borderd mt-3">

    <thead>
        <tr>
            <th>#</th>
    
            <th>Name</th>
            <th>Email</th>
        
          
         
        </tr>
        
    </thead>

    <tbody>
@if (count($student)>0)

@foreach ($student as $std)

<tr>

    <td>{{$std->id}}</td>
    
<td>{{$std->name}}</td>
<td>{{$std->email}}</td>



</tr>


@endforeach


@else


<tr>
    <td colspan="3">Student Not foud</td>
</tr>

@endif



    </tbody>
  </table>



 
 


@endsection

