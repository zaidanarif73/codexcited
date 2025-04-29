@extends('student.layouts.master')
@section('css')
<style>
.leaderboard-header {
      background: linear-gradient(90deg, #06b6d4 0%, #3b82f6 100%);
      color: #fff;
      border-radius: 1.5rem;
      padding: 2rem 1rem;
      margin-bottom: 2.5rem;
      text-align: center;
      box-shadow: 0 4px 24px rgba(0,0,0,0.08);
    }
    .leaderboard-card {
      border-radius: 1.5rem;
      box-shadow: 0 4px 24px rgba(0,0,0,0.08);
      background: #fff;
      padding: 2rem 1.5rem;
      margin-bottom: 2rem;
    }
    .avatar {
      width: 48px;
      height: 48px;
      border-radius: 50%;
      object-fit: cover;
      margin-right: 1rem;
      border: 3px solid #e3eafc;
      background: #e3eafc;
    }
    .rank-badge {
      font-size: 1.1rem;
      font-weight: 700;
      width: 2.2rem;
      height: 2.2rem;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      border-radius: 50%;
      margin-right: 0.6rem;
    }
    .rank-1 { background: gold; color: #fff; }
    .rank-2 { background: silver; color: #fff; }
    .rank-3 { background: #cd7f32; color: #fff; }
    .table-leaderboard th, .table-leaderboard td {
      vertical-align: middle;
      border: none;
    }
    .table-leaderboard tbody tr {
      transition: background 0.2s;
    }
    .table-leaderboard tbody tr:hover {
      background: #f0f8ff;
    }
    @media (max-width: 575.98px) {
      .leaderboard-header { font-size: 1rem; padding: 1.2rem 0.5rem; }
      .leaderboard-card { padding: 1rem 0.5rem; }
      .avatar { width: 36px; height: 36px; margin-right: 0.5rem; }
      .rank-badge { width: 1.6rem; height: 1.6rem; font-size: 1rem; }
      .table-leaderboard th, .table-leaderboard td { font-size: 0.97rem; }
    }
</style>
@endsection

@section('content')
 <!-- Leaderboard Header -->
 <div class="container">
  <div class="leaderboard-header mb-3 mt-3">
    <h1 class="display-6 fw-bold mb-2">Leaderboard Siswa</h1>
    <p class="lead mb-0">Peringkat siswa paling aktif dan berprestasi di CODEXCITED</p>
  </div>

  <!-- Leaderboard Card/Table -->
  <div class="leaderboard-card mx-auto" style="max-width: 800px;">
    <div class="table-responsive">
      <table class="table align-middle table-leaderboard mb-0">
        <thead>
          <tr class="text-info">
            <th scope="col">Rank</th>
            <th scope="col">Nama</th>
            <th scope="col" class="text-center">Courses</th>
            <th scope="col" class="text-center">Score</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><span class="rank-badge rank-1">1</span></td>
            <td>
              <div class="d-flex align-items-center">
                <img src="https://i.pravatar.cc/48?img=1" alt="Sarah Wijaya" class="avatar">
                <span class="fw-semibold">Sarah Wijaya</span>
              </div>
            </td>
            <td class="text-center">5</td>
            <td class="text-center fw-bold text-warning">980</td>
          </tr>
          <tr>
            <td><span class="rank-badge rank-2">2</span></td>
            <td>
              <div class="d-flex align-items-center">
                <img src="https://i.pravatar.cc/48?img=2" alt="Andi Nugroho" class="avatar">
                <span class="fw-semibold">Andi Nugroho</span>
              </div>
            </td>
            <td class="text-center">4</td>
            <td class="text-center fw-bold text-secondary">920</td>
          </tr>
          <tr>
            <td><span class="rank-badge rank-3">3</span></td>
            <td>
              <div class="d-flex align-items-center">
                <img src="https://i.pravatar.cc/48?img=3" alt="Rina Putri" class="avatar">
                <span class="fw-semibold">Rina Putri</span>
              </div>
            </td>
            <td class="text-center">4</td>
            <td class="text-center fw-bold text-secondary">870</td>
          </tr>
          <tr>
            <td><span class="rank-badge bg-secondary text-white">4</span></td>
            <td>
              <div class="d-flex align-items-center">
                <img src="https://i.pravatar.cc/48?img=4" alt="Budi Santoso" class="avatar">
                <span class="fw-semibold">Budi Santoso</span>
              </div>
            </td>
            <td class="text-center">3</td>
            <td class="text-center fw-bold">830</td>
          </tr>
          <tr>
            <td><span class="rank-badge bg-secondary text-white">5</span></td>
            <td>
              <div class="d-flex align-items-center">
                <img src="https://i.pravatar.cc/48?img=5" alt="Lina Rahma" class="avatar">
                <span class="fw-semibold">Lina Rahma</span>
              </div>
            </td>
            <td class="text-center">3</td>
            <td class="text-center fw-bold">800</td>
          </tr>
          <!-- Add more students as needed -->
        </tbody>
      </table>
    </div>
    <div class="text-center pt-3">
      <small class="text-muted">Leaderboard diperbarui otomatis berdasarkan skor dan aktivitas kursus.</small>
    </div>
  </div>
</div>
@endsection