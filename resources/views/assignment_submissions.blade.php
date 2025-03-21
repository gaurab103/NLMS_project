<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment Submissions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    @include('navteacher', ['active' => 'assignments'])

    <div class="content">
        <div class="container">
            <h1 class="text-center my-4">Submissions for {{ $assignment->title }}</h1>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="card mt-4">
                <div class="card-header bg-info text-white">Submissions</div>
                <div class="card-body">
                    @if($submissions->isEmpty())
                        <p>No submissions yet.</p>
                    @else
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Student Name</th>
                                    <th>Submitted At</th>
                                    <th>File</th>
                                    <th>Marks Obtained</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($submissions as $submission)
                                    <tr>
                                        <td>{{ $submission->student->name }}</td>
                                        <td>{{ $submission->submitted_at->format('M d, Y H:i') }}</td>
                                        <td>
                                            @if($submission->file_path)
                                                <a href="{{ Storage::url($submission->file_path) }}" target="_blank">Download</a>
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>
                                            @if($submission->marks_obtained !== null)
                                                {{ $submission->marks_obtained }} / {{ $assignment->max_marks }}
                                            @else
                                                Not Evaluated
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ route('assignments.submissions.evaluate', $submission) }}" method="POST">
                                                @csrf
                                                <div class="input-group">
                                                    <input type="number" name="marks_obtained" class="form-control"
                                                           min="0" max="{{ $assignment->max_marks }}"
                                                           value="{{ $submission->marks_obtained ?? '' }}">
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                </div>
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
</body>
</html>
