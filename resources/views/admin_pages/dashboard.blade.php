@extends('layouts.admin_layout')

@section('title', 'Dashboard')

@section('page-title', 'Dashboard')

@section('content')
<div class="card shadow-sm mb-4">
    <div class="card-body">
    <h1 class="mb-4">Welcome to the School Clinic Dashboard</h1>
    <p>This is your admin dashboard. You can add charts, stats, or quick links here.</p>
    <!-- <canvas id="myChart" width="400" height="200"></canvas> -->
<canvas id="myChart"></canvas>
</div>
</div>
@endsection

<!-- Dashboard
Total Students


Total Visits Today / This Month


Active Nurses / Staff


Common Illnesses (chart)


Recent Visits Table -->
