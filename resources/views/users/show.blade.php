@extends('layouts.global')
@section('title')
    Detail User
@endsection
@section('content')
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <b>Name</b><br />
                {{ $userShow->name }}
                <br><br>
                @if ($userShow->avatar)
                    <img src="{{ asset('storage/' . $userShow->avatar) }}" width="128px" />
                @else
                    No Avatar
                @endif
                <br><br>
                <b>Username:</b><br>{{ $userShow->username }}
                <br><br>
                <b>Phone Number</b><br>{{ $userShow->phone }}
                <br><br>
                <b>Address</b><br>{{ $userShow->address }}
                <br><br>
                <b>Roles:</b><br>
                @foreach (json_decode($userShow->roles) as $role)
                    &middot; {{ $role }}
                @endforeach
            </div>
        </div>
    @endsection
