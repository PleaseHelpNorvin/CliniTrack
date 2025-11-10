@extends('layouts.admin_layout')

@section('title', 'Admin Dashboard')
@section('page-title', 'Admin Dashboard')

@section('content')
<div class="container">
    <!-- Summary Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-center bg-primary text-white">
                <div class="card-body">
                    <h5>Total Students</h5>
                    <h3>120</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center bg-success text-white">
                <div class="card-body">
                    <h5>Total Visits Today</h5>
                    <h3>15</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center bg-warning text-dark">
                <div class="card-body">
                    <h5>Active Nurses / Staff</h5>
                    <h3>8</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center bg-info text-white">
                <div class="card-body">
                    <h5>Common Illnesses</h5>
                    <h3>Flu</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Visits Table -->
    <div class="card mb-4">
        <div class="card-header">Recent Visits</div>
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Student</th>
                        <th>Date & Time</th>
                        <th>Reason</th>
                        <th>Nurse</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Juan Dela Cruz</td>
                        <td>Nov 10, 2025 10:30 AM</td>
                        <td>Fever</td>
                        <td>Nurse Maria</td>
                        <td>Treated</td>
                    </tr>
                    <tr>
                        <td>Anna Santos</td>
                        <td>Nov 10, 2025 11:00 AM</td>
                        <td>Injury</td>
                        <td>Nurse Jose</td>
                        <td>Referred</td>
                    </tr>
                    <tr>
                        <td>Mark Reyes</td>
                        <td>Nov 10, 2025 11:30 AM</td>
                        <td>Checkup</td>
                        <td>Nurse Maria</td>
                        <td>Sent Home</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Recent Activity Logs -->
    <div class="card">
        <div class="card-header">Recent Activity Logs</div>
        <div class="card-body">
            <ul class="list-group">
                <li class="list-group-item">Nurse Maria added a new visit for Juan Dela Cruz</li>
                <li class="list-group-item">Admin John created a new user account: Nurse Jose</li>
                <li class="list-group-item">Nurse Jose updated visit status: Anna Santos</li>
                <li class="list-group-item">Admin John exported monthly report</li>
                <li class="list-group-item">Nurse Maria added notes for Mark Reyes</li>
            </ul>
        </div>
    </div>
</div>
@endsection
