@extends('layouts.mainlayout')

@section('title', 'Delete Teacher')

@section('nav-teacher', 'active')

@section('content')
<div class="mt-5 m-auto">
    <h2>Are sure to delete data teacher: {{ $teacher->name }}</h2>
    <form style="display: inline-block" action="/teacher-destroy/{{ $teacher->id }}" method="post">
        @csrf
        @method('delete')
        <button class="btn btn-danger">Delete</button>
    </form>
    <a href="/class" class="btn btn-primary">Cancel</a>
</div>
@endsection