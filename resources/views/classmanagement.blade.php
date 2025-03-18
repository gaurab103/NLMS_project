@include('nav_aside')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Class Management</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    .content-wrapper {
      margin-left: 260px;
      padding: 25px;
    }
    .class-card {
      transition: transform 0.2s, box-shadow 0.2s;
      cursor: pointer;
    }
    .class-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    .subject-card {
      background: #f8f9fa;
      border-left: 4px solid #4093e7;
    }
  </style>
</head>
<body>
  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="card shadow">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
          <h3 class="mb-0"><i class="fas fa-landmark me-2"></i>NLMS Class Management</h3>
          <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#classModal">
            <i class="fas fa-plus me-2"></i>Add Class
          </button>
        </div>
        <div class="card-body">
          @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
              {{ session('success') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
          @elseif(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
              {{ session('error') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
          @endif

          <div class="row g-4">
            @foreach ($classes as $class)
              <div class="col-md-4">
                <div class="card class-card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                      <h5 class="card-title">{{ $class->course_name }}</h5>
                      <div>
                        <span class="badge bg-primary me-1">
                          {{ $class->subjects_count }} Subjects
                        </span>
                        <span class="badge bg-success">
                          {{ $class->students_count }} Students
                        </span>
                      </div>
                    </div>
                    <div class="mt-3">
                      <button class="btn btn-sm btn-warning edit-class" data-id="{{ $class->id }}"
                              data-name="{{ $class->course_name }}" data-bs-toggle="modal"
                              data-bs-target="#classModal">
                        <i class="fas fa-edit"></i> Edit
                      </button>
                      <button class="btn btn-sm btn-danger delete-class" data-id="{{ $class->id }}">
                        <i class="fas fa-trash"></i> Delete
                      </button>
                    </div>
                    <div class="mt-3">
                      <button class="btn btn-sm btn-success w-100" data-bs-toggle="collapse"
                              href="#subjects-{{ $class->id }}">
                        <i class="fas fa-book me-2"></i> Manage Subjects
                      </button>
                    </div>
                    <div class="mt-2">
                      <a href="{{ route('classes.show', ['class' => $class->id]) }}"
                         class="btn btn-info btn-sm w-100">
                        <i class="fas fa-info-circle me-2"></i> View Details
                      </a>
                    </div>
                  </div>
                  <div class="collapse" id="subjects-{{ $class->id }}">
                    <div class="card-body bg-light">
                      <button class="btn btn-sm btn-primary mb-3 w-100" data-bs-toggle="modal"
                              data-bs-target="#subjectModal" data-class-id="{{ $class->id }}">
                        <i class="fas fa-plus me-2"></i>Add Subject
                      </button>
                      @foreach ($class->subjects as $subject)
                        <div class="card subject-card mb-2">
                          <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                              <h6>{{ $subject->name }}</h6>
                              <small class="text-muted">
                                Teacher: {{ $subject->teacher->Teacher_Name }}
                              </small>
                            </div>
                            <div class="btn-group">
                              <button class="btn btn-sm btn-warning edit-subject"
                                      data-id="{{ $subject->id }}"
                                      data-name="{{ $subject->name }}"
                                      data-teacher="{{ $subject->teacher_id }}"
                                      data-description="{{ $subject->description }}"
                                      data-bs-toggle="modal" data-bs-target="#subjectModal">
                                <i class="fas fa-edit"></i>
                              </button>
                              <button class="btn btn-sm btn-danger delete-subject"
                                      data-id="{{ $subject->id }}">
                                <i class="fas fa-trash"></i>
                              </button>
                            </div>
                          </div>
                        </div>
                      @endforeach
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Class Modal -->
  <div class="modal fade" id="classModal" tabindex="-1" aria-labelledby="classModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="classForm" method="POST">
          @csrf
          <div id="method-container"></div>
          <div class="modal-header bg-primary text-white">
            <h5 class="modal-title" id="classModalLabel">Class Form</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <input type="hidden" name="id" id="classId">
            <div class="mb-3">
              <label for="className" class="form-label">Class Name</label>
              <input type="text" name="course_name" id="className" class="form-control" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save Class</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Subject Modal -->
  <div class="modal fade" id="subjectModal" tabindex="-1" aria-labelledby="subjectModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="subjectForm" method="POST">
          @csrf
          <div class="modal-header bg-primary text-white">
            <h5 class="modal-title" id="subjectModalLabel">Subject Form</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <input type="hidden" name="class_id" id="classIdInput">
            <input type="hidden" name="id" id="subjectId">
            <div class="mb-3">
              <label for="subjectName" class="form-label">Subject Name</label>
              <input type="text" name="name" id="subjectName" class="form-control" required>
            </div>
            <div class="mb-3">
              <label for="subjectTeacher" class="form-label">Teacher</label>
              <select name="teacher_id" id="subjectTeacher" class="form-select" required>
                <option value="">Select Teacher</option>
                @foreach ($teachers as $teacher)
                  <option value="{{ $teacher->id }}">{{ $teacher->Teacher_Name }}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3">
              <label for="subjectDescription" class="form-label">Description</label>
              <textarea name="description" id="subjectDescription" class="form-control" rows="3"></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save Subject</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- JS Scripts -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    $(document).ready(function() {
      // Class Modal - Create / Edit
      $('#classModal').on('show.bs.modal', function(e) {
        const button = $(e.relatedTarget);
        const isEdit = button.hasClass('edit-class');
        const form = $('#classForm');

        if (isEdit) {
          form.attr('action', '/admin/classes/' + button.data('id'));
          $('#method-container').html('<input type="hidden" name="_method" value="PUT">');
          $('#className').val(button.data('name'));
          $('#classId').val(button.data('id'));
        } else {
          form.attr('action', "{{ route('classes.store') }}");
          $('#method-container').empty();
          form.trigger('reset');
        }
      });

      // Subject Modal - Create / Edit
      $('#subjectModal').on('show.bs.modal', function(e) {
        const button = $(e.relatedTarget);
        const isEdit = button.hasClass('edit-subject');
        const form = $('#subjectForm');

        if (isEdit) {
          form.attr('action', '/admin/subjects/' + button.data('id'));
          form.find('input[name="_method"]').remove();
          form.append('<input type="hidden" name="_method" value="PUT">');
          $('#subjectName').val(button.data('name'));
          $('#subjectTeacher').val(button.data('teacher'));
          $('#subjectDescription').val(button.data('description'));
          $('#subjectId').val(button.data('id'));
        } else {
          form.attr('action', "{{ route('subjects.store') }}");
          form.find('input[name="_method"]').remove();
          form.trigger('reset');
          $('#classIdInput').val(button.data('class-id'));
        }
      });

      // Delete Class
      $('.delete-class').click(function() {
        if (confirm('Delete this class and all its subjects?')) {
          $.ajax({
            url: '/admin/classes/' + $(this).data('id'),
            method: 'DELETE',
            data: {
              _token: '{{ csrf_token() }}',
              _method: 'DELETE'
            },
            success: () => location.reload()
          });
        }
      });

      // Delete Subject
      $('.delete-subject').click(function() {
        if (confirm('Delete this subject permanently?')) {
          $.ajax({
            url: '/admin/subjects/' + $(this).data('id'),
            method: 'DELETE',
            data: {
              _token: '{{ csrf_token() }}',
              _method: 'DELETE'
            },
            success: () => location.reload()
          });
        }
      });
    });
  </script>
</body>
</html>
