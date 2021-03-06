@extends('layouts.global')
@section('title')
    Edit User
@endsection
@section('content')
    <div class="col-md-8">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <form enctype="multipart/form-data" class="bg-white shadow-sm p-3"
            action="{{ route('users.update', [$user->id]) }}" method="post">
            @csrf
            <input type="hidden" value="PUT" name="_method">
            <input value="{{ $user->name }}" class="form-control" placeholder="Full Name" type="text" name="name"
                id="name" />
            <label for="">Status</label>
            <br />
            <input {{ $user->status }}=="ACTIVE" ? "checked" : "" }} value="ACTIVE" type="radio" class="form-control"
                id="active" name="status">
            <label for="active">Active</label>
            <input {{ $user->status }}=="INACTIVE" ? "checked" : "" }} value="INACTIVE" type="radio" class="form-control"
                id="inactive" name="status">
            <label for="inactive">Inactive</label>
            <br><br>
            <input type="checkbox" {{ in_array('ADMIN', json_decode($user->roles)) ? 'checked' : '' }} name="roles[]"
                id="ADMIN" value="ADMIN"><label for="ADMIN">Administrator</label>
            <input type="checkbox" {{ in_array('STAFF', json_decode($user->roles)) ? 'checked' : '' }} name="roles[]"
                id="STAFF" value="STAFF"><label for="STAFF">Staff</label>
            <input type="checkbox" {{ in_array('CUSTOMER', json_decode($user->roles)) ? 'checked' : '' }} name="roles[]"
                id="CUSTOMER" value="CUSTOMER"><label for="CUSTOMER">Customer</label>
            <br>
            <br>
            <label for="phone">Phone Number</label>
            <br>
            <input type="text" name="phone" class="form-control" value="{{ $user->phone }}">
            <br>
            <label for="address">Address</label>
            <textarea name="address" class="form-control">{{ $user->address }}</textarea>
            <br>
            <label for="avatar">Avatar Image</label>
            <br>
            Current Avatar: <br>
            @if ($user->avatar)
                <img src="{{ asset('storage/' . $user->avatar) }}" width="120px" />
                <br>
            @else
                No Avatar
            @endif
            <br>
            <input id="avatar" name="avatar" type="file" class="form-control">
            <small class="text-muted">Kosongkan
                jika mengubah avatar</small>
            <hr class="my-3">
            <label for="email">
                Email
            </label>
            <input value="{{ $user->email }}" disabled class="form-control" placeholder="user@mail.com" type="text"
                name="email" id="email" />
            <br>
            <input class="btn btn-primary" type="submit" value="Save" />
        </form>
    </div>
@endsection
