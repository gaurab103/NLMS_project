@include('nav_aside');
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
            margin: 0;
        }

        .content {
            margin-left: 250px; /* Adjust to match the width of the sidebar */
            padding: 20px;
            transition: margin-left 0.3s ease;
        }

        .sidebar.hidden + .content {
            margin-left: 0;
        }

        @media (max-width: 768px) {
            .content {
                margin-left: 0;
                padding: 10px;
            }
        }

        .card {
            border-radius: 8px;
            border: none;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card img {
            border-radius: 8px 8px 0 0;
            height: 150px;
            object-fit: cover;
        }

        .class-title {
            font-size: 18px;
            font-weight: bold;
            margin: 10px 0;
        }

        @media (max-width: 576px) {
            .card img {
                height: 120px;
            }

            .class-title {
                font-size: 16px;
            }
        }

        .modal-body img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>

<body>
    <div class="content">
        <div class="container-fluid">
            <div class="row" id="classCards">
                <!-- Example Class Card -->
                <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                    <div class="card" onclick="openClass('Class 1')">
                        <img src="https://via.placeholder.com/300x150?text=Class+1" alt="Class 1">
                        <div class="card-body text-center">
                            <h4 class="class-title">Class 1</h4>
                        </div>
                    </div>
                </div>
                <!-- Repeat Class Cards -->
                <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                    <div class="card" onclick="openClass('Class 2')">
                        <img src="https://via.placeholder.com/300x150?text=Class+2" alt="Class 2">
                        <div class="card-body text-center">
                            <h4 class="class-title">Class 2</h4>
                        </div>
                    </div>
                </div>
                <!-- Add more cards as needed -->
            </div>
        </div>
    </div>

    <!-- Class Modal -->
    <div class="modal fade" id="classModal" tabindex="-1" aria-labelledby="classModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="classModalLabel">Class Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="https://via.placeholder.com/300x150?text=Class+1" alt="Class Image">
                        </div>
                        <div class="col-md-6">
                            <h4 class="class-title">Class Details</h4>
                            <p>Description of the class goes here.</p>
                            <button type="button" class="btn btn-primary btn-class">View Students</button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    {{-- <script>
        function openClass(className) {
            $('#classModalLabel').text(className);
            $('#classModal').modal('show');
        }
    </script> --}}
</body>

</html>
