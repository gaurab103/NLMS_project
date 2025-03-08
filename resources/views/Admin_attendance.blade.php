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

    <style>
        .main-content {
            margin-left: 250px;
            transition: margin-left 0.3s ease;
        }
        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
            }
        }
        .attendance-badge {
            font-size: 0.9rem;
            padding: 0.5em 0.8em;
        }
    </style>
</head>
<body class="bg-light">
    @include('nav_aside')

    <div class="main-content">
        <div class="container-fluid py-4">
            <!-- Filter Section -->
            <div class="card shadow mb-4">
                <div class="card-body">
                    <form method="GET" class="row g-3 align-items-end">
                        <div class="col-md-3">
                            <label class="form-label">Class</label>
                            <select name="course_id" class="form-select">
                                <option value="">All Classes</option>
                                @foreach($courses as $course)
                                <option value="{{ $course->id }}" {{ request('course_id') == $course->id ? 'selected' : '' }}>
                                    {{ $course->course_name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Student</label>
                            <select name="student_id" class="form-select">
                                <option value="">All Students</option>
                                @foreach($students as $student)
                                <option value="{{ $student->id }}" {{ request('student_id') == $student->id ? 'selected' : '' }}>
                                    {{ $student->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-2">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="">All Statuses</option>
                                <option value="present" {{ request('status') === 'present' ? 'selected' : '' }}>Present</option>
                                <option value="absent" {{ request('status') === 'absent' ? 'selected' : '' }}>Absent</option>
                            </select>
                        </div>

                        <div class="col-md-2">
                            <label class="form-label">Date Range</label>
                            <input type="text" name="daterange" class="form-control daterange"
                                   value="{{ request('daterange') }}">
                        </div>

                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-filter"></i> Apply
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="row mb-4">
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Today's Attendance</h5>
                            <h2 class="card-text">{{ $stats['today'] }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-success text-white mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Present Rate</h5>
                            <h2 class="card-text">{{ number_format($stats['monthly'] * 100, 1) }}%</h2>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-warning text-white mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Class Average</h5>
                            <h2 class="card-text">{{ number_format($stats['class_avg'] * 100, 1) }}%</h2>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-danger text-white mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Total Absences</h5>
                            <h2 class="card-text">{{ $stats['absences'] }}</h2>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Attendance Records -->
            <div class="card shadow">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">Detailed Records</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Student</th>
                                    <th>Class</th>
                                    <th>Status</th>
                                    <th>Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($attendance as $record)
                                <tr>
                                    <td>{{ Carbon\Carbon::parse($record->date)->format('d M Y') }}</td>
                                    <td>{{ optional($record->student)->name ?? 'N/A' }}</td>
                                    <td>{{ optional($record->course)->course_name ?? 'N/A' }}</td>
                                    <td>
                                        <span class="badge attendance-badge bg-{{ $record->status === 'present' ? 'success' : 'danger' }}">
                                            {{ ucfirst($record->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $record->created_at->format('h:i A') }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">No records found</td>
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
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <script>
        // Date Range Picker
        $(document).ready(function() {
            $('input.daterange').daterangepicker({
                opens: 'left',
                autoUpdateInput: false,
                locale: {
                    format: 'YYYY-MM-DD',
                    cancelLabel: 'Clear'
                }
            });

            $('input.daterange').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
            });

            $('input.daterange').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });
        });
    </script>
</body>
</html>
