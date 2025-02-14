@include('nav_aside')

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage Teachers</title>
  <!-- Bootstrap 5 and Font Awesome CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  <style>
    body { background-color: #f8f9fa; }
    .content-wrapper {
      margin-left: 260px;
      padding: 20px;
      transition: margin-left 0.3s ease;
    }
    .sidebar.hidden + .content-wrapper { margin-left: 0; }
    .card { transition: transform 0.3s; }
    .card:hover { transform: scale(1.02); }
    .btn-toggle { display: none; }
    @media (max-width: 768px) {
      .btn-toggle { display: block; }
      .content-wrapper { margin-left: 0; }
    }
    .table-responsive { overflow-x: auto; }
    .modal-header { background: #4093e7; color: #fff; }
  </style>
</head>
<body>
  <div class="content-wrapper">
    <!-- Mobile Sidebar Toggle Button -->
    <button class="btn btn-primary btn-toggle mb-3" id="toggleSidebar">☰ Menu</button>
    <h2 class="mb-4">Teacher Management</h2>

    <!-- Success Message -->
    @if (session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Button to trigger Add Teacher Modal -->
    <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addTeacherModal">
      <i class="fas fa-user-plus"></i> Add Teacher
    </button>

    <!-- Teachers Table -->
    <div class="table-responsive">
      <table class="table table-striped align-middle">
        <thead class="table-dark">
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Subject</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Username</th>
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
            <td>{{ $teacher->Username }}</td>
            <td>
              <!-- Edit Button -->
              <button class="btn btn-warning btn-sm edit-button"
                data-bs-toggle="modal"
                data-bs-target="#editTeacherModal"
                data-id="{{ $teacher->id }}"
                data-name="{{ $teacher->Teacher_Name }}"
                data-subject="{{ $teacher->Subject }}"
                data-email="{{ $teacher->Email }}"
                data-phone="{{ $teacher->Phone_Number }}"
                data-address="{{ $teacher->Address }}"
                data-username="{{ $teacher->Username }}">
                <i class="fas fa-edit"></i>
              </button>
              <!-- Delete Form -->
              <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this teacher?');">
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
  </div>

  <!-- Add Teacher Modal -->
  <div class="modal fade" id="addTeacherModal" tabindex="-1" aria-labelledby="addTeacherModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addTeacherModalLabel">Add Teacher</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('teachers.store') }}" method="POST">
          @csrf
          <div class="modal-body">
            <div class="row g-3">
              <div class="col-md-6">
                <label for="teacher_name" class="form-label">Teacher Name</label>
                <input type="text" name="teacher_name" id="teacher_name" class="form-control" required>
              </div>
              <div class="col-md-6">
                <label for="subject" class="form-label">Subject</label>
                <input type="text" name="subject" id="subject" class="form-control" required>
              </div>
              <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
              </div>
              <div class="col-md-6">
                <label for="phone_number" class="form-label">Phone Number</label>
                <input type="text" name="phone_number" id="phone_number" class="form-control" required>
              </div>
              <div class="col-md-6">
                <label for="address" class="form-label">Address</label>
                <input type="text" name="address" id="address" class="form-control" required>
              </div>
              <div class="col-md-6">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" id="username" class="form-control" required>
              </div>
              <div class="col-md-6">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Save Teacher</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Edit Teacher Modal -->
  <div class="modal fade" id="editTeacherModal" tabindex="-1" aria-labelledby="editTeacherModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editTeacherModalLabel">Edit Teacher</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="editTeacherForm" method="POST">
          @csrf
          @method('PUT')
          <div class="modal-body">
            <div class="row g-3">
              <div class="col-md-6">
                <label for="edit_teacher_name" class="form-label">Teacher Name</label>
                <input type="text" name="teacher_name" id="edit_teacher_name" class="form-control" required>
              </div>
              <div class="col-md-6">
                <label for="edit_subject" class="form-label">Subject</label>
                <input type="text" name="subject" id="edit_subject" class="form-control" required>
              </div>
              <div class="col-md-6">
                <label for="edit_email" class="form-label">Email</label>
                <input type="email" name="email" id="edit_email" class="form-control" required>
              </div>
              <div class="col-md-6">
                <label for="edit_phone_number" class="form-label">Phone Number</label>
                <input type="text" name="phone_number" id="edit_phone_number" class="form-control" required>
              </div>
              <div class="col-md-6">
                <label for="edit_address" class="form-label">Address</label>
                <input type="text" name="address" id="edit_address" class="form-control" required>
              </div>
              <div class="col-md-6">
                <label for="edit_username" class="form-label">Username</label>
                <input type="text" name="username" id="edit_username" class="form-control" required>
              </div>
              <div class="col-md-6">
                <label for="edit_password" class="form-label">Password</label>
                <input type="password" name="password" id="edit_password" class="form-control">
                <small class="text-muted">Leave blank to keep the existing password</small>
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

  <!-- Bootstrap 5 Bundle with Popper and jQuery -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    // Toggle sidebar on mobile devices
    $('#toggleSidebar').click(function () {
      $('#sidebar').toggleClass('hidden');
    });

    // Populate the Edit Teacher Modal with data from the clicked row
    $('.edit-button').click(function () {
      let id = $(this).data('id');
      let name = $(this).data('name');
      let subject = $(this).data('subject');
      let email = $(this).data('email');
      let phone = $(this).data('phone');
      let address = $(this).data('address');
      let username = $(this).data('username');

      $('#editTeacherForm').attr('action', '/admin/teachers/' + id);
      $('#edit_teacher_name').val(name);
      $('#edit_subject').val(subject);
      $('#edit_email').val(email);
      $('#edit_phone_number').val(phone);
      $('#edit_address').val(address);
      $('#edit_username').val(username);
      $('#edit_password').val('');
    });
  </script>
</body>
</html>
