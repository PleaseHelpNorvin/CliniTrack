<!DOCTYPE html>
<html>
<head>
    <title>Clinic Report</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border:1px solid #000;
            padding: 5px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h2>Clinic Visits Report</h2>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Student</th>
                <th>Reason</th>
                <th>Nurse</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($visits as $visit)
                <tr>
                    <td>{{ $visit->visited_at->format('M d, Y h:i A') }}</td>
                    <td>{{ $visit->student->first_name }} {{ $visit->student->last_name }}</td>
                    <td>{{ ucfirst($visit->reason) }}</td>
                    <td>{{ $visit->nurse->name }}</td>
                    <td>{{ ucfirst($visit->status) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
