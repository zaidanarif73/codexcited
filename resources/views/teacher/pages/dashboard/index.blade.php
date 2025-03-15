@extends('teacher.layouts.master')
@section('content')
    <p>Ini Halaman Dashboard Teacher</p>
    <a href="{{ route('auth.logout') }}">log out</a>
@endsection