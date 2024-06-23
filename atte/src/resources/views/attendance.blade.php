@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/attendance.css') }}">
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@endsection

@section('content')
<div class="attendance__content">
    <div class="date-pagination">
        <a class="select-date" href="{{ route('attendance', ['date' => $previousDate]) }}">
            ＜
        </a>
        <h2 class="on-day">
            {{ $date->format('Y/m/d') }}
        </h2>
        <a class="select-date" href="{{ route('attendance', ['date' => $nextDate]) }}">
            ＞
        </a>
    </div>
    <table class="attendance_table">
        <tr class="attendance_row">
            <th class="attendance_label">名前</th>
            <th class="attendance_label">出勤時間</th>
            <th class="attendance_label">退勤時間</th>
            <th class="attendance_label">勤務時間</th>
            <th class="attendance_label">休憩時間</th>
        </tr>
        @foreach ($attendances as $attendance)
        <tr class="attendance_row">
            <td class="attendance_data">{{ $attendance->user->name }}</td>
            <td class="attendance_data">{{ $attendance->punchIn }}</td>
            <td class="attendance_data">{{ $attendance->punchOut }}</td>
            <td class="attendance_data">{{ $attendance->total_work }}</td>
            <td class="attendance_data">{{ $attendance->total_rest }}</td>
        </tr>
        @endforeach
    </table>
    {{ $attendances->links('vendor.pagination.custom') }}
</div>
@endsection

