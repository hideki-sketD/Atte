@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/attendance.css') }}">
@endsection

@section('content')

<div class="pagination">
        <a href="{{ route('attendance', ['date' => $previousDate]) }}">＜</a>
        {{ $date->format('Y/m/d') }}
        <a href="{{ route('attendance', ['date' => $nextDate]) }}">＞</a>
    </div>

    <h1>{{ $date->format('Y/m/d') }}の勤務状況</h1>

    @if ($attendances->isEmpty())
        <p>この日に勤務記録はありません。</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>名前</th>
                    <th>出勤時刻</th>
                    <th>退勤時刻</th>
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
        {{ $attendances->links() }}
    @endif
@endsection