@include('nav_aside');
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <title>Manage Class 1 Students</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f9f9f9;
        }

        .container {
            margin-top: 20px;
        }

        .table {
            margin-top: 20px;
        }

        .search-bar {
            margin-bottom: 20px;
        }

        .modal-header {
            background-color: #007bff;
            color: white;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="text-center">Manage Students - Class 1</h1>
        <div class="row search-bar">
            <div class="col-md-8">
                <input type="text" id="searchInput" class="form-control" placeholder="Search by name or age...">
            </div>
            <div class="col-md-4 text-right">
                <button class="btn btn-primary" data-toggle="modal" data-target="#addStudentModal">Add Student</button>
            </div>
        </div>

        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="studentTableBody">
                <!-- Example Student -->
                <tr>
                    <td>1</td>
                    <td>John Doe</td>
                    <td>10</td>
                    <td>
                        <button class="btn btn-warning btn-sm" onclick="editStudent(1)">Edit</button>
                        <button class="btn btn-danger btn-sm" onclick="deleteStudent(1)">Delete</button>
                    </td>
                </tr>
                <!-- More students can be added dynamically -->
            </tbody>
        </table>
    </div>

    <!-- Add Student Modal -->
    <div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentModalLabel" aria-hidden="true">
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
                            <label for="studentName">Name</label>
                            <input type="text" class="form-control" id="studentName" required>
                        </div>
                        <div class="form-group">
                            <label for="studentAge">Age</label>
                            <input type="number" class="form-control" id="studentAge" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const studentTableBody = document.getElementById('studentTableBody');
        const addStudentForm = document.getElementById('addStudentForm');
        const searchInput = document.getElementById('searchInput');

        let students = [
            { id: 1, name: 'John Doe', age: 10 },
        ];

        function refreshTable() {
            studentTableBody.innerHTML = '';
            students.forEach(student => {
                const row = `<tr>
                    <td>${student.id}</td>
                    <td>${student.name}</td>
                    <td>${student.age}</td>
                    <td>
                        <button class='btn btn-warning btn-sm' onclick='editStudent(${student.id})'>Edit</button>
                        <button class='btn btn-danger btn-sm' onclick='deleteStudent(${student.id})'>Delete</button>
                    </td>
                </tr>`;
                studentTableBody.innerHTML += row;
            });
        }

        addStudentForm.addEventListener('submit', function (e) {
            e.preventDefault();
            const name = document.getElementById('studentName').value;
            const age = document.getElementById('studentAge').value;
            students.push({ id: students.length + 1, name, age });
            refreshTable();
            $('#addStudentModal').modal('hide');
        });

        function editStudent(id) {
            const student = students.find(s => s.id === id);
            const name = prompt('Enter new name:', student.name);
            const age = prompt('Enter new age:', student.age);
            if (name && age) {
                student.name = name;
                student.age = age;
                refreshTable();
            }
        }

        function deleteStudent(id) {
            students = students.filter(s => s.id !== id);
            refreshTable();
        }

        searchInput.addEventListener('input', function () {
            const query = searchInput.value.toLowerCase();
            studentTableBody.innerHTML = '';
            students.filter(student =>
                student.name.toLowerCase().includes(query) ||
                student.age.toString().includes(query))
                .forEach(student => {
                    const row = `<tr>
                        <td>${student.id}</td>
                        <td>${student.name}</td>
                        <td>${student.age}</td>
                        <td>
                            <button class='btn btn-warning btn-sm' onclick='editStudent(${student.id})'>Edit</button>
                            <button class='btn btn-danger btn-sm' onclick='deleteStudent(${student.id})'>Delete</button>
                        </td>
                    </tr>`;
                    studentTableBody.innerHTML += row;
                });
        });

        refreshTable();
    </script>
</body>

</html>
