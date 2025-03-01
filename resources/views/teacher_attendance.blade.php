<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Attendance</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .attendance-table {
            margin-top: 20px;
        }

        .table thead th {
            background-color: #007bff;
            color: white;
        }

        .status-select {
            min-width: 120px;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">Mark Attendance</h3>
            </div>
            <div class="card-body">
                <form id="attendanceForm" method="POST" action="{{ route('teacher.attendance') }}">
                    @csrf
                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label class="form-label">Date</label>
                            <input type="date" name="date" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Class</label>
                            <select name="course_id" class="form-select" required>
                                @foreach ($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 d-flex align-items-end">
                            <button type="button" class="btn btn-primary w-100" onclick="loadStudents()">
                                Load Students
                            </button>
                        </div>
                    </div>

                    <div id="studentsList" class="d-none">
                        <div class="alert alert-info">
                            Showing attendance for:
                            <strong><span id="selectedCourse"></span></strong> on
                            <strong><span id="selectedDate"></span></strong>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover attendance-table">
                                <thead>
                                    <tr>
                                        <th>Student Name</th>
                                        <th>Attendance Status</th>
                                    </tr>
                                </thead>
                                <tbody id="attendanceRows"></tbody>
                            </table>
                        </div>

                        <div class="mt-4 text-center">
                            <button type="submit" class="btn btn-success btn-lg">
                                Save Attendance
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function loadStudents() {
            const courseId = $('[name="course_id"]').val();
            const date = $('[name="date"]').val();

            if (!date) {
                alert('Please select a date');
                return;
            }

            $.ajax({
                url: `/teacher/attendance/students/${courseId}?date=${date}`,
                method: 'GET',
                success: function(response) {
                    console.log('Received students:', response);

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
                                student.attendances[0].status :
                                'present';

                            const row = `
                                <tr>
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

                    $('#studentsList').removeClass('d-none');
                },
                error: function(xhr) {
                    console.error('Error:', xhr.responseText);
                    alert('Error loading students. Check console for details.');
                }
            });
        }
    </script>
</body>

</html>
