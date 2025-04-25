@extends('student.layouts.master')

@section('css')
<style>
    body {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: 100vh;
        }
        .dashboard-header {
        background: #06BBCC;
        color: #fff;
        border-radius: 1rem;
        padding: 2rem 1.5rem;
        margin-bottom: 2rem;
        box-shadow: 0 4px 24px rgba(0,0,0,0.08);
        }
        .card {
        border: none;
        border-radius: 1rem;
        transition: transform 0.15s;
        box-shadow: 0 2px 12px rgba(0,0,0,0.07);
        }
        .card:hover {
        transform: translateY(-6px) scale(1.03);
        box-shadow: 0 6px 24px rgba(0,0,0,0.12);
        }
        .icon-circle {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        font-size: 1.8rem;
        margin-bottom: 0.5rem;
        }
        .bg-courses { background: #e0f7fa; color: #00bcd4; }
        .bg-progress { background: #f3e5f5; color: #7b1fa2; }
        .bg-assignments { background: #fff3e0; color: #fb8c00; }
        .activity-list li::before {
        content: "•";
        color: #007bff;
        font-weight: bold;
        display: inline-block;
        width: 1em;
        margin-left: -1em;
        }
</style>
@endsection

@section('content')
<!-- Dashboard Header with Profile Picture -->
<div class="dashboard-header d-flex align-items-center justify-content-between p-4 rounded-3 mb-4" style="background: linear-gradient(90deg, #06b6d4 0%, #3b82f6 100%); box-shadow: 0 4px 24px rgba(0,0,0,0.08);">
    <div class="container d-flex align-items-center gap-3">
      <img src="https://i.pravatar.cc/64?u=sarah" alt="users picture profile" class="rounded-circle border border-3 border-white shadow-sm" width="64" height="64">
      <div>
        <h2 class="fw-bold text-white mb-1">Selamat Datang, {{ Auth::user()->name ?? null }}</h2>
        <div class="text-white-50">Berikut adalah aktivitas anda terakhir ini</div>
      </div>
    </div>
  </div>
  
  <!-- Cards Section -->
  <div class="container">
    <div class="row g-4 mb-4">
        <div class="col-md-4">
          <div class="card text-center p-3 shadow-sm h-100 border-0 hover-shadow">
            <div class="mx-auto mb-2" style="background:#e0f7fa; width:48px; height:48px; border-radius:50%; display:flex; align-items:center; justify-content:center;">
              <i class="bi bi-journal-bookmark text-info fs-3"></i>
            </div>
            <h6 class="fw-bold mb-1">Kelas yang diikuti</h6>
            <div class="display-6 fw-bold mb-0">5</div>
            <small class="text-muted">Active courses</small>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card text-center p-3 shadow-sm h-100 border-0 hover-shadow">
            <div class="mx-auto mb-2" style="background:#f3e5f5; width:48px; height:48px; border-radius:50%; display:flex; align-items:center; justify-content:center;">
              <i class="bi bi-bar-chart-line text-primary fs-3"></i>
            </div>
            <h6 class="fw-bold mb-1">Progress</h6>
            <div class="display-6 fw-bold mb-0">72%</div>
            <div class="progress my-2" style="height:8px;">
              <div class="progress-bar bg-primary" style="width: 72%"></div>
            </div>
            <small class="text-muted">Course completion</small>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card text-center p-3 shadow-sm h-100 border-0 hover-shadow">
            <div class="mx-auto mb-2" style="background:#fff3e0; width:48px; height:48px; border-radius:50%; display:flex; align-items:center; justify-content:center;">
              <i class="bi bi-calendar-check text-warning fs-3"></i>
            </div>
            <h6 class="fw-bold mb-1">Upcoming Assignments</h6>
            <div class="display-6 fw-bold mb-0">3</div>
            <small class="text-muted">Due this week</small>
          </div>
        </div>
      </div>
      
      <!-- Recent Activity Section -->
      <div class="card p-4 shadow-sm border-0">
        <h5 class="fw-bold mb-3"><i class="bi bi-clock-history me-2"></i>Recent Activity</h5>
        <ul class="mb-0 ps-3">
          <li>Completed <strong>JavaScript Basics</strong> quiz</li>
          <li>Submitted assignment for <strong>Web Design 101</strong></li>
          <li>Joined new course: <strong>Advanced CSS</strong></li>
        </ul>
      </div>
  </div>
  
@endsection