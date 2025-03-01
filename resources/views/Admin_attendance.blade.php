<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Attendance Dashboard</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Date Range Picker CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Moment.js -->
    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

    <!-- Date Range Picker -->
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow">
            <!-- Card Header -->
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">Attendance Management System</h3>
            </div>

            <!-- Card Body -->
            <div class="card-body">
                <!-- Filter Form -->
                <form method="GET" class="mb-4">
                    <div class="row g-3 mb-4">
                        <!-- Class Filter -->
                        <div class="col-md-3">
                            <select name="course_id" class="form-select">
                                <option value="">All Classes</option>
                                @foreach($courses as $course)
                                <option value="{{ $course->id }}"
                                    {{ request('course_id') == $course->id ? 'selected' : '' }}>
                                    {{ $course->course_name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Student Filter -->
                        <div class="col-md-3">
                            <select name="student_id" class="form-select">
                                <option value="">All Students</option>
                                @foreach($students as $student)
                                <option value="{{ $student->id }}"
                                    {{ request('student_id') == $student->id ? 'selected' : '' }}>
                                    {{ $student->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Date Filter -->
                        <div class="col-md-3">
                            <input type="date" name="date" class="form-control"
                                   value="{{ request('date') }}">
                        </div>

                        <!-- Date Range Filter -->
                        <div class="col-md-3">
                            <input type="text" name="daterange" class="form-control daterange"
                                   value="{{ request('daterange') }}">
                        </div>

                        <!-- Submit Button -->
                        <div class="col-md-12 mt-3">
                            <button type="submit" class="btn btn-primary w-100">
                                Apply Filters
                            </button>
                        </div>
                    </div>
                </form>

                <!-- Statistics Cards -->
                <div class="row mb-4">
                    <!-- Today's Attendance -->
                    <div class="col-md-4">
                        <div class="card text-white bg-success h-100">
                            <div class="card-body">
                                <h5 class="card-title">Today's Attendance</h5>
                                <h2 class="card-text">{{ number_format($stats['today']) }}</h2>
                            </div>
                        </div>
                    </div>

                    <!-- Weekly Average -->
                    <div class="col-md-4">
                        <div class="card text-white bg-info h-100">
                            <div class="card-body">
                                <h5 class="card-title">7-Day Average</h5>
                                <h2 class="card-text">
                                    {{ number_format($stats['weekly'] * 100, 1) }}%
                                </h2>
                            </div>
                        </div>
                    </div>

                    <!-- Monthly Average -->
                    <div class="col-md-4">
                        <div class="card text-white bg-warning h-100">
                            <div class="card-body">
                                <h5 class="card-title">30-Day Average</h5>
                                <h2 class="card-text">
                                    {{ number_format($stats['monthly'] * 100, 1) }}%
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Attendance Records Table -->
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>Date</th>
                                <th>Student Name</th>
                                <th>Class</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($attendance as $record)
                            <tr>
                                <!-- Formatted Date -->
                                <td>{{ $record->date->format('d M Y') }}</td>

                                <!-- Student Name with Fallback -->
                                <td>{{ $record->date ? $record->date->format('d M Y') : 'N/A' }}</td>

                                <!-- Class Name with Fallback -->
                                <td>{{ optional($record->course)->course_name ?? 'N/A' }}</td>

                                <!-- Status Badge -->
                                <td>
                                    <span class="badge rounded-pill bg-{{ $record->status === 'present' ? 'success' : 'danger' }}">
                                        {{ ucfirst($record->status) }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center">No attendance records found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $attendance->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Date Range Picker Script -->
    <script>
    $(document).ready(function() {
        // Initialize date range picker
        $('input.daterange').daterangepicker({
            opens: 'left',
            autoUpdateInput: false,
            locale: {
                format: 'YYYY-MM-DD',
                cancelLabel: 'Clear'
            },
            startDate: moment().subtract(29, 'days'),
            endDate: moment()
        });

        // Handle date range selection
        $('input.daterange').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
        });

        // Handle date range clear
        $('input.daterange').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });
    });
    </script>
</body>
</html>
