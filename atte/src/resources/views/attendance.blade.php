@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/attendance.css') }}">
@endsection

@section('content')
<div class="attendance-container">
@foreach ($reports as $date => $attendances)
        <h2>{{ $date }}</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>名前</th>
                    <th>出勤時間</th>
                    <th>退勤時間</th>
                    <th>勤務時間</th>
                    <th>休憩時間</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($attendances as $attendance)
                    <tr>
                        <td>{{ $attendance->user->name }}</td>
                        <td>{{ $attendance->punchIn }}</td>
                        <td>{{ $attendance->punchOut }}</td>
                        <td>{{ $attendance->total_work }}</td>
                        <td>{{ $attendance->total_rest }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach
</div>
@endsection