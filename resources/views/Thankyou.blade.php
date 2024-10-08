@extends('layout.layout-common')

@section('space-work')
<div class="container d-flex  flex-column justify-content-center align-items-center" style="min-height:100vh">
    <div>
        <h1 class="text-primary">Online Examination System</h1>
    </div>
    <div class="text-center">
        <h2>Thanks for submitting your Exam, {{ Auth::user()->name }}</h2>
        <p>We will review your Exam and update you soon by mail.</p>
      
    </div>
</div>




<script>
    $(document).ready(function() {
        // Redirect after 5 seconds
        setTimeout(function() {
            window.location.href = '/'; // Redirect to home page
        }, 2000); // 5000 milliseconds = 5 seconds
    });
</script>


@endsection
