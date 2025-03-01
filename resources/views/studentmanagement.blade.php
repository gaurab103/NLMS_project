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
        .content-wrapper { margin-left: 260px; padding: 25px; }
        .card-shadow { box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15); }
        .table-hover tbody tr:hover { background-color: rgba(64, 147, 231, 0.05); }
        .avatar-sm { width: 40px; height: 40px; object-fit: cover; }
        .modal-header { background: #4093e7; color: white; border-radius: 0.3rem 0.3rem 0 0; }
        .form-control:focus { border-color: #4093e7; box-shadow: 0 0 0 0.2rem rgba(64, 147, 231, 0.25); }
        .filter-container { display: flex; gap: 10px; align-items: center; flex-wrap: wrap; }
        .form-select { min-width: 200px; }
        .pagination { margin-bottom: 0; }
    </style>
</head>
<body>
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="card card-shadow">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h3 class="mb-0"><i class="fas fa-user-graduate me-2"></i>Student Management</h3>
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
                            <div class="text-muted d-none d-md-block">Showing {{ $students->firstItem() }} - {{ $students->lastItem() }} of {{ $students->total() }}</div>
                            <div class="filter-container">
                                <form method="GET" class="d-flex mb-2 mb-md-0">
                                    <div class="input-group">
                                        <input type="text" name="search" class="form-control"
                                               placeholder="Search students..."
                                               value="{{ request('search') }}">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </form>

                                <form method="GET" class="ms-2">
                                    <select name="course" class="form-select" onchange="this.form.submit()">
                                        <option value="">All Courses</option>
                                        @foreach($courses as $course)
                                            <option value="{{ $course->id }}"
                                                {{ request('course') == $course->id ? 'selected' : '' }}>
                                                {{ $course->course_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive rounded-3">
                        <table class="table table-hover table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Photo</th>
                                    <th>Name</th>
                                    <th>DOB</th>
                                    <th>Course</th>
                                    <th>Parent</th>
                                    <th>Contact</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($students as $student)
                                <tr>
                                    <td>{{ ($students->currentPage() - 1) * $students->perPage() + $loop->iteration }}</td>
                                    <td>
                                        <img src="{{ $student->photo_url }}"
                                             class="avatar-sm rounded-circle border"
                                             alt="{{ $student->name }}">
                                    </td>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->dob->format('d M Y') }}</td>
                                    <td>{{ $student->course->course_name ?? 'N/A' }}</td>
                                    <td>{{ $student->Parent_Name }}</td>
                                    <td>{{ $student->Contact_No }}</td>
                                    <td>
                                        <span class="badge bg-{{ $student->Stats === 'Active' ? 'success' : 'secondary' }}">
                                            {{ $student->Stats }}
                                        </span>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-warning edit-btn"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editStudentModal"
                                                data-id="{{ $student->id }}"
                                                data-name="{{ $student->name }}"
                                                data-dob="{{ $student->dob->format('Y-m-d') }}"
                                                data-parent="{{ $student->Parent_Name }}"
                                                data-address="{{ $student->Address }}"
                                                data-contact="{{ $student->Contact_No }}"
                                                data-email="{{ $student->Email }}"
                                                data-course="{{ $student->C_ID }}"
                                                data-stats="{{ $student->Stats }}"
                                                data-username="{{ $student->Username }}"
                                                data-photo="{{ $student->photo }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form action="{{ route('students.destroy', $student->id) }}"
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Are you sure?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="9" class="text-center py-4">No students found</td>
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
                                {{ $students->appends(request()->query())->links() }}
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
                    <h5 class="modal-title"><i class="fas fa-user-plus me-2"></i>New Student</h5>
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
                                <label class="form-label">Date of Birth</label>
                                <input type="date" name="dob" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Profile Photo</label>
                                <input type="file" name="photo" class="form-control" accept="image/*" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Parent Name</label>
                                <input type="text" name="parent_name" class="form-control" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Address</label>
                                <input type="text" name="address" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Contact Number</label>
                                <input type="tel" name="contact_no" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Course</label>
                                <select name="course_id" class="form-select" required>
                                    @foreach($courses as $course)
                                        <option value="{{ $course->id }}">{{ $course->course_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Status</label>
                                <select name="stats" class="form-select" required>
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Username</label>
                                <input type="text" name="username" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Create Student</button>
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
                <form id="editForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Full Name</label>
                                <input type="text" name="name" id="editName" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Date of Birth</label>
                                <input type="date" name="dob" id="editDob" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Profile Photo</label>
                                <input type="file" name="photo" class="form-control" accept="image/*">
                                <small class="text-muted">Leave blank to keep current photo</small>
                                <div class="mt-2">
                                    <img id="currentPhoto" src="" alt="Current Photo" style="max-width: 100px;">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Parent Name</label>
                                <input type="text" name="parent_name" id="editParent" class="form-control" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Address</label>
                                <input type="text" name="address" id="editAddress" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Contact Number</label>
                                <input type="tel" name="contact_no" id="editContact" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" id="editEmail" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Course</label>
                                <select name="course_id" id="editCourse" class="form-select" required>
                                    @foreach($courses as $course)
                                        <option value="{{ $course->id }}">{{ $course->course_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Status</label>
                                <select name="stats" id="editStats" class="form-select" required>
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Username</label>
                                <input type="text" name="username" id="editUsername" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control">
                                <small class="text-muted">Leave blank to keep current password</small>
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
            const editButtons = document.querySelectorAll('.edit-btn');

            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const studentId = this.dataset.id;
                    const updateUrl = `{{ route('students.update', ':id') }}`.replace(':id', studentId);
                    document.getElementById('editForm').action = updateUrl;

                    document.getElementById('editName').value = this.dataset.name;
                    document.getElementById('editDob').value = this.dataset.dob;
                    document.getElementById('editParent').value = this.dataset.parent;
                    document.getElementById('editAddress').value = this.dataset.address;
                    document.getElementById('editContact').value = this.dataset.contact;
                    document.getElementById('editEmail').value = this.dataset.email;
                    document.getElementById('editCourse').value = this.dataset.course;
                    document.getElementById('editStats').value = this.dataset.stats;
                    document.getElementById('editUsername').value = this.dataset.username;

                    const photoPreview = document.getElementById('currentPhoto');
                    photoPreview.src = this.dataset.photo
                        ? `/storage/${this.dataset.photo}`
                        : '/images/default-user.png';

                    // Set selected options for dropdowns
                    const courseSelect = document.getElementById('editCourse');
                    Array.from(courseSelect.options).forEach(option => {
                        option.selected = option.value === this.dataset.course;
                    });

                    const statusSelect = document.getElementById('editStats');
                    Array.from(statusSelect.options).forEach(option => {
                        option.selected = option.value === this.dataset.stats;
                    });
                });
            });
        });
    </script>
</body>
</html>
