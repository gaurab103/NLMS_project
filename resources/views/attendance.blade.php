<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
        <h2>Attendance Records</h2>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Student ID</th>
                    <th>Attendance ID</th>
                    <th>Teacher ID</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                </tr>
            </thead>
            <tbody id="attendanceTableBody">
            </tbody>
        </table>

        <p id="noRecordsMessage" style="display: none;">No attendance records found.</p>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch('/student/attendance/fetch')
                .then(response => response.json())
                .then(data => {
                    const tableBody = document.getElementById('attendanceTableBody');
                    const noRecordsMessage = document.getElementById('noRecordsMessage');

                    tableBody.innerHTML = '';

                    if (data.success && data.data.length > 0) {
                        data.data.forEach(record => {
                            const row = `
                                <tr>
                                    <td>${record.id}</td>
                                    <td>${record.name}</td>
                                    <td>${record.Std_ID}</td>
                                    <td>${record.A_ID}</td>
                                    <td>${record.T_ID}</td>
                                    <td>${record.status}</td>
                                    <td>${record.created_at}</td>
                                    <td>${record.updated_at}</td>
                                </tr>
                            `;
                            tableBody.innerHTML += row;
                        });

                        noRecordsMessage.style.display = 'none';
                    } else {
                        noRecordsMessage.style.display = 'block';
                    }
                })
                .catch(error => {
                    alert('Error fetching attendance data.');
                });
        });
    </script>
</body>

</html>
