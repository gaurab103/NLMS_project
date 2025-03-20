<!-- AdminAttendance.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f5f5f5;
            margin: 0; /* Remove default body margin */
        }
        .container-fluid {
            margin-top: 20px;
            margin-left: 250px;
            min-height: calc(100vh - 70px);
            width: calc(100% - 250px);
            padding: 15px;
        }
        @media (max-width: 768px) {
            .container-fluid {
                margin-left: 0;
                width: 100%; /* Full width on mobile */
                padding: 10px; /* Adjust padding for mobile */
            }
        }
        .card-stat {
            border-radius: 15px;
            overflow: hidden;
            width: 100%; /* Ensure cards take full width */
        }
        .attendance-table {
            overflow-x: auto;
            width: 100%; /* Ensure table takes full width */
        }
        .badge {
            padding: 1px;
            font-size: 0.9em;
        }
        .row {
            width: 100%; /* Ensure rows take full width */
            margin-left: 0; /* Remove default negative margins */
            margin-right: 0;
        }
        @media (max-width: 768px) {
            .col-md-3 {
                width: 100%; /* Full width columns on mobile */
            }
        }
    </style>
</head>
<body>
    @include('nav_aside')

    <main class="container-fluid">
        <!-- Filter Section -->
        <div class="card mb-4 shadow-sm card-stat">
            <div class="card-body">
                <form method="GET">
                    <div class="row g-3 align-items-end">
                        <div class="col-md-3 col-12">
                            <label class="form-label">Date Range</label>
                            <input type="text" class="form-control" id="daterange" name="daterange"
                                   value="{{ request('daterange') }}" placeholder="Select date range">
                        </div>
                        <div class="col-md-3 col-12">
                            <label class="form-label">Course</label>
                            <select class="form-select" name="course_id">
                                <option value="">All Courses</option>
                                @foreach($courses as $course)
                                    <option value="{{ $course->id }}" {{ request('course_id') == $course->id ? 'selected' : '' }}>
                                        {{ $course->course_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 col-12">
                            <label class="form-label">Student</label>
                            <select class="form-select" name="student_id">
                                <option value="">All Students</option>
                                @foreach($students as $student)
                                    <option value="{{ $student->id }}" {{ request('student_id') == $student->id ? 'selected' : '' }}>
                                        {{ $student->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 col-12 d-grid">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-filter me-2"></i>Apply Filters
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Filter Feedback -->
        @if(!request()->filled('course_id') && !request()->filled('student_id') && !request()->filled('daterange'))
            <div class="alert alert-info mb-4">
                Showing today's attendance records ({{ now()->format('M d, Y') }})
            </div>
        @else
            <div class="alert alert-success mb-4">
                Showing filtered results
                @if(request('daterange'))
                    (Date Range: {{ request('daterange') }})
                @endif
            </div>
        @endif

        <!-- Statistics Cards -->
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-4 mb-4">
            @foreach([
                'total' => ['title' => 'Total Records', 'icon' => 'clipboard-list', 'color' => 'primary'],
                'present' => ['title' => 'Present', 'icon' => 'check-circle', 'color' => 'success'],
                'absent' => ['title' => 'Absent', 'icon' => 'times-circle', 'color' => 'danger'],
                'average' => ['title' => 'Attendance Rate', 'icon' => 'chart-pie', 'color' => 'info'],
                'unique_students' => ['title' => 'Unique Students', 'icon' => 'users', 'color' => 'warning'],
                'unique_courses' => ['title' => 'Unique Courses', 'icon' => 'book', 'color' => 'secondary']
            ] as $key => $config)
                <div class="col">
                    <div class="card text-white bg-{{ $config['color'] }} shadow-sm card-stat">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="card-title">{{ $config['title'] }}</h5>
                                    <h2 class="mb-0">
                                        @if($key === 'average')
                                            {{ number_format($stats[$key] * 100, 1) }}%
                                        @else
                                            {{ $stats[$key] }}
                                        @endif
                                    </h2>
                                </div>
                                <i class="fas fa-{{ $config['icon'] }} fa-2x opacity-50"></i>
                            </div>
                            @if($key === 'average')
                                <div class="progress mt-3" style="height: 5px;">
                                    <div class="progress-bar" style="width: {{ $stats[$key] * 100 }}%"></div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Attendance Table -->
        <div class="card shadow card-stat attendance-table">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Student</th>
                                <th>Course</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Recorded At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($attendance as $record)
                                <tr>
                                    <td>{{ $record->student->name }}</td>
                                    <td>{{ $record->course->course_name }}</td>
                                    <td>{{ $record->date->format('M d, Y') }}</td>
                                    <td>
                                        <span class="badge bg-{{ $record->status === 'present' ? 'success' : 'danger' }}">
                                            {{ ucfirst($record->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $record->created_at->diffForHumans() }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4">No attendance records found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-4 d-flex justify-content-center">
            {{ $attendance->links() }}
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr('#daterange', {
            mode: "range",
            dateFormat: "Y-m-d",
            defaultDate: "{{ request('daterange') }}"
        });

        document.getElementById('toggleSidebar')?.addEventListener('click', () => {
            const sidebar = document.getElementById('sidebar');
            const mainHeader = document.getElementById('mainHeader');
            sidebar.classList.toggle('hidden');
            mainHeader.classList.toggle('collapsed');
            // No need to adjust margin here as CSS handles it
        });
    </script>
</body>
</html>
