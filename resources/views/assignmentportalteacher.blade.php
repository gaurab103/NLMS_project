<!-- resources/views/assignmentportalteacher.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Teacher Assignment Portal</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background-color: #f8f9fa; }
    .assignment-card { transition: transform 0.2s; }
    .assignment-card:hover { transform: translateY(-3px); }
    .submission-list { max-height: 400px; overflow-y: auto; }
  </style>
</head>
<body>
  @include('navteacher', ['active' => 'assignments'])

  <div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h1>NLMS Assignment Management</h1>
      <button class="btn btn-primary" onclick="toggleForm()">
        {{ isset($assignment) ? 'Back to List' : 'Create New Assignment' }}
      </button>
    </div>
    @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    @endif
    <div id="assignmentList">
      <div class="row g-4">
        @forelse($assignments as $assignment)
          <div class="col-md-6">
            <div class="card assignment-card shadow">
              <div class="card-header bg-primary text-white d-flex justify-content-between">
                <h5 class="mb-0">{{ $assignment->title }}</h5>
                <div class="btn-group">
                  <a href="{{ route('assignments.edit', $assignment) }}" class="btn btn-sm btn-warning">Edit</a>
                  <form action="{{ route('assignments.destroy', $assignment) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this assignment?')">
                      Delete
                    </button>
                  </form>
                </div>
              </div>
              <div class="card-body">
                <p class="card-text">{{ Str::limit($assignment->description, 100) }}</p>
                <div class="d-flex justify-content-between">
                  <small class="text-muted">Due: {{ $assignment->due_date->format('M d, Y H:i') }}</small>
                  <a href="{{ route('assignments.show', $assignment) }}" class="btn btn-sm btn-info">
                    View Submissions
                  </a>
                </div>
                @if($assignment->file_path)
                  <div class="mt-2">
                    <a href="{{ Storage::url($assignment->file_path) }}" class="btn btn-sm btn-outline-primary" target="_blank">
                      Download File
                    </a>
                  </div>
                @endif
              </div>
            </div>
          </div>
        @empty
          <div class="col-12">
            <div class="alert alert-info">No assignments created yet.</div>
          </div>
        @endforelse
      </div>
    </div>
    <div id="assignmentForm" style="display: none;">
      <div class="card shadow">
        <div class="card-header bg-primary text-white">
          <h5 class="mb-0">
            {{ isset($assignment) ? 'Edit Assignment' : 'Create New Assignment' }}
          </h5>
        </div>
        <div class="card-body">
          <form method="POST" action="{{ isset($assignment) ? route('assignments.update', $assignment) : route('teacher.assignments.store') }}" enctype="multipart/form-data">
            @csrf
            @if(isset($assignment))
              @method('PUT')
            @endif
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label">Class</label>
                <select class="form-select" name="class_id" required>
                    <option value="">Select Class</option>
                    @foreach($classes as $class)
                      <option value="{{ $class->id }}" {{ (isset($assignment) && $assignment->course_id == $class->id) ? 'selected' : '' }}>
                        {{ $class->course_name }}
                      </option>
                    @endforeach
                  </select>
              </div>
              <div class="col-md-6">
                <label class="form-label">Subject</label>
                <select class="form-select" name="subject_id" required>
                  <option value="">Select Subject</option>
                  @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}" {{ (isset($assignment) && $assignment->subject_id == $subject->id) ? 'selected' : '' }}>
                      {{ $subject->name }}
                    </option>
                  @endforeach
                </select>
              </div>
              <div class="col-12">
                <label class="form-label">Title</label>
                <input type="text" class="form-control" name="title" value="{{ $assignment->title ?? old('title') }}" required>
              </div>
              <div class="col-12">
                <label class="form-label">Description</label>
                <textarea class="form-control" name="description" rows="3" required>{{ $assignment->description ?? old('description') }}</textarea>
              </div>
              <div class="col-md-6">
                <label class="form-label">Due Date</label>
                <input type="datetime-local" class="form-control" name="due_date" value="{{ isset($assignment) ? $assignment->due_date->format('Y-m-d\TH:i') : old('due_date') }}" required>
              </div>
              <div class="col-md-6">
                <label class="form-label">Attachment (Optional)</label>
                <input type="file" class="form-control" name="file">
                @if(isset($assignment) && $assignment->file_path)
                  <div class="mt-2">
                    <small>Current file: {{ basename($assignment->file_path) }}</small>
                  </div>
                @endif
              </div>
              <div class="col-12">
                <button type="submit" class="btn btn-primary">
                  {{ isset($assignment) ? 'Update' : 'Create' }} Assignment
                </button>
                <button type="button" class="btn btn-secondary" onclick="toggleForm()">Cancel</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    @if(isset($selectedAssignment))
      <div class="mt-5">
        <div class="card shadow">
          <div class="card-header bg-info text-white">
            <h5 class="mb-0">Submissions for {{ $selectedAssignment->title }}</h5>
          </div>
          <div class="card-body submission-list">
            @forelse($selectedAssignment->submissions as $submission)
              <div class="card mb-3">
                <div class="card-body">
                  <div class="d-flex justify-content-between align-items-center">
                    <div>
                      <h6>{{ $submission->student->name }}</h6>
                      <small class="text-muted">Submitted: {{ $submission->submitted_at->format('M d, Y H:i') }}</small>
                    </div>
                    <div>
                      <a href="{{ Storage::url($submission->file_path) }}" class="btn btn-sm btn-primary" target="_blank">
                        View Submission
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            @empty
              <div class="alert alert-info">No submissions yet.</div>
            @endforelse
          </div>
        </div>
      </div>
    @endif
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function toggleForm() {
      const form = document.getElementById('assignmentForm');
      const list = document.getElementById('assignmentList');

      if (form.style.display === 'none' || form.style.display === '') {
        form.style.display = 'block';
        list.style.display = 'none';
      } else {
        form.style.display = 'none';
        list.style.display = 'block';
      }
    }
    @if(isset($assignment) || count($errors) > 0)
      toggleForm();
    @endif
  </script>
</body>
</html>
