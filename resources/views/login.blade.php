@extends('layout/layout-common')

@section('space-work')


<h1>Login</h1>


@if ($errors->any())
    @foreach ( $errors->all() as $err )

    <p style="color: red">{{$err}}</p>

    @endforeach



    @endif
    @if (Session::has('error'))
<p style="color:red">{{Session::get('error')}}  </p>        
    @endif


    
    @if (Session::has('success'))
    <p style="color: green">{{ Session::get('success') }}</p>
@endif



<form action="{{  route('userLogin')}}" method="POST">
@csrf


<br><br>
<input type="email" name="email" placeholder="please enter your email"/>


<input type="password" name="password" placeholder="please enter your password"/>
<br><br>


<input type="submit"   value="Login" />



</form>

<a href="/forget-password">Forget Password</a>


@endsection