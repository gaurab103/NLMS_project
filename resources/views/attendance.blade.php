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

        @if (isset($error))
            <div class="alert alert-warning">
                {{ $error }}
            </div>
        @endif

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Student Name</th>
                    <th>Student ID</th>
                    <th>Course Name</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($attendance as $record)
                    <tr>
                        <td>{{ $record->id }}</td>
                        <td>{{ $record->student->name }}</td>
                        <td>{{ $record->student_id }}</td>
                        <td>{{ $record->course->name }}</td>
                        <td>{{ $record->date }}</td>
                        <td>{{ $record->status }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">No attendance records found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>

</html>
