<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soil Moisture | IoT</title>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            padding: 20px;
        }
        table tbody tr td {
            vertical-align: middle;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="my-4">Soil Monitor</h1>
        @if (!empty($data))
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Entry ID</th>
                        <th>Created At</th>
                        <th>Soil Monitor Voltage</th>
                        <th>Device Time</th>
                        <th>Wet Value</th>
                        <th>Manual Water Record</th>
                        <th>Dry Value</th>
                        <th>Email Flag</th>
                        <th>Office Temperature</th>
                        <th>Office Humidity</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $feed)
                        <tr>
                            <td>{{ $feed['entry_id'] }}</td>
                            <td>{{ \Carbon\Carbon::parse($feed['created_at'])->format('d M Y h:i:s a') }}</td>
                            <td>{{ $feed['field1'] }}</td>
                            <td>{{ $feed['field2'] }}</td>
                            <td>{{ $feed['field3'] }}</td>
                            <td>{{ $feed['field4'] }}</td>
                            <td>{{ $feed['field5'] }}</td>
                            <td>{{ $feed['field6'] }}</td>
                            <td>{{ $feed['field7'] }}</td>
                            <td>{{ $feed['field8'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No data available.</p>
        @endif
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
