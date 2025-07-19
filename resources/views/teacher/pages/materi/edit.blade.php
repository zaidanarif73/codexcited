@extends('teacher.layouts.master')
@section("title","Materi ~ CODEXCITED teacher")
@section("title_breadcumb","Materi")
@section("breadcumb","Materi")
@section("breadcumb_child","Edit")
@section("content")
<div class="container">
    <div class="row">
        <div class="col-xl-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <form action="{{route('teacher.materi.update',$result->id)}}" method="post" autocomplete="off" onsubmit="confirm('Apakah anda yakin ingin mengirim data ini?')" enctype="multipart/form-data">
                        @csrf
                        @method("PUT")
                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label">Judul Materi<span class="text-danger">*</span></label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="title" placeholder="Judul" value="{{ old('title', $result->title) }}" required>
                                    </div>
                                </div>
                                
                                
                                <div class="form-group row" >
                                    <label class="col-md-2 col-form-label" for="description">Deskripsi Singkat<span class="text-danger">*</span></label>
                                    <div class="col-md-10"   >  
                                        <textarea class="form-control" name="description" id="description" rows="5" placeholder="Deskripsi Singkat" required>{{ old('description', $result->description) }}</textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label">Cover Materi</label>
                                    <div class="col-md-10">
                                        <input type="file" class="form-control-file" name="cover" accept="image/*">
                                        @if($result->cover)
                                            <img src="{{ asset('storage/' . $result->cover) }}" alt="Cover Materi" class="img-thumbnail mt-2" style="max-width: 200px;">
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row ">
                                    <label class="col-md-2 col-form-label">Tipe Materi</label>
                                    <div class="col-md-10">
                                        <select class="form-control" name="type" id="typeSelect" required>
                                            <option value="html" {{ old('type', $result->type) == 'html' ? 'selected' : '' }}>HTML</option>
                                            <option value="css" {{ old('type', $result->type) == 'css' ? 'selected' : '' }}>CSS</option>
                                            <option value="javascript" {{ old('type', $result->type) == 'javascript' ? 'selected' : '' }}>Javascript</option>
                                            <option value="custom" {{ old('type', $result->type) == 'custom' ? 'selected' : '' }}>Lainnya...</option>
                                        </select>

                                        {{-- input manual muncul jika pilih "custom" --}}
                                        <input type="text" name="custom_type" id="customTypeInput" class="form-control mt-2"
                                                placeholder="Tulis tipe materi secara manual"
                                                value="{{ old('custom_type') }}" style="display: none;">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label">Tingkat Kesulitan</label>
                                    <div class="col-md-10">
                                        <select class="form-control" name="difficulty" required>
                                            <option value="1" {{ old('difficulty', $result->difficulty) == '1' ? 'selected' : '' }}>Pemula</option>
                                            <option value="2" {{ old('difficulty', $result->difficulty) == '2' ? 'selected' : '' }}>Sedang</option>
                                            <option value="3" {{ old('difficulty', $result->difficulty) == '3' ? 'selected' : '' }}>Mahir</option>
                                        </select>
                                    </div>
                                </div>

                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <a href="{{route('teacher.materi.index')}}" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Kembali</a>
                                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
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
    $(document).ready(function() {
        // Tampilkan input manual jika tipe materi adalah "custom"
        $('#typeSelect').change(function() {
            if ($(this).val() === 'custom') {
                $('#customTypeInput').show();
            } else {
                $('#customTypeInput').hide();
            }
        });

        // Inisialisasi tampilan input manual
        if ($('#typeSelect').val() === 'custom') {
            $('#customTypeInput').show();
        } else {
            $('#customTypeInput').hide();
        }
    });
</script>
@endsection
