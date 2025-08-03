@extends('teacher.layouts.master')
@section("title", "Edit Kuis")

@section('content')
<div class="container mt-4">
    <h4>Edit Kuis untuk: {{ $materi->title }}</h4>

    <form action="{{ route('teacher.materi.kuis.update', [$materi->id, $kuis->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="question" class="form-label">Pertanyaan</label>
            <input type="text" name="question" class="form-control" value="{{ old('question', $kuis->question) }}" required>
        </div>

        @foreach ($kuis->options as $i => $option)
            <div class="mb-3">
                <label class="form-label">Pilihan {{ chr(65 + $i) }}</label>
                <input type="text" name="options[]" class="form-control" value="{{ old('options.' . $i, $option) }}" required>
            </div>
        @endforeach

        <div class="mb-3">
            <label for="correct" class="form-label">Jawaban Benar (A-D)</label>
            <select name="correct" class="form-select">
                @for ($i = 0; $i <= 3; $i++)
                    <option value="{{ $i }}" {{ $kuis->correct == $i ? 'selected' : '' }}>{{ chr(65 + $i) }}</option>
                @endfor
            </select>
        </div>

        <div class="mb-3">
            <label for="explanation" class="form-label">Penjelasan (opsional)</label>
            <textarea name="explanation" class="form-control">{{ old('explanation', $kuis->explanation) }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Update Kuis</button>
    </form>
</div>
@endsection