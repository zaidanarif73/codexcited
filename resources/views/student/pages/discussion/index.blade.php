@extends('student.layouts.master')

@section('css')
<style>
  .forum-header {
      background: linear-gradient(90deg, #06b6d4 0%, #3b82f6 100%);
      color: #fff;
      border-radius: 1.5rem;
      padding: 2rem 1rem;
      margin-bottom: 2.5rem;
      text-align: center;
      box-shadow: 0 4px 24px rgba(0,0,0,0.08);
    }
    .forum-card {
      border-radius: 1.5rem;
      box-shadow: 0 4px 24px rgba(0,0,0,0.08);
      background: #fff;
      padding: 2rem 1.5rem;
      margin-bottom: 2rem;
    }
    .topic-title {
      font-weight: 600;
      color: #15c2d4;
      text-decoration: none;
      word-break: break-word;
      transition: color 0.2s;
    }
    .topic-title:hover {
      color: #0d8fa5;
      text-decoration: underline;
    }
    .avatar {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      object-fit: cover;
      margin-right: 0.75rem;
      background: #e3eafc;
      border: 2px solid #e3eafc;
    }
    .badge-category {
      font-size: 0.9rem;
      background: #e3eafc;
      color: #3b82f6;
      margin-right: 0.5rem;
      border-radius: 1rem;
      padding: 0.3em 1em;
    }
    .btn-new-topic {
      background: #15c2d4;
      color: #fff;
      border-radius: 2rem;
      font-weight: 500;
      transition: background 0.2s;
    }
    .btn-new-topic:hover {
      background: #119ab0;
      color: #fff;
    }
    .forum-table th, .forum-table td {
      vertical-align: middle;
      border: none;
      background: transparent;
    }
    .forum-table tbody tr {
      transition: background 0.2s;
    }
    .forum-table tbody tr:hover {
      background: #f0f8ff;
    }
    @media (max-width: 575.98px) {
      .forum-header { font-size: 1rem; padding: 1.2rem 0.5rem; }
      .forum-card { padding: 1rem 0.5rem; }
      .avatar { width: 30px; height: 30px; margin-right: 0.5rem; }
      .forum-table th, .forum-table td { font-size: 0.97rem; }
      .btn-new-topic { width: 100%; }
    }
</style>
@endsection

@section('content')
<!-- Forum Header -->
<div class="container">
  <div class="forum-header mb-3 mt-3">
    <h1 class="display-6 fw-bold mb-2">Forum Diskusi</h1>
    <p class="lead mb-0">Bertanya, berbagi, dan diskusi seputar kursus, tugas, dan pengembangan diri bersama komunitas CODEXCITED!</p>
  </div>

  <!-- New Topic Button -->
  <div class="d-flex justify-content-end mb-3">
    <a href="#" class="btn btn-new-topic px-4 py-2 shadow-sm"><i class="bi bi-plus-lg me-2"></i>Buat Topik Baru</a>
  </div>

  <!-- Forum Card/Table -->
  <div class="forum-card mx-auto" style="max-width: 950px;">
    <div class="table-responsive">
      <table class="table align-middle forum-table mb-0">
        <thead>
          <tr class="text-info">
            <th scope="col">Topik Diskusi</th>
            <th scope="col" class="text-center">Kategori</th>
            <th scope="col" class="text-center">Balasan</th>
            <th scope="col" class="text-center">Terakhir Diperbarui</th>
            <th scope="col" class="text-center">Oleh</th>
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
              <img src="https://i.pravatar.cc/40?img=1" alt="Sarah" class="avatar">
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
              <img src="https://i.pravatar.cc/40?img=2" alt="Andi" class="avatar">
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
              <img src="https://i.pravatar.cc/40?img=3" alt="Rina" class="avatar">
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
              <img src="https://i.pravatar.cc/40?img=4" alt="Budi" class="avatar">
              <span>Budi Santoso</span>
            </td>
          </tr>
          <!-- Add more topics as needed -->
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection