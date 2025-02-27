@include('nav_aside')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <style>
        .content-wrapper {
            margin-left: 260px;
            padding: 25px;
        }
        .card-shadow {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }
        .table-hover tbody tr:hover {
            background-color: rgba(64, 147, 231, 0.05);
        }
        .teacher-photo {
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
    </style>
</head>
<body>
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="card card-shadow">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h3 class="mb-0"><i class="fas fa-chalkboard-teacher me-2"></i>Teacher Management</h3>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
                        <button class="btn btn-success mb-2 mb-md-0" data-bs-toggle="modal" data-bs-target="#addTeacherModal">
                            <i class="fas fa-user-plus me-2"></i>Add Teacher
                        </button>

                        <div class="d-flex align-items-center gap-3">
                            <div class="text-muted d-none d-md-block">
                                Showing {{ $teachers->firstItem() }} - {{ $teachers->lastItem() }} of {{ $teachers->total() }}
                            </div>
                            <div class="filter-container">
                                <form method="GET" class="d-flex mb-2 mb-md-0">
                                    <div class="input-group">
                                        <input type="text" name="search" class="form-control"
                                               placeholder="Search teachers..."
                                               value="{{ request('search') }}">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </form>

                                <form method="GET" class="ms-2">
                                    <select name="status" class="form-select" onchange="this.form.submit()">
                                        <option value="">All Status</option>
                                        <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive rounded-3">
                        <table class="table table-hover table-striped align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Photo</th>
                                    <th>Name</th>
                                    <th>Subject</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($teachers as $teacher)
                                    <tr>
                                        <td>{{ ($teachers->currentPage() - 1) * $teachers->perPage() + $loop->iteration }}</td>
                                        <td>
                                            <img src="{{ $teacher->photo_url }}" class="teacher-photo rounded-circle border" alt="{{ $teacher->Teacher_Name }}">
                                        </td>
                                        <td>{{ $teacher->Teacher_Name }}</td>
                                        <td>{{ $teacher->Subject }}</td>
                                        <td>{{ $teacher->Email }}</td>
                                        <td>{{ $teacher->Phone_Number }}</td>
                                        <td>
                                            <span class="badge bg-{{ $teacher->Status ? 'success' : 'danger' }}">
                                                {{ $teacher->Status ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td>
                                            <button class="btn btn-warning btn-sm edit-button"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editTeacherModal"
                                                data-id="{{ $teacher->id }}"
                                                data-name="{{ $teacher->Teacher_Name }}"
                                                data-subject="{{ $teacher->Subject }}"
                                                data-email="{{ $teacher->Email }}"
                                                data-phone="{{ $teacher->Phone_Number }}"
                                                data-address="{{ $teacher->Address }}"
                                                data-username="{{ $teacher->Username }}"
                                                data-password="{{ $teacher->Password }}"
                                                data-status="{{ $teacher->Status }}"
                                                data-photo="{{ $teacher->Photo }}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST" class="d-inline">
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
                                        <td colspan="8" class="text-center py-4">No teachers found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        @if($teachers->hasPages())
                            <div class="mt-3 d-flex justify-content-between align-items-center">
                                <div class="text-muted small">
                                    Showing {{ $teachers->firstItem() }} to {{ $teachers->lastItem() }} of {{ $teachers->total() }} entries
                                </div>
                                <nav>
                                    {{ $teachers->appends(request()->query())->links() }}
                                </nav>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Teacher Modal -->
    <div class="modal fade" id="addTeacherModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title"><i class="fas fa-user-plus me-2"></i>Add Teacher</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form method="POST" action="{{ route('teachers.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Full Name</label>
                                <input type="text" name="teacher_name" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Subject</label>
                                <input type="text" name="subject" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Phone Number</label>
                                <input type="tel" name="phone_number" class="form-control" pattern="\d{10,15}" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Address</label>
                                <input type="text" name="address" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Username</label>
                                <input type="text" name="username" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-select" required>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
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
                        <button type="submit" class="btn btn-primary">Add Teacher</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Teacher Modal -->
    <div class="modal fade" id="editTeacherModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title"><i class="fas fa-edit me-2"></i>Edit Teacher</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form id="editTeacherForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Full Name</label>
                                <input type="text" name="teacher_name" id="edit_teacher_name" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Subject</label>
                                <input type="text" name="subject" id="edit_subject" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" id="edit_email" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Phone Number</label>
                                <input type="tel" name="phone_number" id="edit_phone_number" class="form-control" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Address</label>
                                <input type="text" name="address" id="edit_address" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Username</label>
                                <input type="text" name="username" id="edit_username" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" id="edit_password" class="form-control">
                                <small class="text-muted">Leave blank to keep current password</small>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Status</label>
                                <select name="status" id="edit_status" class="form-select" required>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
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
                        <button type="submit" class="btn btn-primary">Update Teacher</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editButtons = document.querySelectorAll('.edit-button');

            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const teacherId = this.dataset.id;
                    const updateUrl = `{{ route('teachers.update', ':id') }}`.replace(':id', teacherId);
                    document.getElementById('editTeacherForm').action = updateUrl;

                    // Populate form fields
                    document.getElementById('edit_teacher_name').value = this.dataset.name;
                    document.getElementById('edit_subject').value = this.dataset.subject;
                    document.getElementById('edit_email').value = this.dataset.email;
                    document.getElementById('edit_phone_number').value = this.dataset.phone;
                    document.getElementById('edit_address').value = this.dataset.address;
                    document.getElementById('edit_username').value = this.dataset.username;
                    document.getElementById('edit_password').value = this.dataset.password;
                    document.getElementById('edit_status').value = this.dataset.status;

                    // Set photo preview
                    const photoPreview = document.getElementById('currentPhotoPreview');
                    photoPreview.src = this.dataset.photo ? `/storage/${this.dataset.photo}` : '/images/default-teacher.png';

                    // Clear file input
                    document.getElementById('edit_photo').value = '';
                });
            });

            document.getElementById('edit_photo').addEventListener('change', function(e) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    document.getElementById('currentPhotoPreview').src = event.target.result;
                }
                reader.readAsDataURL(e.target.files[0]);
            });
        });
    </script>
</body>
</html>
