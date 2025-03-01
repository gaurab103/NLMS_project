@include('nav_aside')
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Add Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .stat-card {
            transition: transform 0.3s ease;
            border: none;
            border-radius: 15px;
        }
        .stat-card:hover {
            transform: translateY(-5px);
        }
        .chart-container {
            background: white;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 30px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="mb-0">Attendance Management System</h3>
                    <div class="search-bar">
                        <input type="text" class="form-control" placeholder="Search by student name..."
                               name="search" value="{{ request('search') }}">
                    </div>
                </div>
            </div>

            <div class="card-body">
                <!-- Enhanced Filter Form -->
                <form method="GET" class="mb-4">
                    <div class="row g-3 mb-4">
                        <div class="col-md-3">
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
                            <input type="date" name="date" class="form-control"
                                   value="{{ request('date') }}">
                        </div>

                        <div class="col-md-3">
                            <select name="status" class="form-select">
                                <option value="">All Statuses</option>
                                <option value="present" {{ request('status') == 'present' ? 'selected' : '' }}>Present</option>
                                <option value="absent" {{ request('status') == 'absent' ? 'selected' : '' }}>Absent</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <input type="text" name="daterange" class="form-control daterange"
                                   value="{{ request('daterange') }}">
                        </div>

                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-filter"></i> Apply Filters
                            </button>
                        </div>
                    </div>
                </form>

                <!-- Enhanced Statistics Cards -->
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="stat-card card text-white bg-success h-100">
                            <div class="card-body">
                                <h5 class="card-title"><i class="fas fa-user-check"></i> Present Today</h5>
                                <h2 class="card-text">{{ $stats['present_today'] }}</h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="stat-card card text-white bg-danger h-100">
                            <div class="card-body">
                                <h5 class="card-title"><i class="fas fa-user-times"></i> Absent Today</h5>
                                <h2 class="card-text">{{ $stats['absent_today'] }}</h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="stat-card card text-white bg-info h-100">
                            <div class="card-body">
                                <h5 class="card-title"><i class="fas fa-chart-line"></i> Weekly Average</h5>
                                <h2 class="card-text">{{ number_format($stats['weekly'] * 100, 1) }}%</h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="stat-card card text-white bg-warning h-100">
                            <div class="card-body">
                                <h5 class="card-title"><i class="fas fa-chart-area"></i> Monthly Average</h5>
                                <h2 class="card-text">{{ number_format($stats['monthly'] * 100, 1) }}%</h2>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Attendance Chart -->
                <div class="chart-container">
                    <canvas id="attendanceChart"></canvas>
                </div>

                <!-- Enhanced Attendance Table -->
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>Date</th>
                                <th>Student</th>
                                <th>Class</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($attendance as $record)
                            <tr>
                                <td>{{ $record->date->format('d M Y') }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ $record->student->photo ?? asset('images/default-avatar.png') }}"
                                             class="rounded-circle me-2" width="40" height="40">
                                        {{ $record->student->name }}
                                    </div>
                                </td>
                                <td>{{ $record->course->course_name }}</td>
                                <td>
                                    <span class="badge rounded-pill bg-{{ $record->status === 'present' ? 'success' : 'danger' }}">
                                        {{ ucfirst($record->status) }}
                                    </span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary"
                                            data-bs-toggle="modal"
                                            data-bs-target="#detailModal"
                                            data-student="{{ $record->student->name }}"
                                            data-date="{{ $record->date->format('d M Y') }}"
                                            data-status="{{ $record->status }}">
                                        <i class="fas fa-info-circle"></i>
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">
                                    <i class="fas fa-database fa-2x mb-3"></i>
                                    <h5>No attendance records found</h5>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination with Summary -->
                <div class="d-flex justify-content-between align-items-center mt-4">
                    <div class="text-muted">
                        Showing {{ $attendance->firstItem() }} - {{ $attendance->lastItem() }} of {{ $attendance->total() }} records
                    </div>
                    {{ $attendance->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Chart Script -->
    <script>
        const ctx = document.getElementById('attendanceChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($chart['labels']) !!},
                datasets: [{
                    label: 'Attendance Trend',
                    data: {!! json_encode($chart['data']) !!},
                    borderColor: '#4e73df',
                    tension: 0.4,
                    fill: false
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: '30-Day Attendance Trend'
                    }
                }
            }
        });
    </script>

    <!-- Detail Modal -->
    <div class="modal fade" id="detailModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Attendance Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <dl class="row">
                        <dt class="col-sm-4">Student Name:</dt>
                        <dd class="col-sm-8" id="detailStudent"></dd>

                        <dt class="col-sm-4">Date:</dt>
                        <dd class="col-sm-8" id="detailDate"></dd>

                        <dt class="col-sm-4">Status:</dt>
                        <dd class="col-sm-8" id="detailStatus"></dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Modal Handling
        const detailModal = document.getElementById('detailModal')
        detailModal.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget
            document.getElementById('detailStudent').textContent = button.dataset.student
            document.getElementById('detailDate').textContent = button.dataset.date
            document.getElementById('detailStatus').textContent = button.dataset.status
        })

        // Date Range Picker initialization
        $('input.daterange').daterangepicker({
            opens: 'left',
            autoUpdateInput: false,
            locale: { format: 'YYYY-MM-DD' },
            ranges: {
                'Today': [moment(), moment()],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()]
            }
        }).on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'))
        })
    </script>
</body>
</html>
