@extends('teacher.layouts.master')

@section("title", "Daftar Kuis - $materi->title ~ CODEXCITED teacher")
@section("title_breadcumb", "Materi")
@section("breadcumb", "Materi")
@section("breadcumb_child", "Daftar Kuis")

@section('content')
<div class="container">
    <h4 class="mb-3">Kuis untuk Materi: {{ $materi->title }}</h4>

    <div class="mb-3">
        <a href="{{ route('teacher.materi.kuis.create', $materi->id) }}" class="btn btn-primary">
            + Tambah Kuis Baru
        </a>
        <a href="{{ route('teacher.materi.show', $materi->id) }}" class="btn btn-secondary">
            ← Kembali ke Detail Materi
        </a>
    </div>

    @if($kuis->count())
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Pertanyaan</th>
                    <th>Pilihan</th>
                    <th>Jawaban Benar</th>
                    <th>Penjelasan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($materi->kuis as $index => $kuis)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $kuis->question }}</td>
                        <td>
                            <ol type="A">
                                @foreach($kuis->options as $i => $option)
                                    <li @if($i == $kuis->correct) class="text-success fw-bold" @endif>
                                        {{ $option }}
                                    </li>
                                @endforeach
                            </ol>
                        </td>
                        <td>{{ $kuis->options[$kuis->correct] ?? '-' }}</td>
                        <td>{{ $kuis->explanation }}</td>
                        <td>
                            <a href="{{ route('teacher.materi.kuis.edit', [$materi->id, $kuis->id]) }}" 
                            class="text-warning me-2" 
                            title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>

                            <form action="{{ route('teacher.materi.kuis.destroy', [$materi->id, $kuis->id]) }}" 
                                method="POST" 
                                style="display:inline;" 
                                onsubmit="return confirm('Yakin ingin menghapus kuis ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-link text-danger p-0 m-0" title="Hapus">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
        <p class="text-muted">Belum ada kuis untuk materi ini.</p>
    @endif
</div>
@endsection