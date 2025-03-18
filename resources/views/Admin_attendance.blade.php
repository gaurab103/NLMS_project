<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Management</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Custom Styles */
        .stat-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
            border-radius: 15px;
            margin-bottom: 1rem;
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .progress {
            height: 8px;
            border-radius: 4px;
        }
        .filter-card {
            background: #f8f9fa;
            border-radius: 15px;
        }
        .attendance-table th {
            background: #f1f3f5;
            font-weight: 600;
        }
        .date-range-input {
            background: white;
            cursor: pointer;
        }

        /* Responsive Adjustments */
        main {
            margin-left: 250px;
            transition: margin-left 0.3s ease;
            padding: 20px;
        }

        @media (max-width: 768px) {
            main {
                margin-left: 0;
                padding: 15px;
            }

            .filter-card .col-md-3 {
                margin-bottom: 1rem;
            }

            .stat-card h2 {
                font-size: 1.75rem;
            }

            .attendance-table td, .attendance-table th {
                font-size: 0.875rem;
                padding: 0.75rem;
            }

            .badge {
                font-size: 0.75rem;
            }
        }

        @media (max-width: 576px) {
            .stat-card {
                padding: 1.5rem 1rem;
            }

            .stat-card h5 {
                font-size: 1rem;
            }

            .stat-card i {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation Sidebar -->
    @include('nav_aside')

    <!-- Main Content -->
    <main>
        <div class="container-fluid">
            <!-- Filter Section -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="filter-card p-4 shadow-sm">
                        <form id="filterForm">
                            <div class="row g-3">
                                <div class="col-12 col-md-3">
                                    <input type="text" class="form-control date-range-input" id="daterange" placeholder="Select Date Range" value="{{ request('daterange') }}">
                                </div>
                                <div class="col-12 col-md-3">
                                    <select class="form-select" name="course_id">
                                        <option value="">All Courses</option>
                                        @foreach($courses as $course)
                                            <option value="{{ $course->id }}" {{ request('course_id') == $course->id ? 'selected' : '' }}>
                                                {{ $course->course_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 col-md-3">
                                    <select class="form-select" name="student_id">
                                        <option value="">All Students</option>
                                        @foreach($students as $student)
                                            <option value="{{ $student->id }}" {{ request('student_id') == $student->id ? 'selected' : '' }}>
                                                {{ $student->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 col-md-3 d-grid">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-filter me-2"></i>Filter
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="row mb-4">
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="stat-card bg-primary text-white p-4 shadow">
                        <h5 class="mb-3">Today's Attendance</h5>
                        <div class="d-flex justify-content-between align-items-center">
                            <h2>{{ $stats['today'] }}</h2>
                            <i class="fas fa-calendar-day fa-3x opacity-50"></i>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="stat-card bg-danger text-white p-4 shadow">
                        <h5 class="mb-3">Today's Absences</h5>
                        <div class="d-flex justify-content-between align-items-center">
                            <h2>{{ $stats['absences'] }}</h2>
                            <i class="fas fa-user-slash fa-3x opacity-50"></i>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="stat-card bg-success text-white p-4 shadow">
                        <h5 class="mb-3">Monthly Average</h5>
                        <div class="d-flex justify-content-between align-items-center">
                            <h2>{{ number_format($stats['monthly'] * 100, 1) }}%</h2>
                            <i class="fas fa-chart-line fa-3x opacity-50"></i>
                        </div>
                        <div class="progress mt-2">
                            <div class="progress-bar" role="progressbar" style="width: {{ $stats['monthly'] * 100 }}%"></div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="stat-card bg-info text-white p-4 shadow">
                        <h5 class="mb-3">Class Average</h5>
                        <div class="d-flex justify-content-between align-items-center">
                            <h2>{{ number_format($stats['class_avg'] * 100, 1) }}%</h2>
                            <i class="fas fa-chalkboard-teacher fa-3x opacity-50"></i>
                        </div>
                        <div class="progress mt-2">
                            <div class="progress-bar" role="progressbar" style="width: {{ $stats['class_avg'] * 100 }}%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Attendance Table -->
            <div class="card shadow">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table attendance-table mb-0">
                            <thead>
                                <tr>
                                    <th>Student</th>
                                    <th>Course</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Marked At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($attendance as $record)
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
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $attendance->links() }}
            </div>
        </div>
    </main>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Initialize date range picker
        const datePicker = flatpickr('#daterange', {
            mode: "range",
            dateFormat: "Y-m-d",
            defaultDate: "{{ request('daterange') }}"
        });

        // Handle form submission
        $('#filterForm').on('submit', function(e) {
            e.preventDefault();
            const params = new URLSearchParams($(this).serialize());
            window.location.href = `{{ route('admin.attendance') }}?${params.toString()}`;
        });

        // Mobile sidebar toggle synchronization
        document.getElementById('toggleSidebar').addEventListener('click', function() {
            const main = document.querySelector('main');
            main.style.marginLeft = main.style.marginLeft === '0px' ? '250px' : '0';
        });

        // Responsive table adjustments
        function handleResponsive() {
            if (window.innerWidth < 768) {
                $('.attendance-table').addClass('table-sm');
            } else {
                $('.attendance-table').removeClass('table-sm');
            }
        }

        // Initial call and update on window resize
        handleResponsive();
        window.addEventListener('resize', handleResponsive);
    </script>
</body>
</html>
