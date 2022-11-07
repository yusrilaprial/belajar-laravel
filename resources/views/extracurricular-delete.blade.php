@extends('layouts.mainlayout')

@section('title', 'Delete Ekskul')

@section('nav-extracurricular', 'active')

@section('content')
<div class="mt-5 m-auto">
    <h2>Are sure to delete data extracurricular: {{ $ekskul->name }}</h2>
    <form style="display: inline-block" action="/extracurricular-destroy/{{ $ekskul->id }}" method="post">
        @csrf
        @method('delete')
        <button class="btn btn-danger">Delete</button>
    </form>
    <a href="/class" class="btn btn-primary">Cancel</a>
</div>
@endsection