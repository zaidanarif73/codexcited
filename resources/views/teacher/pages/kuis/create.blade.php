@extends('teacher.layouts.master')
@section("title", "Tambah Kuis")
@section("title_breadcumb", "Materi")
@section("breadcumb", "Materi")
@section("breadcumb_child", "Tambah Kuis")

@section('content')
<div class="container py-4">
    <h4>Tambah Kuis untuk Materi: <strong>{{ $materi->title }}</strong></h4>

    <form action="{{ route('teacher.materi.kuis.store', $materi->id) }}" method="POST">
        @csrf

        <div class="form-group mb-3">
            <label for="question">Pertanyaan</label>
            <textarea class="form-control" name="question" rows="3" required>{{ old('question') }}</textarea>
        </div>

        <div class="form-group mb-3">
            <label for="options[]">Pilihan Jawaban</label>
            @php $letters = ['A', 'B', 'C', 'D']; @endphp
            @foreach ($letters as $index => $letter)
                <div class="input-group mb-2">
                    <span class="input-group-text">{{ $letter }}.</span>
                    <input type="text" name="options[]" class="form-control" placeholder="Pilihan {{ $letter }}" required>
                </div>
            @endforeach
        </div>

        <div class="form-group mb-3">
            <label for="correct">Jawaban Benar</label>
            <select name="correct" class="form-control" required>
                @foreach ($letters as $index => $letter)
                    <option value="{{ $index }}">Pilihan {{ $letter }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="explanation">Penjelasan</label>
            <textarea class="form-control" name="explanation" rows="3">{{ old('explanation') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('teacher.materi.kuis.index', $materi->id) }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection