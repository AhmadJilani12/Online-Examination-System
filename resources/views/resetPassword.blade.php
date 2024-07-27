@extends('layout/layout-common')

@section('space-work')


<h1>Reset Password</h1>


@if ($errors->any())
    @foreach ( $errors->all() as $err )

    <p style="color: red">{{$err}}</p>

    @endforeach

    @endif



<form action="{{  route('resetPassword')}}" method="POST">
@csrf

<input type="hidden" name="id" value="{{$user[0]['id']}}">

<br><br>
<input type="password" name="password" placeholder="please enter your password"/>

<br><br>
<input type="password" name="password_confirmation" placeholder="please enter Confirm Password"/>



<br><br>


<input type="submit"   value="Reset Password" />



</form>




@endsection