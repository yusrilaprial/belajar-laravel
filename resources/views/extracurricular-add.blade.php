@extends('layouts.mainlayout')

@section('title', 'Add Ekskul')

@section('nav-extracurricular', 'active')

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
    <form action="extracurricular-store" method="post">
        @csrf
        <div class="mb-3">
            <label for="name"> Extracurricular Name</label>
            <input type="text" name="name" class="form-control" id="name" required>
        </div>
        <div class="mb-3">
            <button class="btn btn-success" type="submit">Save</button>
        </div>
    </form>
</div>
@endsection