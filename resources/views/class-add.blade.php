@extends('layouts.mainlayout')

@section('title', 'Add Class')

@section('nav-class', 'active')

@section('content')
    <div class="mt-5 col-8 m-auto">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="class-store" method="post">
            @csrf
            <div class="mb-3">
                <label for="name">Name Class</label>
                <input type="text" name="name" class="form-control" id="name" required>
            </div>
            <div class="mb-3">
                <label for="teacher">Homeroom Teacher</label>
                <select name="teacher_id" id="teacher" class="form-control" required>
                    <option value="">Select One</option>
                    @foreach ($teacher as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <button class="btn btn-success" type="submit">Save</button>
            </div>
        </form>
    </div>
@endsection