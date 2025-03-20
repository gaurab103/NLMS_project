@include('nav_aside')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <style>
        .content-wrapper {
            margin-left: 260px;
            width: calc(100% - 260px);
            padding: 25px;
        }
        .card-shadow {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }
        .table-hover tbody tr:hover {
            background-color: rgba(64, 147, 231, 0.05);
        }
        .student-photo {
            width: 50px;
            height: 50px;
            object-fit: cover;
        }
        .modal-header {
            background: #4093e7;
            color: white;
            border-radius: 0.3rem 0.3rem 0 0;
        }
        .filter-container {
            display: flex;
            gap: 10px;
            align-items: center;
            flex-wrap: wrap;
        }
        .form-select {
            min-width: 200px;
        }
        .pagination {
            margin-bottom: 0;
        }
        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .content-wrapper {
                margin-left: 0;
                width: 100%;
                padding: 10px;
            }
            .filter-container {
                flex-direction: column;
                align-items: flex-start;
            }
            .form-select, .input-group {
                width: 100%;
            }
            .table-responsive {
                overflow-x: auto;
            }
            .modal-dialog {
                margin: 0;
                width: 100%;
                max-width: 100%;
            }
        }
        @media (max-width: 576px) {
            .modal-body .row {
                --bs-gutter-x: 1.5rem;
            }
            .modal-body .col-md-6 {
                margin-bottom: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="card card-shadow">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h3 class="mb-0"><i class="fas fa-user-graduate me-2"></i>NLMS Student Management</h3>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
                        <button class="btn btn-success mb-2 mb-md-0" data-bs-toggle="modal" data-bs-target="#addStudentModal">
                            <i class="fas fa-user-plus me-2"></i>Add Student
                        </button>
                        <div class="d-flex align-items-center gap-3">
                            <div class="filter-container">
                                <form method="GET" class="mb-2 mb-md-0">
                                    <div class="input-group">
                                        <input type="text" name="search" class="form-control" placeholder="Search by name..." value="{{ request('search') }}">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </form>
                                <form method="GET" class="ms-2">
                                    <select name="course_id" class="form-select" onchange="this.form.submit()">
                                        <option value="">All Classes</option>
                                        @foreach($courses as $course)
                                            <option value="{{ $course->id }}" {{ request('course_id') == $course->id ? 'selected' : '' }}>
                                                {{ $course->course_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive rounded-3">
                        <table class="table table-hover table-striped align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th>S.N</th>
                                    <th>Photo</th>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Password</th>
                                    <th>Address</th>
                                    <th>Email</th>
                                    <th>Contact No</th>
                                    <th>Class</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($students as $student)
                                    <tr>
                                        <td>{{ ($students->currentPage() - 1) * $students->perPage() + $loop->iteration }}</td>
                                        <td>
                                            <img src="{{ $student->photo_url }}" class="student-photo rounded-circle border" alt="{{ $student->name }}">
                                        </td>
                                        <td>{{ $student->name }}</td>
                                        <td>{{ $student->Username }}</td>
                                        <td>{{ $student->Password }}</td>
                                        <td>{{ $student->Address }}</td>
                                        <td>{{ $student->Email }}</td>
                                        <td>{{ $student->Contact_No }}</td>
                                        <td>{{ $student->course->course_name}}</td>
                                        <td>
                                            <span class="badge bg-{{ $student->Stats === 'Active' ? 'success' : 'danger' }}">
                                                {{ $student->Stats }}
                                            </span>
                                        </td>
                                        <td>
                                            <button class="btn btn-warning btn-sm edit-button"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editStudentModal"
                                                data-id="{{ $student->id }}"
                                                data-name="{{ $student->name }}"
                                                data-username="{{ $student->Username }}"
                                                data-password="{{ $student->Password }}"
                                                data-dob="{{ $student->dob->format('Y-m-d') }}"
                                                data-parent_name="{{ $student->Parent_Name }}"
                                                data-contact_no="{{ $student->Contact_No }}"
                                                data-email="{{ $student->Email }}"
                                                data-course_id="{{ $student->C_ID }}"
                                                data-address="{{ $student->Address }}"
                                                data-stats="{{ $student->Stats }}"
                                                data-photo="{{ $student->photo }}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="11" class="text-center py-4">No students found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        @if($students->hasPages())
                            <div class="mt-3 d-flex justify-content-between align-items-center">
                                <div class="text-muted small">
                                    Showing {{ $students->firstItem() }} to {{ $students->lastItem() }} of {{ $students->total() }} entries
                                </div>
                                <nav>
                                    {{ $students->appends(request()->query())->links('pagination::bootstrap-5') }}
                                </nav>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Student Modal -->
    <div class="modal fade" id="addStudentModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title"><i class="fas fa-user-plus me-2"></i>Add Student</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form method="POST" action="{{ route('students.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Full Name</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Username</label>
                                <input type="text" name="username" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Password</label>
                                <input type="text" name="password" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Date of Birth</label>
                                <input type="date" name="dob" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Parent Name</label>
                                <input type="text" name="parent_name" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Contact Number</label>
                                <input type="text" name="contact_no" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Course</label>
                                <select name="course_id" class="form-select" required>
                                    <option value="">Select Course</option>
                                    @foreach($courses as $course)
                                        <option value="{{ $course->id }}">{{ $course->course_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Address</label>
                                <input type="text" name="address" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Status</label>
                                <select name="stats" class="form-select" required>
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Photo</label>
                                <input type="file" name="photo" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Student</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Student Modal -->
    <div class="modal fade" id="editStudentModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title"><i class="fas fa-edit me-2"></i>Edit Student</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form id="editStudentForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Full Name</label>
                                <input type="text" name="name" id="edit_name" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Username</label>
                                <input type="text" name="username" id="edit_username" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Password</label>
                                <input type="text" name="password" id="edit_password" class="form-control">
                                <small class="text-muted">Leave blank to keep current password</small>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Date of Birth</label>
                                <input type="date" name="dob" id="edit_dob" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Parent Name</label>
                                <input type="text" name="parent_name" id="edit_parent_name" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Contact Number</label>
                                <input type="text" name="contact_no" id="edit_contact_no" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" id="edit_email" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Course</label>
                                <select name="course_id" id="edit_course_id" class="form-select" required>
                                    <option value="">Select Course</option>
                                    @foreach($courses as $course)
                                        <option value="{{ $course->id }}">{{ $course->course_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Address</label>
                                <input type="text" name="address" id="edit_address" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Status</label>
                                <select name="stats" id="edit_stats" class="form-select" required>
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Photo</label>
                                <input type="file" name="photo" id="edit_photo" class="form-control">
                                <div class="mt-2">
                                    <img id="currentPhotoPreview" src="" class="img-thumbnail" style="max-width: 200px;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update Student</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editButtons = document.querySelectorAll('.edit-button');
            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const studentId = this.dataset.id;
                    const updateUrl = `{{ route('students.update', ':id') }}`.replace(':id', studentId);
                    document.getElementById('editStudentForm').action = updateUrl;

                    document.getElementById('edit_name').value = this.dataset.name;
                    document.getElementById('edit_username').value = this.dataset.username;
                    document.getElementById('edit_password').value = this.dataset.password;
                    document.getElementById('edit_dob').value = this.dataset.dob;
                    document.getElementById('edit_parent_name').value = this.dataset.parent_name;
                    document.getElementById('edit_contact_no').value = this.dataset.contact_no;
                    document.getElementById('edit_email').value = this.dataset.email;
                    document.getElementById('edit_course_id').value = this.dataset.course_id;
                    document.getElementById('edit_address').value = this.dataset.address;
                    document.getElementById('edit_stats').value = this.dataset.stats;

                    const photoPreview = document.getElementById('currentPhotoPreview');
                    photoPreview.src = this.dataset.photo
                        ? `/storage/${this.dataset.photo}`
                        : '/images/default-user.png';

                    document.getElementById('edit_photo').value = '';
                });
            });

            document.getElementById('edit_photo').addEventListener('change', function(e) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    document.getElementById('currentPhotoPreview').src = event.target.result;
                }
                if (e.target.files && e.target.files[0]) {
                    reader.readAsDataURL(e.target.files[0]);
                }
            });
        });
    </script>
</body>
</html>
