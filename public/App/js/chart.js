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
