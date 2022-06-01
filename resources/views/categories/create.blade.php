@extends('layouts.global')
@section('title')
    Create Category
@endsection
@section('content')
    <div class="col-md-8">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
        @endif
        <form enctype=" multipart/form-data" class="bg-white shadow-sm p-3" action="{{ route('categories.store') }}"
            method="post">
            @csrf
            <label>Category Name</label><br>
            <input type="text" name="name" class="form-control" />
            <br>
            <label>Category Image</label>
            <input type="file" class="form-control" name="image" />
            <br>
            <input type="submit" class="btn btn-primary" value="Save" />
        </form>
    </div>
@endsection