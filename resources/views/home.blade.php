@extends('layouts.mainlayout')

@section('title', 'Home')

@section('nav-home', 'active')

@section('content')
    <h1>Ini Halaman Home</h1>
    <h2>Selamat Datang, {{ Auth::user()->name }}. Anda adalah {{ Auth::user()->role->name }}</h2>
    {{ Auth::user() }}
    <x-alert message='ini adalah halaman home' type='success'/>
    <x-alert message='ini adalah halaman home 2' type='danger'/>

    {{-- @if ($role == 'admin')
    <a href="">ke halaman Admin</a>
    @elseif ($role == 'staff')
        <a href="">ke halaman Gudang</a>
    @else
        <a href="">ke halaman About</a>
    @endif --}}

    {{-- @switch($role)
    @case($role == 'admin')
        <a href="">ke halaman Admin</a>
        @break

    @case($role == 'staff')
        <a href="">ke halaman Gudang</a>
        @break

    @default
        <a href="">ke halaman About</a>
    @endswitch --}}

    {{-- @for ($i = 0; $i < 5; $i++)
        {{ $i }} <br>
    @endfor --}}

    {{-- <table class="table">
        <tr>
            <th>No.</th>
            <th>Nama</th>
        </tr>
        @foreach ($buah as $data)
            <tr>
                <th>{{ $loop->iteration }}</th>
                <td>{{ $data }}</td>
            </tr>
        @endforeach
    </table> --}}
@endsection
