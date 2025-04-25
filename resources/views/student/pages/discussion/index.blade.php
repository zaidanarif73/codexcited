@extends('student.layouts.master')

@section('css')
<style>
    body {
      background: linear-gradient(135deg, #f4fafe 0%, #e3eafc 100%);
      min-height: 100vh;
    }
    .forum-hero {
      background: linear-gradient(90deg, #06b6d4 0%, #3b82f6 100%);
      color: #fff;
      border-radius: 1.5rem;
      padding: 2rem 1rem;
      margin-bottom: 2.5rem;
      text-align: center;
      box-shadow: 0 4px 24px rgba(0,0,0,0.08);
    }
    .topic-title {
      font-weight: 600;
      color: #15c2d4;
      text-decoration: none;
      word-break: break-word;
    }
    .topic-title:hover {
      text-decoration: underline;
      color: #0d8fa5;
    }
    .avatar {
      width: 36px;
      height: 36px;
      border-radius: 50%;
      object-fit: cover;
      margin-right: 0.5rem;
    }
    .badge-category {
      font-size: 0.85rem;
      background: #e3eafc;
      color: #3b82f6;
      margin-right: 0.5rem;
    }
    @media (max-width: 575.98px) {
      .forum-hero {
        font-size: 1rem;
        padding: 1.2rem 0.5rem;
      }
      .avatar {
        width: 28px;
        height: 28px;
        margin-right: 0.4rem;
      }
      .table th, .table td {
        font-size: 0.95rem;
        padding: 0.5rem;
      }
    }
</style>
@endsection

@section('content')
<!-- Hero Section -->
<div class="container">
    <div class="forum-hero mb-5 mt-3">
      <h1 class="display-6 fw-bold mb-2">Forum Diskusi</h1>
      <p class="lead mb-0">Bertanya, berbagi, dan diskusi seputar kursus, tugas, dan pengembangan diri bersama komunitas CODEXCITED!</p>
    </div>

    <!-- Forum Table -->
    <div class="card shadow-sm border-0 mb-4">
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table align-middle mb-0">
            <thead class="table-light">
              <tr>
                <th style="width:38%">Topik Diskusi</th>
                <th class="text-center" style="width:12%">Kategori</th>
                <th class="text-center" style="width:10%">Balasan</th>
                <th class="text-center" style="width:20%">Terakhir Diperbarui</th>
                <th class="text-center" style="width:20%">Oleh</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <a href="#" class="topic-title">Bagaimana cara submit tugas dengan benar?</a>
                </td>
                <td class="text-center">
                  <span class="badge badge-category">Tugas</span>
                </td>
                <td class="text-center">12</td>
                <td class="text-center"><small>10 menit lalu</small></td>
                <td class="d-flex align-items-center justify-content-center">
                  <img src="https://i.pravatar.cc/36?img=1" alt="Sarah" class="avatar">
                  <span>Sarah Wijaya</span>
                </td>
              </tr>
              <tr>
                <td>
                  <a href="#" class="topic-title">Tips belajar JavaScript untuk pemula?</a>
                </td>
                <td class="text-center">
                  <span class="badge badge-category">Programming</span>
                </td>
                <td class="text-center">8</td>
                <td class="text-center"><small>1 jam lalu</small></td>
                <td class="d-flex align-items-center justify-content-center">
                  <img src="https://i.pravatar.cc/36?img=2" alt="Andi" class="avatar">
                  <span>Andi Nugroho</span>
                </td>
              </tr>
              <tr>
                <td>
                  <a href="#" class="topic-title">Diskusi: Project akhir Web Design 101</a>
                </td>
                <td class="text-center">
                  <span class="badge badge-category">Web Design</span>
                </td>
                <td class="text-center">5</td>
                <td class="text-center"><small>2 jam lalu</small></td>
                <td class="d-flex align-items-center justify-content-center">
                  <img src="https://i.pravatar.cc/36?img=3" alt="Rina" class="avatar">
                  <span>Rina Putri</span>
                </td>
              </tr>
              <tr>
                <td>
                  <a href="#" class="topic-title">Saran fitur baru untuk platform ini?</a>
                </td>
                <td class="text-center">
                  <span class="badge badge-category">Saran</span>
                </td>
                <td class="text-center">3</td>
                <td class="text-center"><small>kemarin</small></td>
                <td class="d-flex align-items-center justify-content-center">
                  <img src="https://i.pravatar.cc/36?img=4" alt="Budi" class="avatar">
                  <span>Budi Santoso</span>
                </td>
              </tr>
              <!-- Add more topics as needed -->
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- New Topic Button -->
    <div class="text-end mb-5">
      <a href="#" class="btn btn-info text-white px-4 py-2 shadow-sm"><i class="bi bi-plus-lg me-2"></i>Buat Topik Baru</a>
    </div>
</div>
@endsection