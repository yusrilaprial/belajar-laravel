@extends('layouts.mainlayout')

@section('title', 'Class')

@section('nav-class', 'active')

@section('content')
    <h2>Anda sedang melihat data dari class {{ $class->name }}</h2>

    <div class="mt-5">
        <h4>Homeclass Teacher : {{ $class->homeroomTeacher->name }}</h4>
    </div>

    <div class="mt-5">
        <h4>Students List</h4>
        <ol>
            @foreach ($class->students as $item)
             <li>{{ $item->name }}</li>   
            @endforeach
        </ol>
    </div>
@endsection
