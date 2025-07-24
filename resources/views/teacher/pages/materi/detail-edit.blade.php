@extends('teacher.layouts.master')
@section('title', 'Edit Submateri - ' . $materi->title . ' ~ CODEXCITED teacher')
@section("title_breadcumb","Materi")
@section("breadcumb","Materi")
@section("breadcumb_child","Detail")
@section('content')
<div class="container">
    <h4>Edit Submateri untuk Materi: <strong>{{ $materi->title }}</strong></h4>
    <form action="{{ route('teacher.materi.detail.update', [$materi->id, $detail->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Judul Submateri</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $detail->title) }}" required>
        </div>

        <div class="form-group mt-3">
            <label for="description">Deskripsi</label>
            <input id="trix" type="hidden" name="description" value="{{ old('description', $detail->description) }}">
            <trix-editor input="trix"></trix-editor>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Update</button>
    </form>
</div>
@endsection