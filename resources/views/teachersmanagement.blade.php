@include('nav_aside')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <title>Manage Teachers</title>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .content-wrapper {
            margin-left: 260px;
            padding: 20px;
            transition: margin-left 0.3s ease;
        }
        .sidebar.hidden + .content-wrapper {
            margin-left: 0;
        }
        .card {
            transition: transform 0.3s;
        }
        .card:hover {
            transform: scale(1.02);
        }
        .btn-toggle {
            display: none;
        }
        @media (max-width: 768px) {
            .btn-toggle {
                display: block;
            }
            .content-wrapper {
                margin-left: 0;
            }
        }
    </style>
</head>

<body>
    <div class="content-wrapper">
        <button class="btn btn-primary btn-toggle mb-3" id="toggleSidebar">☰ Menu</button>
        <h2 class="mb-4">Teacher Management</h2>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Add Teacher Button -->
        <button class="btn btn-success mb-3" id="toggleAddForm">
            <i class="fas fa-user-plus"></i> Add Teacher
        </button>

        <!-- Add Teacher Form -->
        <div id="addTeacherForm" class="card p-4" style="display: none;">
            <form action="{{ route('teachers.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="teacher_name">Teacher Name</label>
                        <input type="text" name="teacher_name" class="form-control" id="teacher_name" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="subject">Subject</label>
                        <input type="text" name="subject" class="form-control" id="subject" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" id="email" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="phone_number">Phone Number</label>
                        <input type="text" name="phone_number" class="form-control" id="phone_number" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="address">Address</label>
                        <input type="text" name="address" class="form-control" id="address" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Save Teacher</button>
            </form>
        </div>

        <!-- Teachers Table -->
        <table class="table table-striped table-responsive mt-4">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Subject</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($teachers as $teacher)
                    <tr>
                        <td>{{ $teacher->id }}</td>
                        <td>{{ $teacher->Teacher_Name }}</td>
                        <td>{{ $teacher->Subject }}</td>
                        <td>{{ $teacher->Email }}</td>
                        <td>{{ $teacher->Phone_Number }}</td>
                        <td>{{ $teacher->Address }}</td>
                        <td>
                            <!-- Edit Button -->
                            <button class="btn btn-warning btn-sm edit-button" data-id="{{ $teacher->id }}" data-name="{{ $teacher->Teacher_Name }}" data-subject="{{ $teacher->Subject }}" data-email="{{ $teacher->Email }}" data-phone="{{ $teacher->Phone_Number }}" data-address="{{ $teacher->Address }}">
                                <i class="fas fa-edit"></i>
                            </button>

                            <!-- Delete Form -->
                            <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function () {
            // Toggle Add Teacher Form
            $('#toggleAddForm').click(function () {
                $('#addTeacherForm').toggle(300);
                let btnText = $('#toggleAddForm').text().trim();
                $('#toggleAddForm').html(btnText === 'Add Teacher' ? '<i class="fas fa-times"></i> Hide Form' : '<i class="fas fa-user-plus"></i> Add Teacher');
            });

            // Toggle Sidebar
            $('#toggleSidebar').click(function () {
                $('#sidebar').toggleClass('hidden');
                $('.content-wrapper').toggleClass('sidebar-hidden');
            });

            // Edit Button Click Handler
            $('.edit-button').click(function () {
                let id = $(this).data('id');
                let name = $(this).data('name');
                let subject = $(this).data('subject');
                let email = $(this).data('email');
                let phone = $(this).data('phone');
                let address = $(this).data('address');

                let editForm = `
                    <div class="card p-4">
                        <form action="/teachers/${id}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label>Teacher Name</label>
                                    <input type="text" name="teacher_name" class="form-control" value="${name}" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label>Subject</label>
                                    <input type="text" name="subject" class="form-control" value="${subject}" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" value="${email}" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label>Phone</label>
                                    <input type="text" name="phone_number" class="form-control" value="${phone}" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label>Address</label>
                                    <input type="text" name="address" class="form-control" value="${address}" required>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Teacher</button>
                        </form>
                    </div>`;

                $('#addTeacherForm').html(editForm).show();
            });
        });
    </script>
</body>
</html>
