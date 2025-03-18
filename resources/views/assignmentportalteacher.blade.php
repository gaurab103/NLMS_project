<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Assignment Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    @include('navteacher', ['active' => 'assignments'])

    <div class="container mt-4">
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
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}"
                                {{ isset($assignment) && $assignment->subject_id == $subject->id ? 'selected' : '' }}>
                                {{ $subject->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="due_date" class="form-label">Due Date</label>
                    <input type="datetime-local" name="due_date" id="due_date"
                           class="form-control" value="{{ isset($assignment) ? $assignment->due_date->format('Y-m-d\TH:i') : old('due_date') }}" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description"
                              class="form-control">{{ $assignment->description ?? old('description') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="file" class="form-label">Attachment (Optional)</label>
                    <input type="file" name="file" id="file" class="form-control">
                    @if(isset($assignment) && $assignment->file_path)
                        <div class="mt-2">
                            <a href="{{ Storage::url($assignment->file_path) }}" target="_blank">
                                View Current File
                            </a>
                        </div>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">
                    {{ isset($assignment) ? 'Update' : 'Create' }} Assignment
                </button>
            </form>

        <hr class="my-5">

        <h3>Existing Assignments</h3>
        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Class</th>
                    <th>Subject</th>
                    <th>Due Date</th>
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
                        <td>
                            <a href="{{ route('assignments.edit', $assignment) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('assignments.destroy', $assignment) }}" method="POST" style="display:inline">
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
    </div>

    <!-- Debug Section -->
    <div class="debug-info" style="display: none; background: #f8f9fa; padding: 20px; margin-top: 20px;">
        <h4>Debug Info:</h4>
        <p>Logged-in Teacher ID: {{ Auth::guard('teacher')->id() }}</p>
        <p>Courses Found: {{ $classes->count() }}</p>
        <pre>{{ print_r($classes->pluck('course_name', 'id')->toArray(), true) }}</pre>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
