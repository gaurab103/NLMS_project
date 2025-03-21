<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mark Attendance</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            margin-left: 250px;
            background-color: #f8f9fa;
            overflow-y: auto;
        }
        .attendance-card {
            max-width: 800px;
            margin: 2rem auto;
            border-radius: 15px;
            box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15);
        }
        .status-select {
            transition: all 0.3s ease;
            border-width: 2px;
        }
        .status-select.present {
            border-color: #28a745;
            background-color: #e8f5e9;
        }
        .status-select.absent {
            border-color: #dc3545;
            background-color: #fcebec;
        }
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.9);
            z-index: 9999;
            display: none;
        }
        .student-row:hover {
            background-color: #f8f9fa;
        }
        .card-header {
            border-radius: 15px 15px 0 0 !important;
        }
    </style>
</head>
<body>
    <!-- Include the navigation sidebar, setting 'attendance' as the active item -->
    @include('navteacher', ['active' => 'attendance'])

    <!-- Main content area -->
    <div class="content">
        <div class="container py-4">
            <div class="attendance-card card">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0 text-center"><i class="fas fa-clipboard-list me-2"></i>Mark Attendance</h3>
                </div>
                <div class="card-body">
                    <!-- Display validation errors if any -->
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show">
                            <strong>Validation Errors:</strong>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <!-- Display success message if present -->
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <!-- Attendance form -->
                    <form id="attendanceForm" method="POST" action="{{ route('teacher.attendance.store') }}">
                        @csrf
                        <div class="row g-3 mb-4">
                            <div class="col-md-5">
                                <label class="form-label fw-bold"><i class="fas fa-calendar-day me-2"></i>Date</label>
                                <input type="date" name="date" class="form-control"
                                       value="{{ old('date', now()->format('Y-m-d')) }}"
                                       max="{{ now()->format('Y-m-d') }}" required>
                            </div>
                            <div class="col-md-5">
                                <label class="form-label fw-bold"><i class="fas fa-users me-2"></i>Class</label>
                                <select name="course_id" class="form-select" required>
                                    <option value="">Select Class</option>
                                    @foreach ($courses as $course)
                                        <option value="{{ $course->id }}"
                                            {{ old('course_id') == $course->id ? 'selected' : '' }}>
                                            {{ $course->course_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <button type="button" class="btn btn-primary w-100" onclick="loadStudents()">
                                    <i class="fas fa-sync me-2"></i>Load
                                </button>
                            </div>
                        </div>

                        <!-- Students section, hidden until loaded -->
                        <div id="studentsSection" class="d-none">
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle me-2"></i>
                                Showing attendance for:
                                <strong><span id="selectedCourse"></span></strong> on
                                <strong><span id="selectedDate"></span></strong>
                            </div>

                            <div class="mb-3">
                                <button type="button" class="btn btn-success me-2" onclick="markAll('present')">
                                    <i class="fas fa-check me-2"></i>Mark All Present
                                </button>
                                <button type="button" class="btn btn-danger me-2" onclick="markAll('absent')">
                                    <i class="fas fa-times me-2"></i>Mark All Absent
                                </button>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-borderless">
                                    <thead class="bg-light">
                                        <tr>
                                            <th class="w-50">Student Name</th>
                                            <th>Attendance Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="attendanceRows" class="bg-white"></tbody>
                                </table>
                            </div>

                            <div class="mt-4 text-center">
                                <button type="submit" class="btn btn-success btn-lg px-5">
                                    <i class="fas fa-save me-2"></i>Save Attendance
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Loading overlay -->
    <div class="loading-overlay">
        <div class="d-flex justify-content-center align-items-center h-100">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;"></div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function loadStudents() {
            const courseId = $('[name="course_id"]').val();
            const date = $('[name="date"]').val();

            if (!courseId || !date) {
                alert('Please select both date and class');
                return;
            }

            $('.loading-overlay').show();

            $.ajax({
                url: `/teacher/attendance/students/${courseId}?date=${date}`,
                method: 'GET',
                success: function(response) {
                    const tbody = $('#attendanceRows');
                    tbody.empty();

                    if (response.length === 0) {
                        tbody.append(`
                            <tr>
                                <td colspan="2" class="text-center">
                                    No students found in this class
                                </td>
                            </tr>
                        `);
                    } else {
                        response.forEach(student => {
                            const status = student.attendances.length > 0 ?
                                student.attendances[0].status : 'present';

                            const row = `
                                <tr class="student-row">
                                    <td>
                                        <img src="${student.photo || '/default-photo.jpg'}"
                                             alt="${student.name}"
                                             style="width: 50px; height: 50px; border-radius: 50%; margin-right: 10px;">
                                        ${student.name}
                                    </td>
                                    <td>
                                        <input type="hidden"
                                               name="students[${student.id}][student_id]"
                                               value="${student.id}">
                                        <select name="students[${student.id}][status]"
                                                class="form-select status-select">
                                            <option value="present" ${status === 'present' ? 'selected' : ''}>
                                                Present
                                            </option>
                                            <option value="absent" ${status === 'absent' ? 'selected' : ''}>
                                                Absent
                                            </option>
                                        </select>
                                    </td>
                                </tr>
                            `;
                            tbody.append(row);
                        });
                    }

                    $('#selectedCourse').text($('[name="course_id"] option:selected').text());
                    $('#selectedDate').text(new Date(date).toLocaleDateString());
                    $('#studentsSection').removeClass('d-none');
                    addStatusListeners();
                },
                error: function(xhr) {
                    console.error(xhr);
                    alert('Error loading students. Please try again.');
                },
                complete: function() {
                    $('.loading-overlay').hide();
                }
            });
        }

        function markAll(status) {
            $('.status-select').val(status).trigger('change');
        }

        function addStatusListeners() {
            $('.status-select').on('change', function() {
                $(this).removeClass('present absent')
                       .addClass($(this).val());
            }).trigger('change');
        }
    </script>
</body>
</html>
