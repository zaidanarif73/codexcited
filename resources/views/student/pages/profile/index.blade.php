@extends('student.layouts.master')

@section('css')
<style>
    .profile-card {
        border-radius: 1.5rem;
        box-shadow: 0 4px 24px rgba(0,0,0,0.08);
        background: #fff;
        padding: 2rem 1.5rem;
        margin-bottom: 2rem;
    }
    .profile-header {
        border-radius: 1.5rem;
        padding: 2.2rem 1rem 1.2rem 1rem;
        margin-bottom: 2.5rem;
        text-align: center;
        box-shadow: 0 4px 24px rgba(21,194,212,0.08);
    }
    .profile-avatar {
        width: 110px;
        height: 110px;
        object-fit: cover;
        border-radius: 50%;
        border: 4px solid #fff;
        box-shadow: 0 2px 12px rgba(21,194,212,0.15);
        margin-bottom: 1rem;
        background: #e3eafc;
    }
    .form-control {
        border-radius: 0.5rem;
        box-shadow: 0 2px 12px rgba(21,194,212,0.08);
        background: transparent !important;
    }
</style>
@endsection

@section('content')
<div class="container">

    <div class="profile-header my-3">
        @if(!empty($user->avatar))
            <img src="{{asset('storage/'.$user->avatar)}}" alt="{{ $user->name }}" class="profile-avatar shadow">
        @else
            <img src="https://i.pinimg.com/736x/15/04/61/150461327bd8b04d7e55d64665196d64.jpg" alt="{{ $user->name }}" class="profile-avatar shadow">
        @endif
        <h2 class="fw-bold mb-1">{{ $user->name }}</h2>
        <div class="text-info-50 mb-2">{{ $user->email }}</div>
        <span class="badge bg-info bg-opacity-25 text-white px-3 py-2">Student</span>
      </div>

    <div class="profile-card mt-3">
        <div class="card-body">
            <form action="{{route('student.profile.update')}}" method="post" autocomplete="off" onsubmit="confirm('Apakah anda yakin ingin mengirim data ini?')" enctype="multipart/form-data">
                @csrf
                @method("PUT")
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <div class="form-group row mb-3">
                            <label class="col-md-2 col-form-label">Nama Lengkap <span class="text-danger">*</span></label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="name" placeholder="Nama Lengkap" value="{{old('name',$user->name)}}" required>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-md-2 col-form-label">Email <span class="text-danger">*</span></label>
                            <div class="col-md-10">
                                <input type="email" class="form-control" name="email" placeholder="Email" value="{{old('name',$user->email)}}" required>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-md-2 col-form-label">No.HP <span class="text-danger">*</span></label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="phone" placeholder="No.HP" value="{{old('name',$user->phone)}}" required>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-md-2 col-form-label">Foto</label>
                            <div class="col-md-10">
                                <input class="form-control" type="file" name="avatar" accept="image/*">
                                <p class="text-info" style="margin-top: 0px;margin-bottom: 0px;padding-top: 0px;padding-bottom: 0px;"><small><i>Kosongkan jika tidak diubah</i></small></p>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-md-2 col-form-label">Password Baru</label>
                            <div class="col-md-10">
                                <input type="password" class="form-control" name="password" placeholder="Password">
                                <p class="text-info" style="margin-top: 0px;margin-bottom: 0px;padding-top: 0px;padding-bottom: 0px;"><small><i>Kosongkan jika tidak diubah</i></small></p>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-md-2 col-form-label">Konfirmasi Password Baru</label>
                            <div class="col-md-10">
                                <input type="password" class="form-control" name="password_confirmation" placeholder="Password Konfirmasi">
                                <p class="text-info" style="margin-top: 0px;margin-bottom: 0px;padding-top: 0px;padding-bottom: 0px;"><small><i>Kosongkan jika tidak diubah</i></small></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <a href="" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Kembali</a>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')

@endsection