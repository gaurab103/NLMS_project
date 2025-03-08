<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <style>
                /* General Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 20px;
            
        }
        h2{
            display:flex;
            justify-content:center;
            margin-left:10%;
        }

        /* Form Styling */
        form {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin-bottom: 30px;
            margin-left:35%;
        }

        form h2 {
            margin-bottom: 20px;
            
        }

        .form-label {
            font-weight: bold;
        }

        .form-control {
            border-radius: 5px;
            padding: 10px;
        }

        /* Buttons */
        .btn {
            padding: 8px 12px;
            font-size: 14px;
            border-radius: 5px;
            transition: 0.3s ease-in-out;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-success {
            background-color: #28a745;
            border: none;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        .btn-warning {
            background-color: #ffc107;
            border: none;
        }

        .btn-warning:hover {
            background-color: #e0a800;
        }

        .btn-danger {
            background-color: #dc3545;
            border: none;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        /* Table Styling */
        .table {
    width: auto; /* Reduce table width further */
    margin: 20px  0 -2%; /* Center the table */
    background: white;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    font-size: 12px; /* Reduce overall text size */
}

/* Table Header */
.table th {
    background: #007bff;
    color: white;
    margin-left:-20%;
    padding: 4px; /* Reduce padding */
    text-align: left;
    font-size: 12px;
}

/* Table Data */
.table td {
    padding: 4px; /* Reduce padding */
    border-bottom: 1px solid #ddd;
    font-size: 12px; /* Reduce text size */
}

/* Zebra Striping */
.table-striped tbody tr:nth-child(odd) {
    background-color: #f2f2f2;
}
        /* Responsive Design */
        @media (max-width: 768px) {
            form {
                width: 100%;
            }

            .table {
                font-size: 14px;
            }
        }

    </style>
 @include('navteacher', ['active' => 'assignments'])
        <!-- Edit Form (Shown when editing) -->
        @if(isset($assignment))
            <h2>Edit Assignment</h2>
            <form action="{{ route('assignments.update', $assignment) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ $assignment->title }}" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" class="form-control" required>{{ $assignment->description }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="class_id" class="form-label">Class</label>
                    <select name="class_id" id="class_id" class="form-control" required>
                        @foreach($classes as $class)
                            <option value="{{ $class->id }}" {{ $assignment->course_id == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="subject_id" class="form-label">Subject</label>
                    <select name="subject_id" id="subject_id" class="form-control" required>
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}" {{ $assignment->subject_id == $subject->id ? 'selected' : '' }}>{{ $subject->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="due_date" class="form-label">Due Date</label>
                    <input type="date" name="due_date" id="due_date" class="form-control" value="{{ $assignment->due_date }}" required>
                </div>
                <div class="mb-3">
                    <label for="file" class="form-label">File (optional)</label>
                    <input type="file" name="file" id="file" class="form-control">
                    @if($assignment->file_path)
                        <small>Current file: <a href="{{ Storage::url($assignment->file_path) }}" target="_blank">View</a></small>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Update Assignment</button>
            </form>
        @else
            <!-- Create Form -->
            <h2>Create New Assignment</h2>
            <form action="{{ route('assignments.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" id="title" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" class="form-control" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="class_id" class="form-label">Class</label>
                    <select name="class_id" id="class_id" class="form-control" required>
                        @foreach($classes as $class)
                            <option value="{{ $class->id }}">{{ $class->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="subject_id" class="form-label">Subject</label>
                    <select name="subject_id" id="subject_id" class="form-control" required>
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="due_date" class="form-label">Due Date</label>
                    <input type="date" name="due_date" id="due_date" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="file" class="form-label">File (optional)</label>
                    <input type="file" name="file" id="file" class="form-control">
                </div>
                <button type="submit" class="btn btn-success">Create Assignment</button>
            </form>
        @endif

        <!-- Assignment List -->
        <h2 class="mt-5">Assignments</h2>
        <table class="table table-striped">
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
                        <td>{{ $assignment->course->name }}</td>
                        <td>{{ $assignment->subject->name }}</td>
                        <td>{{ $assignment->due_date }}</td>
                        <td>
                            <a href="{{ route('assignments.edit', $assignment) }}" class="btn btn-sm btn-warning">Edit</a>
                            <a href="{{ route('assignments.show', $assignment) }}" class="btn btn-sm btn-info">View</a>
                            <form action="{{ route('assignments.destroy', $assignment) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


</body>
</html>
