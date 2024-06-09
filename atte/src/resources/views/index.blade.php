@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')

<div class="attendance__content">
  <h1>{{ $my_user->name }}さん
    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
  </h1>
  
  <div class="attendance__panel">
    <form method="POST" action="{{ route('punch.in') }}">
        @csrf
        <button type="submit" class="btn btn-primary" {{ $hasPunchedIn ? 'disabled' : '' }}>出勤開始</button>
    </form>
    <form method="POST" action="{{ route('punch.out') }}">
      @csrf
      <button class="attendance__button-submit" type="submit" {{ !$hasPunchedIn || $hasPunchedOut ? 'disabled' : '' }}>勤務終了</button>
    </form>
    <form method="POST" action="{{ route('rest.start') }}">
    @csrf
    <button type="submit" class="btn btn-primary" {{ !$hasPunchedIn || $hasPunchedOut || $isResting  ? 'disabled' : '' }}>休憩開始</button>
    </form>
    <form method="POST" action="{{ route('rest.end') }}">
    @csrf
    <button type="submit" class="btn btn-primary"{{ !$hasPunchedIn || $hasPunchedOut || !$isResting  ? 'disabled' : '' }}>休憩終了</button>
    </form>
  </div>
</div>
@endsection