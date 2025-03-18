<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Attendance</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Navigation Styles */
        body {
            margin-left: 250px;
            background-color: #f8f9fa;
            overflow-y: auto;
        }

        .section {
            height: 100vh;
            width: 250px;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            padding-top: 86px;
            background-color: whitesmoke;
        }
        .section a {
            padding: 15px;
            font-size: 18px;
            color: #333;
            display: block;
            text-decoration: none;
            text-align: center;
        }
        .section a:hover {
            color: white;
            background-color: #007bff;
            border-radius: 5px;
        }
        .mobile-menu-btn, .back-btn {
            display: none;
            margin: 15px;
            background-color: #5e5d5d;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
        }

        .attendance-card {
            margin: 3rem 20%;
            padding-bottom:15%;
            box-shadow: 0 0.5rem 1rem rgba(0,0,0,.15);
            border-radius: 15px;
        }
        .card-header {
            background-color: #007bff;
            color: white;
            border-radius: 15px 15px 0 0 !important;
        }
        .status-select {
            min-width: 120px;
            transition: all 0.3s ease;
        }
        .loading-overlay {
            background: rgba(255, 255, 255, 0.9);
            z-index: 9999;
        }
        .spinner {
            width: 3rem;
            height: 3rem;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            body {
                margin-left: 0;
            }
            .section {
                display: none;
            }
            .mobile-menu-btn {
                display: block;
                margin-left: 3px;
            }
            .navbar .navbar-brand {
                font-size: 15px;
                margin-right: 25px;
            }
            .attendance-card {
                margin: 1rem;
            }
        }
        @media (min-width: 769px) {
            .mobile-menu-btn, .back-btn {
                display: none;
            }
        }
    </style>
</head>
<body>
    @include('navteacher', ['active' => 'attendance'])

    <div class="attendance-card">
        <div class="card shadow">
            <div class="card-header">
                <h3 class="mb-0 text-center"><i class="fas fa-clipboard-list me-2"></i>Mark Attendance</h3>
            </div>
            <div class="card-body">
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

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form id="attendanceForm" method="POST" action="{{ route('teacher.attendance.store') }}">
                    @csrf
                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label class="form-label fw-bold"><i class="fas fa-calendar-day me-2"></i>Date</label>
                            <input type="date" name="date" class="form-control"
                                   value="{{ old('date', now()->format('Y-m-d')) }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold"><i class="fas fa-users me-2"></i>Class</label>
                            <select name="course_id" class="form-select" required>
                                <option value="">Select Class</option>
                                @foreach ($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 d-flex align-items-end">
                            <button type="button" class="btn btn-primary w-100" onclick="loadStudents()">
                                <i class="fas fa-users me-2"></i>Load Students
                            </button>
                        </div>
                    </div>

                    <div id="studentsList" class="d-none">
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            Displaying attendance for:
                            <strong><span id="selectedCourse"></span></strong> on
                            <strong><span id="selectedDate"></span></strong>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover align-middle">
                                <thead class="table-primary">
                                    <tr>
                                        <th scope="col">Student ID</th>
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Attendance Functions
        function loadStudents() {
            const courseId = $('[name="course_id"]').val();
            const date = $('[name="date"]').val();
            const courseName = $('[name="course_id"] option:selected').text();

            if (!date) {
                alert('Please select a date');
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
                                <tr>
                                    <td>${student.id}</td> <!-- Display student ID -->
                                    <td>${student.name}</td>
                                    <td>
                                        <input type="hidden"
                                               name="students[${student.id}][student_id]"
                                               value="${student.id}">
                                        <select name="students[${student.id}][status]"
                                                class="form-select">
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

                    $('#selectedCourse').text(courseName);
                    $('#selectedDate').text(new Date(date).toLocaleDateString());
                    $('#studentsList').removeClass('d-none');
                },
                error: function(xhr) {
                    console.error('Error:', xhr.responseText);
                    alert('Error loading students. Please try again.');
                },
                complete: function() {
                    $('.loading-overlay').hide();
                }
            });
        }
    </script>
</body>
</html>
