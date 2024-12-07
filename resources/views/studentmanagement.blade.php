<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <title>Manage Students by Class</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f9f9f9;
        }

        .container {
            margin-top: 50px;
        }

        .card {
            border-radius: 8px;
            border: none;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .card:hover {
            transform: translateY(-5px);
            transition: 0.3s;
        }

        .card-header {
            background-color: #007bff;
            color: white;
            font-size: 20px;
            font-weight: bold;
            border-radius: 8px 8px 0 0;
        }

        .card-body {
            text-align: center;
        }

        .btn-class {
            font-size: 16px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div id="classCards" class="row">
            <div class="col-md-4 mb-4">
                <div class="card" onclick="openClass('9A')">
                    <div class="card-body">
                        <h4>Class 1</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card" onclick="openClass('9B')">
                    <div class="card-body">
                        <h4>Class 2</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card" onclick="openClass('10A')">
                    <div class="card-body">
                        <h4>Class 3</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card" onclick="openClass('10A')">
                    <div class="card-body">
                        <h4>Class 4</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card" onclick="openClass('10A')">
                    <div class="card-body">
                        <h4>Class 5</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card" onclick="openClass('10A')">
                    <div class="card-body">
                        <h4>Class 6</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card" onclick="openClass('10A')">
                    <div class="card-body">
                        <h4>Class 7</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card" onclick="openClass('10A')">
                    <div class="card-body">
                        <h4>Class 8</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card" onclick="openClass('10A')">
                    <div class="card-body">
                        <h4>Class 9</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card" onclick="openClass('10A')">
                    <div class="card-body">
                        <h4>Class 10</h4>
                    </div>
                </div>
            </div>
        <div id="manageStudents" style="display: none;">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span id="classTitle"></span>
                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addStudentModal">
                        <i class="fas fa-plus"></i> Add Student
                    </button>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Student Name</th>
                                <th>Roll Number</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="studentTable">
                            <tr>
                                <td>1</td>
                                <td>John Doe</td>
                                <td>101</td>
                                <td>
                                    <button class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <button class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <button class="btn btn-secondary mt-3" onclick="goBack()">Back to Classes</button>
        </div>
    </div>

    <!-- Add Student Modal -->
    <div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addStudentModalLabel">Add Student</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addStudentForm">
                        <div class="form-group">
                            <label for="studentName">Student Name</label>
                            <input type="text" class="form-control" id="studentName" required>
                        </div>
                        <div class="form-group">
                            <label for="rollNumber">Roll Number</label>
                            <input type="text" class="form-control" id="rollNumber" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Student</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function openClass(className) {
            // Hide Class Cards and Show Student Management
            document.getElementById('classCards').style.display = 'none';
            document.getElementById('manageStudents').style.display = 'block';
            document.getElementById('classTitle').innerText = `Manage Students - ${className}`;

            // Load students dynamically for the selected class
            // (For now, we can hardcode or mock some data)
            document.getElementById('studentTable').innerHTML = `
                <tr>
                    <td>1</td>
                    <td>Student 1</td>
                    <td>${className}-101</td>
                    <td>
                        <button class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <button class="btn btn-danger btn-sm">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </td>
                </tr>
            `;
        }

        function goBack() {
            // Show Class Cards and Hide Student Management
            document.getElementById('classCards').style.display = 'flex';
            document.getElementById('manageStudents').style.display = 'none';
        }

        document.getElementById('addStudentForm').addEventListener('submit', function (e) {
            e.preventDefault();
            alert('Student Added!');
            $('#addStudentModal').modal('hide');
        });
    </script>
</body>

</html>
