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
            <tbody id="dataTable">
                <!-- Table rows will be dynamically added here -->
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">
        // Function to format date in 'd M Y h:I:s' format
        function formatDate(dateString) {
            const options = { day: 'numeric', month: 'short', year: 'numeric', hour: '2-digit', minute: '2-digit', second: '2-digit' };
            return new Date(dateString).toLocaleDateString('en-US', options);
        }

        document.addEventListener('DOMContentLoaded', function() {
            const dataTable = document.getElementById('dataTable');

            function fetchDataAndRender() {
                const dataUrl = "{{ asset('js/feeds.json') }}";
                // const dataUrl = "https://api.thingspeak.com/channels/276330/feeds.json?results=10";
                
                fetch(dataUrl)
                    .then(response => response.json())
                    .then(data => {
                        dataTable.innerHTML = ''; // Clear existing data if needed

                        // Check if there are feeds in the data
                        if (data.feeds && data.feeds.length > 0) {
                            data.feeds.forEach(entry => {
                                // Create a new row for each entry
                                let row = dataTable.insertRow();
                                row.innerHTML = `
                                    <td>${entry.entry_id}</td>
                                    <td>${formatDate(entry.created_at)}</td>
                                    <td>${entry.field1 !== null ? entry.field1 : 'N/A'}</td>
                                    <td>${entry.field2 !== null ? entry.field2 : 'N/A'}</td>
                                    <td>${entry.field3 !== null ? entry.field3 : 'N/A'}</td>
                                    <td>${entry.field4 !== null ? entry.field4 : 'N/A'}</td>
                                    <td>${entry.field5 !== null ? entry.field5 : 'N/A'}</td>
                                    <td>${entry.field6 !== null ? entry.field6 : 'N/A'}</td>
                                    <td>${entry.field7 !== null ? entry.field7 : 'N/A'}</td>
                                    <td>${entry.field8 !== null ? entry.field8 : 'N/A'}</td>
                                `;
                            });
                        } else {
                            dataTable.innerHTML = `<tr><td colspan="10">No data available.</td></tr>`;
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching data:', error);
                    });
            }

            // Initial fetch and render
            fetchDataAndRender();

            // Fetch data every 5 seconds (adjust as needed)
            setInterval(fetchDataAndRender, 2000); // 5 seconds interval
        });
    </script>
</body>
</html>
