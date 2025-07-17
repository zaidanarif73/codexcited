@extends('teacher.layouts.master')
@section("title","Materi ~ CODEXCITED teacher")
@section("title_breadcumb","Materi")
@section('css')
    <style>
        .form-select {
            border-left: 0;
            border-top: 0;
            border-right: 0;
            border-radius: 0;
            padding-left: 0;
            background: 0 0 !important;
        }
    </style>
@endsection
@section('breadcumb', 'Materi')
@section('breadcumb_child', 'Create')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <!-- Display validation errors if any -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('teacher.materi.store') }}" method="POST" autocomplete="off"
                            onsubmit="confirm('Apakah anda yakin ingin mengirim data ini?')" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-lg-12">
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label">Judul <span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="title" placeholder="Judul"
                                                value="{{ old('title') }}" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label" for="description">Deskripsi <span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="description" placeholder="Deskripsi Singkat"
                                                value="{{ old('description') }}" required>
                                            {{-- @trix(\App\Models\Materi::class, 'content') --}}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label">Cover<span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input class="form-control" type="file" name="cover" accept="image/*">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label">Tipe Materi <span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <select name="type" class="form-select" id="typeSelect" required>
                                                <option value="">Pilih Tipe Materi</option>
                                                <option value="html" {{ old('type') == 'html' ? 'selected' : '' }}>HTML</option>
                                                <option value="css" {{ old('type') == 'css' ? 'selected' : '' }}>CSS</option>
                                                <option value="javascript" {{ old('type') == 'javascript' ? 'selected' : '' }}>Javascript</option>
                                                <option value="custom" {{ old('type') == 'custom' ? 'selected' : '' }}>Lainnya...</option>
                                            </select>

                                            {{-- input manual muncul jika pilih "custom" --}}
                                            <input type="text" name="custom_type" id="customTypeInput" class="form-control mt-2"
                                                placeholder="Tulis tipe materi secara manual"
                                                value="{{ old('custom_type') }}" style="display: none;">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label">Tingkat Kesulitan <span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <select name="difficulty" class="form-select" required>
                                                <option value="">Pilih Tingkat Kesulitan</option>
                                                <option value="1">Pemula</option>
                                                <option value="2">Sedang</option>
                                                <option value="3">Mahir</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <a href="{{ route('teacher.materi.index') }}" class="btn btn-warning">
                                        <i class="fa fa-arrow-left"></i> Kembali
                                    </a>
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>
                                        Simpan
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const select = document.getElementById('typeSelect');
        const customInput = document.getElementById('customTypeInput');

        function toggleCustomInput() {
            if (select.value === 'custom') {
                customInput.style.display = 'block';
                customInput.required = true;
            } else {
                customInput.style.display = 'none';
                customInput.required = false;
            }
        }

        // Panggil saat load dan saat berubah
        toggleCustomInput();
        select.addEventListener('change', toggleCustomInput);
    });
</script>
@endsection
