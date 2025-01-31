<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Edit Profile</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('update.profile', $student->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" class="form-control" name="name" value="{{ old('name', $student->name) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email" value="{{ old('email', $student->email) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Contact Number</label>
                <input type="text" class="form-control" name="Contact_No" value="{{ old('Contact_No', $student->Contact_No) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Address</label>
                <textarea class="form-control" name="Address" required>{{ old('Address', $student->Address) }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Parent's Name</label>
                <input type="text" class="form-control" name="Parent_Name" value="{{ old('Parent_Name', $student->Parent_Name) }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Update Profile</button>
            <a href="{{ route('profile') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
