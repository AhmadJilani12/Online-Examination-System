@extends('layout/layout-common')

@section('space-work')


<h1>Forget Password</h1>


@if ($errors->any())
    @foreach ( $errors->all() as $err )

    <p style="color: red">{{$err}}</p>

    @endforeach



    @endif
    @if (Session::has('error'))
<p style="color:red">{{Session::get('error')}}  </p>        
    @endif

    @if (Session::has('success'))
    <p style="color:green">{{Session::get('success')}}  </p>        
        @endif


<form action="{{  route('forgetPassword')}}" method="POST">
@csrf


<br><br>
<input type="email" name="email" placeholder="please enter your email"/>


<br><br>


<input type="submit"   value="Forget Password" />



</form>

<a href="/login">Login</a>


@endsection