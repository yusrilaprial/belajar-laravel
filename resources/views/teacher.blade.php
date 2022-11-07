@extends('layouts.mainlayout')

@section('title', 'Teacher')

@section('nav-teacher', 'active')

@section('content')
    <h1>Ini Halaman Teacher</h1>
    @if (Auth::user()->role_id == 1)
    <div class="my-5">
        <a href="/teacher-add" class="btn btn-primary">Add Data</a>
    </div>
    @endif
    @if (Session::has('status'))
        <div class="alert alert-{{ Session::get('status') }}" role="alert">
            {{ Session::get('message') }}
        </div>
    @endif
    <h3>Teacher List</h3>
    <table class="table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($teacherList as $data)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $data->name }}</td>
                <td>
                    @if (Auth::user()->role_id == 1)
                        <a href="teacher-detail/{{ $data->id }}" class="btn btn-primary">Detail</a>
                        <a href="teacher-edit/{{ $data->id }}" class="btn btn-warning">Edit</a>
                        <a href="teacher-delete/{{ $data->id }}" class="btn btn-danger">Delete</a>
                    @else
                        <a class="btn btn-secondary disabled">No Action</a>
                    @endif
                </td>
            @endforeach
        </tbody>
    </table>
@endsection
