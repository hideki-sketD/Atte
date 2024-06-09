@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')

<div class="attendance__content">
  <h1 class="attendance-user_name">
    {{ $my_user->name }}さん
    @if (session('message'))
     {{ session('message') }}
    @endif
  </h1>
  <div class="attendance-button">
    <div class="attendance-button_punch">
      <form method="POST" action="{{ route('punch.in') }}">
      @csrf
      <button class="attendance__button" type="submit" {{ $hasPunchedIn ? 'disabled' : '' }}>
        出勤開始
      </button>
      </form>
      <form method="POST" action="{{ route('punch.out') }}">
      @csrf
      <button class="attendance__button" type="submit" {{ !$hasPunchedIn || $hasPunchedOut ? 'disabled' : '' }}>
        勤務終了
      </button>
      </form>
    </div>
    <div class="attendance-button_rest">
      <form method="POST" action="{{ route('rest.start') }}">
      @csrf
      <button class="attendance__button" type="submit" {{ !$hasPunchedIn || $hasPunchedOut || $isResting  ? 'disabled' : '' }}>
        休憩開始
      </button>
      </form>
      <form method="POST" action="{{ route('rest.end') }}">
      @csrf
      <button class="attendance__button" type="submit" {{ !$hasPunchedIn || $hasPunchedOut || !$isResting  ? 'disabled' : '' }}>
        休憩終了
      </button>
      </form>
    </div>
  </div>
</div>
@endsection

