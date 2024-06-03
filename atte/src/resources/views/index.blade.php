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

    @if ($errors->has('punchIn'))
        <div class="alert alert-danger">
            {{ $errors->first('punchIn') }}
        </div>
    @endif
     @if ($errors->has('punchOut'))
        <div class="alert alert-danger">
            {{ $errors->first('punchOut') }}
        </div>
    @endif
    @if ($errors->has('start'))
        <div class="alert alert-danger">
            {{ $errors->first('start') }}
        </div>
    @endif
    @if ($errors->has('end'))
        <div class="alert alert-danger">
            {{ $errors->first('end') }}
        </div>
    @endif
  </h1>
  
  <div class="attendance__panel">
    <!-- <form class="attendance__button">
      <button class="attendance__button-submit" type="submit">勤務開始</button>
    </form> -->
    <form method="POST" action="{{ route('punch.in') }}">
        @csrf
        <button type="submit" class="btn btn-primary">出勤開始</button>
    </form>
    <form method="POST" action="{{ route('punch.out') }}">
      @csrf
      <button class="attendance__button-submit" type="submit">勤務終了</button>
    </form>
    <form method="POST" action="{{ route('rest.start') }}">
    @csrf
    <button type="submit" class="btn btn-primary">休憩開始</button>
    </form>
    <form method="POST" action="{{ route('rest.end') }}">
    @csrf
    <button type="submit" class="btn btn-primary">休憩終了</button>
    </form>
  </div>
</div>
@endsection