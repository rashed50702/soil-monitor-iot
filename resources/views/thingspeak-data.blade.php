<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soil Moisture | IoT</title>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
</head>
<body>

<div class="container-fluid">
    <header data-bs-theme="dark" class="mb-5 text-light">
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <div class="container-fluid justify-content-center">
                <div id="channel">
                    <h3 class="text-center mb-0">{{ $channel['name'] }}</h3>
                    <p class="mb-0 small text-center">{{ $channel['description'] }} (lat: {{ $channel['latitude'] }}, long: {{ $channel['longitude'] }})</p>
                </div>
            </div>
        </nav>
    </header>

    <div class="row justify-content-center mt-5">
        <div class="col-sm-4">
            <div class="card text-white bg-dark mb-3 shadow">
                <div class="card-header text-center">
                    <h4 class="my-0">Soil Monitor Voltage</h4>
                </div>
                <div class="card-body text-center">
                    <h1 class="display-3" id="soil-monitor-voltage">
                        {{ $latestEntry ? ($latestEntry['field1'] ?? 'N/A') . 'V' : 'N/A' }}
                    </h1>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card text-white bg-success mb-3 shadow">
                <div class="card-header text-center">
                    <h4 class="my-0">Office Temperature</h4>
                </div>
                <div class="card-body text-center">
                    <h1 class="display-3" id="office-temperature">
                        {{ $latestEntry ? ($latestEntry['field7'] ?? 'N/A') . '°C' : 'N/A' }}
                    </h1>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card text-white bg-danger mb-3 shadow">
                <div class="card-header text-center">
                    <h4 class="my-0">Office Humidity</h4>
                </div>
                <div class="card-body text-center">
                    <h1 class="display-3" id="office-humidity">
                        {{ $latestEntry ? ($latestEntry['field8'] ?? 'N/A') . '%' : 'N/A' }}
                    </h1>
                </div>
            </div>
        </div>
        <div class="col-sm-12 text-center">
            <p class="badge rounded-pill bg-primary">Record last updated: <span id="last-created">{{ $latestEntry['formatted_created_at'] ?? "N/A" }}</span></p>
        </div>
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script type="text/javascript">
    function formatJavaScriptDateAsiaDhaka(dateString) {
        const date = new Date(dateString);  // Convert ISO date string to Date object

        // Convert UTC date to Asia/Dhaka timezone
        const options = {
            day: '2-digit',
            month: 'short',
            year: 'numeric',
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit',
            hour12: true,
            timeZone: 'Asia/Dhaka'
        };

        // Format the date according to the options
        const formattedDate = date.toLocaleString('en-US', options);
        return formattedDate;
    }

    document.addEventListener('DOMContentLoaded', function() {
        const soilMonitorVoltage = document.getElementById('soil-monitor-voltage');
        const officeTemperature = document.getElementById('office-temperature');
        const officeHumidity = document.getElementById('office-humidity');
        const lastCreated = document.getElementById('last-created');

        function updateUI(entry) {
            soilMonitorVoltage.textContent = entry.field1 !== null ? entry.field1 + 'V' : 'N/A';
            officeTemperature.textContent = entry.field7 !== null ? entry.field7 + '°C' : 'N/A';
            officeHumidity.textContent = entry.field8 !== null ? entry.field8 + '%' : 'N/A';
            lastCreated.textContent = entry.created_at !== null ? formatJavaScriptDateAsiaDhaka(entry.created_at) : 'N/A';
        }

        function fetchDataAndUpdate() {
            const dataUrl = "https://api.thingspeak.com/channels/276330/feeds.json";

            fetch(dataUrl)
                .then(response => response.json())
                .then(data => {
                    if (data.feeds && data.feeds.length > 0) {
                        // Sort feeds by created_at datetime in descending order
                        data.feeds.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));

                        // Get the latest entry
                        const latestEntry = data.feeds[0];
                        updateUI(latestEntry);
                    }
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });
        }

        // Initial fetch and render
        fetchDataAndUpdate();

        // Fetch data every 5 second (adjust as needed)
        setInterval(fetchDataAndUpdate, 5000); // 5 second interval
    });
</script>

</body>
</html>
