@extends('layouts.app')

@section('content')
@if (session('resent'))
    <div>
        {{ __('メールを再送信しました。') }}
    </div>
@endif

{{ __('メールを確認し認証を完了させてください。') }}
<form class="d-inline" method="POST" action="{{ route('verification.send') }}">
    @csrf
    <button type="submit">{{ __('メール再送信') }}</button>.
</form>
@endsection