<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>

<style>
    .editprofile {
        position: relative;
        text-decoration: none;
        color: lightgray;
    }

    .editbutton {
        border: none;
        border-radius: 5px;
        background-color: blue;
        padding: 5px;
    }

    .editprofile:hover {
        color: white;
        background-color: #0056b3;
        padding: 5px;
    }
</style>

<body>
    <div>
        <button class='editbutton'>
            <a href="{{ route('edit.profile', $student->id) }}" class='editprofile'>Edit Profile</a>
        </button>
    </div>
    <div class="container mt-5">
        <h1>Student Profile</h1>
        <div class="card">
            <div class="card-header">
                <h3>{{ $student->name }}</h3>
            </div>
            <div class="card-body">
                <p><strong>Student ID:</strong> {{ $student->id }}</p>
                <p><strong>Class ID:</strong> {{ $student->C_ID }}</p>
                <p><strong>Name:</strong> {{ $student->name }}</p>
                <p><strong>Address:</strong> {{ $student->Address }}</p>
                <p><strong>Parent's Name:</strong> {{ $student->Parent_Name }}</p>
                <p><strong>Contact:</strong> {{ $student->Contact_No }}</p>
                <p><strong>Email:</strong> {{ $student->Email }}</p>
                <p><strong>Status:</strong> {{ $student->Stats }}</p>
            </div>
        </div>
    </div>
</body>

</html>
