@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/userlist.css') }}">
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@endsection

@section('content')

<div class="users__content">
    <div class="users__sheet">
        <table class="users_table">
        <tr class="users_row">
            <th class="users_label">
                名前
            </th>
        </tr>
        @foreach ($users as $user)
        <tr class="users_row">
            <td class="users_data">
                {{ $user->name }}
            </td>
        </tr>
        @endforeach
    </table>
    {{ $users->links('vendor.pagination.custom') }}
    </div>
</div>
@endsection
