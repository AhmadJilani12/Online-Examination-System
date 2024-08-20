@extends('layout.layout-common')

@section('space-work')
@php
    $time = explode(':', $exam[0]['time']);
@endphp

<div class="container mt-4">

    <p class="text-muted">Welcome, {{ Auth::user()->name }}</p>

    <h1 class="text-center mb-4">{{ $exam[0]['exam_name'] }}</h1>

    @php $count =1; @endphp


    @if ($success)
        <form action="{{ route('examSubmit') }}" method="POST" class="mb-5" id="exam_form">
            @csrf
            <input type="hidden" name="exam_id" value="{{ $exam[0]['id'] }}">
            
            @if (count($qna) > 0)
                <h4 class="text-right mb-4 time">{{ $exam[0]['time'] }}</h4>

                @foreach ($qna as $data)
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Q. {{ $count++ }} {{ $data['questions'][0]['question'] }}</h5>
                            <input type="hidden" name="q[]" value="{{ $data['questions'][0]['id'] }}">
                            <input type="hidden" name="ans_{{ $count - 1 }}" id="ans_{{ $count - 1 }}">

                            @php $count1 = 1; @endphp
                            @foreach ($data['answers'] as $answer)
                                <div class="form-check">
                                    <input type="radio" name="radio_{{ $count - 1 }}" id="answer_{{ $count - 1 }}_{{ $count1 }}" data-id="{{ $count - 1 }}" class="form-check-input select_ans" value="{{ $answer['id'] }}">
                                    <label for="answer_{{ $count - 1 }}_{{ $count1 }}" class="form-check-label">
                                        <span class="font-weight-bold">{{ $count1++ }}. </span> {{ $answer['answer'] }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach

                <div class="text-center">
                    <input type="submit" class="btn btn-primary" value="Submit">
                </div>
            @else
                <h3 class="text-danger text-center">Questions and Answers are not available</h3>
            @endif

    @else
        <h3 class="text-danger text-center">{{ $msg }}</h3>
    @endif
    </form>
</div>

<script>
$(document).ready(function() {
    // Timer logic
    var time = @json($time);
    var hours = parseInt(time[0]);
    var minutes = parseInt(time[1]);
    var seconds = 59;

    function formatTime(num) {
        return num.toString().padStart(2, '0');
    }

    function updateTimer() {
        let tempHours = formatTime(hours);
        let tempMin = formatTime(minutes);
        let tempSecond = formatTime(seconds);
        $(".time").text(`${tempHours} : ${tempMin} : ${tempSecond} Left Time`);

        if (hours === 0 && minutes === 0 && seconds === 0) {
            clearInterval(timer);
            $("#exam_form").submit();
        }

        if (seconds <= 0) {
            if (minutes === 0 && hours > 0) {
                hours--;
                minutes = 59;
            } else if (minutes > 0) {
                minutes--;
            }
            seconds = 59;
        } else {
            seconds--;
        }
    }

    var timer = setInterval(updateTimer, 1000);

    $(".select_ans").click(function() {
        var no = $(this).data("id");
        $("#ans_" + no).val($(this).val());
    });
});
</script>
@endsection
