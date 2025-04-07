<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Assignment Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    @include('navteacher', ['active' => 'assignments'])

    <div class="content">
        <div class="container">
            <h1 class="text-center my-4">Assignments</h1>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="form-container">
                @if(isset($assignment))
                    <h2>Edit Assignment</h2>
                    <form action="{{ route('assignments.update', $assignment) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                @else
                    <h2>Create New Assignment</h2>
                    <form action="{{ route('assignments.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                @endif

                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" id="title" class="form-control"
                               value="{{ $assignment->title ?? old('title') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="class_id" class="form-label">Class</label>
                        <select name="class_id" id="class_id" class="form-control" required>
                            <option value="">Select Class</option>
                            @foreach($classes as $class)
                                <option value="{{ $class->id }}"
                                    {{ isset($assignment) && $assignment->course_id == $class->id ? 'selected' : '' }}>
                                    {{ $class->course_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="subject_id" class="form-label">Subject</label>
                        <select name="subject_id" id="subject_id" class="form-control" required>
                            <option value="">Select Subject</option>
                            @if(isset($assignment))
                                @foreach($subjects as $subject)
                                    <option value="{{ $subject->id }}"
                                        {{ $assignment->subject_id == $subject->id ? 'selected' : '' }}>
                                        {{ $subject->name }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="due_date" class="form-label">Due Date</label>
                        <input type="datetime-local" name="due_date" id="due_date" class="form-control"
                               value="{{ isset($assignment) ? $assignment->due_date->format('Y-m-d\TH:i') : old('due_date') }}"
                               required>
                    </div>
                    <div class="mb-3">
                        <label for="max_marks" class="form-label">Maximum Marks</label>
                        <input type="number" name="max_marks" id="max_marks" class="form-control"
                               value="{{ $assignment->max_marks ?? old('max_marks') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" class="form-control">
                            {{ $assignment->description ?? old('description') }}
                        </textarea>
                    </div>
                    <div class="mb-3">
                        <label for="file" class="form-label">Attachment (Optional, PDF/DOC only)</label>
                        <input type="file" name="file" id="file" class="form-control">
                        @if(isset($assignment) && $assignment->file_path)
                            <div class="mt-2">
                                <a href="{{ Storage::url($assignment->file_path) }}" target="_blank">View Current File</a>
                            </div>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary">
                        {{ isset($assignment) ? 'Update' : 'Create' }} Assignment
                    </button>
                </form>
            </div>

            <div class="card mt-4">
                <div class="card-header bg-info text-white">Your Assignments</div>
                <div class="card-body">
                    @if($assignments->isEmpty())
                        <p>No assignments posted yet.</p>
                    @else
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Class</th>
                                    <th>Subject</th>
                                    <th>Due Date</th>
                                    <th>Max Marks</th>
                                    <thiede
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($assignments as $assignment)
                                    <tr>
                                        <td>{{ $assignment->title }}</td>
                                        <td>{{ $assignment->course->course_name ?? 'N/A' }}</td>
                                        <td>{{ $assignment->subject->name ?? 'N/A' }}</td>
                                        <td>{{ $assignment->due_date->format('M d, Y H:i') }}</td>
                                        <td>{{ $assignment->max_marks }}</td>
                                        <td>
                                            <a href="{{ route('assignments.edit', $assignment) }}" class="btn btn-sm btn-warning">Edit</a>
                                            <a href="{{ route('assignments.submissions', $assignment) }}" class="btn btn-sm btn-info">Submissions</a>
                                            <form action="{{ route('assignments.destroy', $assignment) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#class_id').change(function() {
                var classId = $(this).val();
                if (classId) {
                    $.ajax({
                        url: '/teacher/subjects-by-class/' + classId,
                        type: 'GET',
                        success: function(data) {
                            $('#subject_id').empty();
                            $('#subject_id').append('<option value="">Select Subject</option>');
                            $.each(data, function(key, value) {
                                $('#subject_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                            });
                        }
                    });
                } else {
                    $('#subject_id').empty();
                    $('#subject_id').append('<option value="">Select Subject</option>');
                }
            });
        });
    </script>
</body>
</html>
