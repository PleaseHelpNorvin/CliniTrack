@extends('layouts.nurse_layout')

@section('title', 'Clinic Reports')
@section('page-title', 'Clinic Reports')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">

        {{-- ✅ Summary Cards --}}
        <div class="row g-3">
            <div class="col-md-3">
                <div class="card p-3 text-center shadow-sm">
                    <h6>Total Visits Today</h6>
                    <h3>12</h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card p-3 text-center shadow-sm">
                    <h6>Emergency Visits</h6>
                    <h3>2</h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card p-3 text-center shadow-sm">
                    <h6>Pending Referrals</h6>
                    <h3>1</h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card p-3 text-center shadow-sm">
                    <h6>Completed Visits</h6>
                    <h3>9</h3>
                </div>
            </div>
        </div>

        {{-- ✅ Charts --}}
        <div class="row mt-4">
            <div class="col-md-6">
                <h5 class="fw-bold">Visits Trend (Past 5 Days)</h5>
                <canvas id="visitsChart"
                    data-labels='["Nov 1", "Nov 2", "Nov 3", "Nov 4", "Nov 5"]'
                    data-counts='[2, 5, 3, 6, 12]'></canvas>
            </div>
            <div class="col-md-6">
                <h5 class="fw-bold">Most Common Reasons</h5>
                <canvas id="reasonsChart"
                    data-labels='["Fever", "Headache", "Cold", "Injury"]'
                    data-counts='[5, 3, 2, 2]'></canvas>
            </div>
        </div>

        {{-- ✅ Recent Visits Table --}}
        <div class="row mt-4">
            <div class="col-12">
                <h5 class="fw-bold">Recent Visits</h5>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="table-light">
                            <tr>
                                <th>Date</th>
                                <th>Student</th>
                                <th>Reason</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Nov 5, 2025 09:30 AM</td>
                                <td>Juan Dela Cruz</td>
                                <td>Fever</td>
                                <td>Treated</td>
                            </tr>
                            <tr>
                                <td>Nov 5, 2025 10:15 AM</td>
                                <td>Maria Santos</td>
                                <td>Headache</td>
                                <td>Referred</td>
                            </tr>
                            <tr>
                                <td>Nov 5, 2025 11:00 AM</td>
                                <td>Carlos Reyes</td>
                                <td>Cold</td>
                                <td>Sent Home</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Chart.js Script --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    function renderChart(id){
        const ctx = document.getElementById(id);
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: JSON.parse(ctx.dataset.labels),
                datasets: [{
                    label: 'Visits',
                    data: JSON.parse(ctx.dataset.counts),
                    backgroundColor: '#0d6efd'
                }]
            },
            options: { responsive: true, plugins:{legend:{display:false}} }
        });
    }

    renderChart('visitsChart');
    renderChart('reasonsChart');
</script>
@endsection
