@extends('layouts.mainlayout')

@section('title', 'Students')

@section('nav-students', 'active')

@section('content')
    <h1>Ini Halaman Students</h1>
    <x-alert message='ini adalah halaman student' type='warning'/>
    @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
    <div class="my-5 d-flex justify-content-between">
        <a href="/student-add" class="btn btn-primary">Add Data</a>
        @if (Auth::user()->role_id == 1)
        <a href="/student-deleted" class="btn btn-info">Show Delete Data</a>
        @endif
    </div>
    @endif
    @if (Session::has('status'))
        <div class="alert alert-{{ Session::get('status') }}" role="alert">
            {{ Session::get('message') }}
        </div>
    @endif
    <h3>Student List</h3>
    <div class="my-3 col-12 col-sm-8 col-md-5">
        <form action="" method="get">
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="search" placeholder="Search">
                <button class="input-group-text btn btn-primary">Search</button>
            </div>
        </form>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Gender</th>
                <th>NIS</th>
                <th>Class</th>
                <th>Action</th>
                {{-- <th>Class</th>
                <th>Extracurricular</th>
                <th>Homeroom Teacher</th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach ($studentList as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->name }}</td>
                    <td>{{ $data->gender }}</td>
                    <td>{{ $data->nis }}</td>
                    <td>{{ $data->class->name }}</td>
                    <td>
                        @if (Auth::user()->role_id != 1 && Auth::user()->role_id != 2)
                            <a class="btn btn-secondary disabled">No Action</a>
                        @else
                            <a href="student/{{ $data->slug }}" class="btn btn-primary">Detail</a>
                            <a href="student-edit/{{ $data->slug }}" class="btn btn-warning">Edit</a>
                        @endif
                        @if (Auth::user()->role_id == 1)
                        <a href="student-delete/{{ $data->slug }}" class="btn btn-danger">Delete</a>
                        @endif
                    </td>
                    {{-- <td>{{ $data->class['name'] }}</td>
                <td>
                    @foreach ($data->extracurriculars as $item)
                        - {{ $item->name }}<br>
                    @endforeach
                </td>
                <td>{{ $data->class->homeroomTeacher->name }}</td>
            </tr> --}}
            @endforeach
        </tbody>
    </table>
    {{-- <ol>
        @foreach ($studentList as $data)
            <li>
                {{ $data->name }} | {{ $data->gender }} |{{ $data->nis }}
            </li>
        @endforeach
    </ol> --}}
    <div class="my-5">
        {{ $studentList->withQueryString()->links() }}
    </div>
@endsection
