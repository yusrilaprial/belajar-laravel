@extends('layouts.mainlayout')

@section('title', 'Deleted Students')

@section('nav-students', 'active')

@section('content')
    <h1>Ini Halaman Deleted Student</h1>

    <div class="my-5">
        <a href="/students" class="btn btn-primary">Back</a>
    </div>

    <h3>Deleted Student List</h3>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Gender</th>
                <th>NIS</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($deletedStudent as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->name }}</td>
                    <td>{{ $data->gender }}</td>
                    <td>{{ $data->nis }}</td>
                    <td>
                        <a href="student/{{ $data->id }}/restore" class="btn btn-success">Restore</a>
                    </td>
            @endforeach
        </tbody>
    </table>
@endsection
