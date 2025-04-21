@extends('student.layouts.master')
@section('css')
<style>
    body {
        background: linear-gradient(135deg, #f4fafe 0%, #e3eafc 100%);
        min-height: 100vh;
        }
        .leaderboard-card {
        border: none;
        border-radius: 1.5rem;
        box-shadow: 0 4px 24px rgba(0,0,0,0.08);
        background: #fff;
        overflow: hidden;
        }
        .leaderboard-header {
        background: linear-gradient(90deg, #06b6d4 0%, #3b82f6 100%);
        color: #fff;
        padding: 2rem 1rem 1rem 1rem;
        text-align: center;
        border-radius: 1.5rem 1.5rem 0 0;
        }
        .table-leaderboard th, .table-leaderboard td {
        vertical-align: middle;
        }
        .rank-badge {
        font-size: 1.2rem;
        font-weight: bold;
        width: 2.5rem;
        height: 2.5rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        }
        .rank-1 { background: gold; color: #fff; }
        .rank-2 { background: silver; color: #fff; }
        .rank-3 { background: #cd7f32; color: #fff; }
        .user-avatar {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #e3eafc;
        margin-right: 0.75rem;
        }
        .badge-star {
        color: #fbbf24;
        font-size: 1.1rem;
        margin-left: 0.25rem;
        }
        @media (max-width: 575px) {
        .leaderboard-header { font-size: 1rem; padding: 1rem 0.5rem; }
        .user-avatar { width: 36px; height: 36px; }
    }
</style>
@endsection

@section('content')
<div class="container py-4">
    <div class="leaderboard-card mx-auto mb-4" style="max-width:700px;">
      <div class="leaderboard-header">
        <h1 class="fw-bold mb-1">Leaderboard Siswa</h1>
        <p class="mb-0">Peringkat siswa yang telah berpartisipasi aktif dalam kursus</p>
      </div>
      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0 table-leaderboard">
          <thead>
            <tr>
              <th scope="col">Rank</th>
              <th scope="col">Nama Siswa</th>
              <th scope="col">Course Attempted</th>
              <th scope="col">Score</th>
            </tr>
          </thead>
          <tbody>
            <!-- Rank 1 -->
            <tr class="fw-bold">
              <td>
                <span class="rank-badge rank-1">1</span>
                <i class="bi bi-star-fill badge-star"></i>
              </td>
              <td>
                <img src="https://i.pravatar.cc/48?img=1" alt="Sarah Wijaya" class="user-avatar">
                Sarah Wijaya
              </td>
              <td>5</td>
              <td>980</td>
            </tr>
            <!-- Rank 2 -->
            <tr>
              <td>
                <span class="rank-badge rank-2">2</span>
                <i class="bi bi-star-fill badge-star"></i>
              </td>
              <td>
                <img src="https://i.pravatar.cc/48?img=2" alt="Andi Nugroho" class="user-avatar">
                Andi Nugroho
              </td>
              <td>4</td>
              <td>920</td>
            </tr>
            <!-- Rank 3 -->
            <tr>
              <td>
                <span class="rank-badge rank-3">3</span>
                <i class="bi bi-star-fill badge-star"></i>
              </td>
              <td>
                <img src="https://i.pravatar.cc/48?img=3" alt="Rina Putri" class="user-avatar">
                Rina Putri
              </td>
              <td>4</td>
              <td>870</td>
            </tr>
            <!-- Rank 4 -->
            <tr>
              <td>
                <span class="rank-badge bg-secondary text-white">4</span>
              </td>
              <td>
                <img src="https://i.pravatar.cc/48?img=4" alt="Budi Santoso" class="user-avatar">
                Budi Santoso
              </td>
              <td>3</td>
              <td>830</td>
            </tr>
            <!-- Rank 5 -->
            <tr>
              <td>
                <span class="rank-badge bg-secondary text-white">5</span>
              </td>
              <td>
                <img src="https://i.pravatar.cc/48?img=5" alt="Lina Rahma" class="user-avatar">
                Lina Rahma
              </td>
              <td>3</td>
              <td>800</td>
            </tr>
            <!-- Add more students as needed -->
          </tbody>
        </table>
      </div>
      <div class="text-center py-3">
        <small class="text-muted">Leaderboard updated automatically based on course scores and activity.</small>
      </div>
    </div>
  </div>
@endsection