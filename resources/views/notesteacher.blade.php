<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Notes Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    @include('navteacher', ['active' => 'notes'])

    <div class="content">
        <div class="container">
            <h1 class="text-center my-4">Notes</h1>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-container">
                <h2>Upload New Note</h2>
                <form action="{{ route('teacher.notes.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="class_id" class="form-label">Class</label>
                        <select name="class_id" id="class_id" class="form-control" required>
                            <option value="">Select Class</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->course_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="subject_id" class="form-label">Subject</label>
                        <select name="subject_id" id="subject_id" class="form-control" required>
                            <option value="">Select Subject</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="chapter_name" class="form-label">Chapter Name</label>
                        <input type="text" name="chapter_name" id="chapter_name" class="form-control" value="{{ old('chapter_name') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Content</label>
                        <textarea name="content" id="content" class="form-control" required>{{ old('content') }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="file" class="form-label">Attachment (Optional, PDF/DOC only)</label>
                        <input type="file" name="file" id="file" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Upload Note</button>
                </form>
            </div>

            <div class="card mt-4">
                <div class="card-header bg-info text-white">Your Notes</div>
                <div class="card-body">
                    @if($notes->isEmpty())
                        <p>No notes uploaded yet.</p>
                    @else
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Chapter</th>
                                    <th>Subject</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($notes as $note)
                                    <tr>
                                        <td>{{ $note->title }}</td>
                                        <td>{{ $note->chapter_name }}</td>
                                        <td>{{ $note->subject->name ?? 'N/A' }}</td>
                                        <td>
                                            @if($note->file_path)
                                                <a href="{{ Storage::url($note->file_path) }}" target="_blank" class="btn btn-sm btn-info">Download</a>
                                            @endif
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
