@extends('layouts.mainlayout')

@section('title', 'Class')

@section('nav-class', 'active')

@section('content')
    <h1>Ini Halaman Class</h1>
    @if (Auth::user()->role_id == 1)
    <div class="my-5">
        <a href="/class-add" class="btn btn-primary">Add Data</a>
    </div>
    @endif
    @if (Session::has('status'))
        <div class="alert alert-{{ Session::get('status') }}" role="alert">
            {{ Session::get('message') }}
        </div>
    @endif
    <h3>Class List</h3>
    <table class="table">
        <thead>
            <tr>
                <th>No.</th>
                <th>name</th>
                <th>Action</th>
                {{-- <th>Students</th>
                <th>Homeroom Teacher</th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach ($classList as $data)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $data->name }}</td>
                <td>
                    <a href="class-detail/{{ $data->id }}" class="btn btn-primary">Detail</a>
                    @if (Auth::user()->role_id == 1)
                    <a href="class-edit/{{ $data->id }}" class="btn btn-warning">Edit</a>
                    <a href="class-delete/{{ $data->id }}" class="btn btn-danger">Delete</a>
                    @endif
                </td>
                {{-- <td>
                    @foreach ($data->students as $student)
                        - {{ $student['name'] }}<br>
                    @endforeach
                </td>

                <td>{{ $data->homeroomTeacher->name }}</td> --}}
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
