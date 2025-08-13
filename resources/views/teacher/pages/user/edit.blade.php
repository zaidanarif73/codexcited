@extends('teacher.layouts.master')
@section('title','Edit Siswa ~ CODEXCITED teacher')
@section('title_breadcumb','Edit Siswa')
@section('breadcumb','Users')
@section('breadcumb_child', 'Edit')
@section('css')
<style>
    .avatar-preview {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 10px;
        border: 2px solid #ddd;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="card p-4">
        <h5 class="mb-4"><i class="fas fa-user-edit text-primary me-2"></i> Edit Siswa</h5>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('teacher.user.update', $student->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $student->name) }}">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $student->email) }}">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password <small class="text-muted">(kosongkan jika tidak ingin diubah)</small></label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
            </div>

            <div class="mb-3">
                <label for="avatar" class="form-label">Avatar</label>
                <div>
                    <img id="avatarPreview" src="{{ $student->avatar ? asset('storage/'.$student->avatar) : 'https://i.pinimg.com/736x/15/04/61/150461327bd8b04d7e55d64665196d64.jpg' }}" class="avatar-preview">
                </div>
                <input type="file" class="form-control @error('avatar') is-invalid @enderror" id="avatar" name="avatar" accept="image/*">
                @error('avatar')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Simpan Perubahan</button>
            <a href="{{ route('teacher.user.index') }}" class="btn btn-secondary ms-2"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
        </form>
    </div>
</div>
@endsection

@section('js')
<script>
    // Preview avatar
    document.getElementById('avatar').addEventListener('change', function(event) {
        const [file] = event.target.files;
        if (file) {
            document.getElementById('avatarPreview').src = URL.createObjectURL(file);
        }
    });
</script>
@endsection