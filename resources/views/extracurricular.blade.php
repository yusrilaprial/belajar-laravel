@extends('layouts.mainlayout')

@section('title', 'Ekskul')

@section('nav-extracurricular', 'active')

@section('content')
<h1>Ini Halaman Extracurricular</h1>
@if (Auth::user()->role_id == 1)
<div class="my-5">
    <a href="/extracurricular-add" class="btn btn-primary">Add Data</a>
</div>
@endif
@if (Session::has('status'))
    <div class="alert alert-{{ Session::get('status') }}" role="alert">
        {{ Session::get('message') }}
    </div>
@endif
<h3>Extracurricular List</h3>
<table class="table">
    <thead>
        <tr>
            <th>No.</th>
            <th>Name</th>
            <th>Action</th>
            {{-- <th>Anggota</th> --}}
        </tr>
    </thead>
    <tbody>
        @foreach ($ekskulList as $data)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $data->name }}</td>
            <td>
                <a href="extracurricular-detail/{{ $data->id }}" class="btn btn-primary">Detail</a>
                @if (Auth::user()->role_id == 1)
                <a href="extracurricular-edit/{{ $data->id }}" class="btn btn-warning">Edit</a>
                <a href="extracurricular-delete/{{ $data->id }}" class="btn btn-danger">Delete</a>
                @endif
            </td>
            {{-- <td>
                @foreach ($data->students as $item)
                    - {{ $item->name }}<br>
                @endforeach
            </td> --}}
        </tr>
        @endforeach
    </tbody>
</table>
@endsection