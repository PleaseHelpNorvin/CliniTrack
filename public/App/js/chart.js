
    const chartElement = document.getElementById('myChart');
    if(chartElement) {
        const ctx1 = chartElement.getContext('2d');
        const myBarChart = new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 2, 3],
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: { responsive: true }
        });
    }

    const visitChartElement = document.getElementById('visitsChart');
    if(visitChartElement) {
        const labels = JSON.parse(visitChartElement.dataset.labels);
        const counts = JSON.parse(visitChartElement.dataset.counts);

        const ctx2 = visitChartElement.getContext('2d');
        const visitLineChart = new Chart(ctx2, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Visits',
                    data: counts,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 2
                }]
            },
            options: { responsive: true }
        });
    }

    const reasonsChartElement = document.getElementById('reasonsChart');
    if (reasonsChartElement) {
        const labels = JSON.parse(reasonsChartElement.dataset.labels);
        const counts = JSON.parse(reasonsChartElement.dataset.counts);

        const ctx = reasonsChartElement.getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    data: counts,
                    backgroundColor: [
                        '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF'
                    ]
                }]
            },
            options: { responsive: true }
        });
    }

    const nurseReasonsChartElement = document.getElementById('nurseReasonsChart');
    if(nurseReasonsChartElement) {
        const ctxReasons = nurseReasonsChartElement.getContext('2d');
        new Chart(ctxReasons, {
            type: 'bar',
            data: {
                labels: JSON.parse(nurseReasonsChartElement.dataset.labels),
                datasets: [{
                    label: 'Visits',
                    data: JSON.parse(nurseReasonsChartElement.dataset.counts),
                    backgroundColor: '#0d6efd'
                }]
            },
            options: { responsive: true, plugins:{legend:{display:false}} }
        });
    }

    const nurseVisitsChartElement = document.getElementById('nurseVisitsChart');
    if(nurseVisitsChartElement) {
        const ctxVisits = nurseVisitsChartElement.getContext('2d');
        new Chart(ctxVisits, {
            type: 'bar',
            data: {
                labels: JSON.parse(nurseVisitsChartElement.dataset.labels),
                datasets: [{
                    label: 'Visits',
                    data: JSON.parse(nurseVisitsChartElement.dataset.counts),
                    backgroundColor: '#0d6efd'
                }]
            },
            options: { responsive: true, plugins:{legend:{display:false}} }
        });
    }

    const dashboardVisitChart = document.getElementById('dashboardVisitsChart');
    if(dashboardVisitChart){
        const dbVisitCtx = dashboardVisitChart.getContext('2d');
        new Chart(dbVisitCtx, {
            type: 'bar',
            data: {
                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri'],
                datasets: [{
                    label: 'Visits',
                    data: [5, 7, 4, 8, 6],
                    backgroundColor: 'rgba(13, 110, 253, 0.7)',
                    borderRadius: 5
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: { y: { beginAtZero: true, stepSize: 1 } }
            }
        });
    }

    const dashboardSymptomsChart = document.getElementById('dashboardSymptomsChart');
    if(dashboardSymptomsChart) {
        const ctx2 = dashboardSymptomsChart.getContext('2d');
        new Chart(ctx2, {
            type: 'pie',
            data: {
                labels: ['Fever', 'Injury', 'Headache', 'Checkup'],
                datasets: [{
                    data: [4, 2, 3, 1],
                    backgroundColor: [
                        'rgba(220,53,69,0.7)',
                        'rgba(255,193,7,0.7)',
                        'rgba(13,110,253,0.7)',
                        'rgba(108,117,125,0.7)'
                    ]
                }]
            },
            options: { responsive: true, plugins: { legend: { position: 'bottom' } } }
        });
    }



    // ==================== ADMIN DASHBOARD CHARTS ====================
// document.addEventListener('DOMContentLoaded', function() {
    console.log('Dashboard charts initializing...');

    // ==================== Visits Per Month Chart ====================
        const visitsPerMonthEl = document.getElementById('dashboardvisitsPerMonthChart');
        if (visitsPerMonthEl) {
            const ctx = visitsPerMonthEl.getContext('2d');
            const data = JSON.parse(visitsPerMonthEl.dataset.values || '[]');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
                    datasets: [{
                        label: 'Visits',
                        data: data,
                        backgroundColor: 'rgba(13, 110, 253, 0.7)',
                        borderRadius: 5
                    }]
                },
                options: {
                    responsive: true,
                    plugins: { legend: { display: false } },
                    scales: { y: { beginAtZero: true } }
                }
            });
        }


    // ==================== Visit Reasons Chart ====================
    const visitReasonsEl = document.getElementById('visitReasonsChart');
    if (visitReasonsEl) {
        const labels = JSON.parse(visitReasonsEl.dataset.labels || '[]');
        const data = JSON.parse(visitReasonsEl.dataset.values || '[]');
        const ctx = visitReasonsEl.getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    data: data,
                    backgroundColor: ['#0d6efd', '#198754', '#dc3545', '#ffc107', '#6c757d']
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { position: 'bottom' } }
            }
        });
    }



    // ==================== Emergency vs Non-Emergency Chart ====================
        const emergencyEl = document.getElementById('emergencyChart');
        if (emergencyEl) {
            const labels = JSON.parse(emergencyEl.dataset.labels || '[]');
            const data = JSON.parse(emergencyEl.dataset.values || '[]');
            const ctx = emergencyEl.getContext('2d');
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: labels,
                    datasets: [{
                        data: data,
                        backgroundColor: ['#dc3545', '#198754']
                    }]
                },
                options: {
                    responsive: true,
                    plugins: { legend: { position: 'bottom' } }
                }
            });
        }

// });
