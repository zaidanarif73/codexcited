@extends('teacher.layouts.master')
@section('title', "Detail Siswa ~ CODEXCITED teacher")
@section('title_breadcumb', "Detail Siswa")
@section('breadcumb','Users')
@section('breadcumb_child', 'Show')

@section('content')
<div class="container-fluid">
    <div class="card mb-4">
        <div class="card-body d-flex flex-column flex-md-row align-items-center gap-3">
            <!-- Avatar -->
            <img 
                src="{{ $student->avatar ? asset('storage/'.$student->avatar) : 'https://i.pinimg.com/736x/15/04/61/150461327bd8b04d7e55d64665196d64.jpg' }}" 
                class="rounded-circle border"
                style="width: 80px; height: 80px; object-fit: cover; border: 2px solid #ddd;">

            <!-- Info -->
            <div class="flex-grow-1 text-center text-md-start">
                <h5 class="mb-1">{{ $student->name }}</h5>
                <p class="mb-1 text-muted">{{ $student->email }}</p>
                <small class="text-muted">Bergabung: {{ $student->created_at->format('d M Y H:i') }}</small>
            </div>

            <!-- ID & Skor -->
            <div class="text-center text-md-end">
                <span class="badge bg-primary mb-1 d-inline-block">ID: {{ $student->id }}</span>
                <br>
                <span class="badge bg-success d-inline-block" style="font-size: 1rem; padding: 0.4rem 0.75rem;">
                    Skor: {{ $totalScore }}
                </span>
            </div>
        </div>
    </div>

    <div class="card p-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="mb-0">Grafik Skor</h6>
            <select id="chartFilter" class="form-select form-select-sm" style="width: 150px;">
                <option value="minute">Per Menit</option>
                <option value="hour">Per Jam</option>
                <option value="daily">Per Hari</option>
                <option value="weekly">Per Minggu</option>
                <option value="monthly">Per Bulan</option>
            </select>
        </div>
        <div style="position: relative; height:300px; width:100%;">
            <canvas id="scoreChart"></canvas>
        </div>
    </div>


    <div class="card mt-4 p-3">
        <h6 class="mb-3">Riwayat Skor</h6>
        <div class="table-responsive">
            <table class="table table-striped table-bordered mb-0">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Waktu</th>
                        <th>Skor</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($scoreHistory as $index => $score)
                        <tr>
                            <td>{{ $scoreHistory->firstItem() + $index }}</td>
                            <td>{{ $score->created_at->format('d M Y H:i') }}</td>
                            <td class="text-success">+{{ $score->score }}</td>
                            <td>{{ $score->source ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-2">
                {{ $scoreHistory->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const minuteData = {
        labels: {!! json_encode($scoresPerMinute->pluck('minute')) !!},
        datasets: [{
            label: 'Total Skor',
            data: {!! json_encode($scoresPerMinute->pluck('total_score')) !!},
            borderColor: '#ffc107',
            backgroundColor: 'rgba(255,193,7,0.2)',
            fill: true,
            tension: 0.3
        }]
    };

    const hourData = {
        labels: {!! json_encode($scoresPerHour->pluck('hour')) !!},
        datasets: [{
            label: 'Total Skor',
            data: {!! json_encode($scoresPerHour->pluck('total_score')) !!},
            borderColor: '#17a2b8',
            backgroundColor: 'rgba(23,162,184,0.2)',
            fill: true,
            tension: 0.3
        }]
    };

    const dailyData = {
        labels: {!! json_encode($scoresPerDay->pluck('date')) !!},
        datasets: [{
            label: 'Total Skor',
            data: {!! json_encode($scoresPerDay->pluck('total_score')) !!},
            borderColor: '#007bff',
            backgroundColor: 'rgba(0,123,255,0.2)',
            fill: true,
            tension: 0.3
        }]
    };

    const weeklyData = {
        labels: {!! json_encode($scoresPerWeek->pluck('week')) !!},
        datasets: [{
            label: 'Total Skor',
            data: {!! json_encode($scoresPerWeek->pluck('total_score')) !!},
            borderColor: '#6f42c1',
            backgroundColor: 'rgba(111,66,193,0.2)',
            fill: true,
            tension: 0.3
        }]
    };

    const monthlyData = {
        labels: {!! json_encode($scoresPerMonth->pluck('month')) !!},
        datasets: [{
            label: 'Total Skor',
            data: {!! json_encode($scoresPerMonth->pluck('total_score')) !!},
            borderColor: '#28a745',
            backgroundColor: 'rgba(40,167,69,0.2)',
            fill: true,
            tension: 0.3
        }]
    };

    const ctx = document.getElementById('scoreChart').getContext('2d');
    let chart = new Chart(ctx, {
        type: 'line',
        data: minuteData,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top'
                }
            }
        }
    });

    document.getElementById('chartFilter').addEventListener('change', function(){
        if (this.value === 'minute') chart.data = minuteData;
        else if (this.value === 'hour') chart.data = hourData;
        else if (this.value === 'daily') chart.data = dailyData;
        else if (this.value === 'weekly') chart.data = weeklyData;
        else chart.data = monthlyData;
        chart.update();
    });
</script>
@endsection