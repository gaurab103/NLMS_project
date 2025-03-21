<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Notes</title>
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

            <div class="card mt-4">
                <div class="card-header bg-primary text-white">Upload Note</div>
                <div class="card-body">
                    <form action="{{ route('teacher.notes.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="class_id" class="form-label">Class</label>
                            <select class="form-select" id="class_id" name="class_id" required>
                                <option value="">Select Class</option>
                                @foreach($courses as $class)
                                    <option value="{{ $class->id }}">{{ $class->course_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="subject_id" class="form-label">Subject</label>
                            <select class="form-select" id="subject_id" name="subject_id" required>
                                <option value="">Select Subject</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="title" class="form-label">Note Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="chapter_name" class="form-label">Chapter Name</label>
                            <input type="text" class="form-control" id="chapter_name" name="chapter_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label">Content</label>
                            <textarea class="form-control" id="content" name="content" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="file" class="form-label">Upload File (Optional, PDF/DOC only)</label>
                            <input type="file" class="form-control" id="file" name="file">
                        </div>
                        <button type="submit" class="btn btn-primary">Upload Note</button>
                    </form>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header bg-info text-white">Your Notes</div>
                <div class="card-body">
                    @if($notes->isEmpty())
                        <p>No notes posted yet.</p>
                    @else
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Chapter</th>
                                    <th>Subject</th>
                                    <th>Class</th>
                                    <th>File</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($notes as $note)
                                    <tr>
                                        <td>{{ $note->title }}</td>
                                        <td>{{ $note->chapter_name }}</td>
                                        <td>{{ $note->subject->name ?? 'N/A' }}</td>
                                        <td>{{ $note->subject->course->course_name ?? 'N/A' }}</td>
                                        <td>
                                            @if($note->file_path)
                                                <a href="{{ Storage::url($note->file_path) }}" target="_blank">Download</a>
                                            @else
                                                N/A
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
