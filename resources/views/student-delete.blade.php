@extends('layouts.mainlayout')

@section('title', 'Delete Students')

@section('nav-students', 'active')

@section('content')
<div class="mt-5 m-auto">
    <h2>Are sure to delete data student: {{ $student->name }} ({{ $student->nis }})</h2>
    <form style="display: inline-block" action="/student-destroy/{{ $student->id }}" method="post">
        @csrf
        @method('delete')
        <button class="btn btn-danger">Delete</button>
    </form>
    <a href="/students" class="btn btn-primary">Cancel</a>
</div>
@endsection