@include('nav_aside');
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <title>Manage Teachers</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f9f9f9;
        }
        .container {
            margin-top: 50px;
            margin-left: 250px;
        }
        .card {
            border-radius: 8px;
            border: none;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .table thead {
            background-color: #007bff;
            color: white;
        }

        .table td,
        .table th {
            vertical-align: middle;
        }

        .btn-responsive {
            font-size: 14px;
            padding: 6px 12px;
        }

        @media (max-width: 768px) {
            h3 {
                font-size: 18px;
            }

            .btn-responsive {
                font-size: 12px;
                padding: 5px 10px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3>Manage Teachers</h3>
            <button class="btn btn-primary btn-responsive" data-toggle="modal" data-target="#addTeacherModal">
                <i class="fas fa-plus"></i> Add Teacher
            </button>
        </div>

        <!-- Filters and Search -->
        <div class="card mb-4">
            <div class="card-body">
                <form id="filterForm" class="form-inline">
                    <label class="mr-2">Filter by level:</label>
                    <select class="form-control mr-3" id="departmentFilter">
                        <option value="">All</option>
                        <option value="Mathematics">primary level</option>
                        <option value="Science">basic level</option>
                        <option value="English">Secondary level</option>
                    </select>

                    <input type="text" class="form-control mr-3" id="searchInput" placeholder="Search by Name or ID">
                    <button type="button" class="btn btn-secondary btn-responsive" onclick="applyFilters()">Apply</button>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>S.N</th>
                                <th>Teacher Name</th>
                                <th>Teacher ID</th>
                                <th>Subject</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Address</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="teacherTable">
                            <!-- Dynamic Rows Go Here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Teacher Modal -->
    <div class="modal fade" id="addTeacherModal" tabindex="-1" aria-labelledby="addTeacherModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTeacherModalLabel">Add Teacher</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addTeacherForm">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="teacherName">Teacher Name</label>
                                <input type="text" class="form-control" id="teacherName" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="teacherID">Teacher ID</label>
                                <input type="text" class="form-control" id="teacherID" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="subject">Teacher Subject</label>
                                <input type="text" class="form-control" id="teachersubject" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="teacherEmail">Email</label>
                                <input type="email" class="form-control" id="teacherEmail" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="teacherPhone">Phone Number</label>
                                <input type="text" class="form-control" id="teacherPhone" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="teacherAddress">Address</label>
                                <input type="text" class="form-control" id="teacherAddress" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Teacher</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Apply Filters and Search
        function applyFilters() {
            const department = document.getElementById('departmentFilter').value.toLowerCase();
            const searchQuery = document.getElementById('searchInput').value.toLowerCase();
            const rows = document.querySelectorAll('#teacherTable tr');

            rows.forEach(row => {
                const departmentCell = row.children[3].innerText.toLowerCase();
                const nameCell = row.children[1].innerText.toLowerCase();
                const idCell = row.children[2].innerText.toLowerCase();

                const matchesDepartment = !department || departmentCell.includes(department);
                const matchesSearch = nameCell.includes(searchQuery) || idCell.includes(searchQuery);

                row.style.display = matchesDepartment && matchesSearch ? '' : 'none';
            });
        }

        // Edit Teacher
        function editTeacher(teacherID) {
            alert(`Edit Teacher with ID: ${teacherID}`);
        }

        // Delete Teacher
        function deleteTeacher(teacherID) {
            if (confirm(`Are you sure you want to delete Teacher ID: ${teacherID}?`)) {
                alert(`Teacher ID ${teacherID} deleted.`);
            }
        }

        // Add Teacher Form Submission
        document.getElementById('addTeacherForm').addEventListener('submit', function (e) {
            e.preventDefault();
            alert('New Teacher Added!');
            $('#addTeacherModal').modal('hide');
        });
    </script>
</body>

</html>
