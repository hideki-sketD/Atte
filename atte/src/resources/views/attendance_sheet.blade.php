@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/attendance_sheet.css') }}">
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@endsection

@section('content')
<div class="attendanceSheet__content">
    <h1 class="attendanceSheet-user_name">
        {{ $my_user->name }}さん
    </h1>
    <table class="attendanceSheet_table">
        <tr class="attendanceSheet_row">
            <th class="attendanceSheet_label">
                日付
            </th>
            <th class="attendanceSheet_label">
                出勤時間
            </th>
            <th class="attendanceSheet_label">
                退勤時間
            </th>
            <th class="attendanceSheet_label">
                勤務時間
            </th>
            <th class="attendanceSheet_label">
                休憩時間
            </th>
        </tr>
        @foreach ($attendances as $attendance)
        <tr class="attendanceSheet_row">
            <td class="attendanceSheet_data">{{ $attendance->date }}</td>
            <td class="attendanceSheet_data">{{ $attendance->punchIn }}</td>
            <td class="attendanceSheet_data">{{ $attendance->punchOut }}</td>
            <td class="attendanceSheet_data">{{ $attendance->total_work }}</td>
            <td class="attendanceSheet_data">{{ $attendance->total_rest }}</td>
        </tr>
        @endforeach
    </table>
    {{ $attendances->links('vendor.pagination.custom') }}
</div>


@endsection

