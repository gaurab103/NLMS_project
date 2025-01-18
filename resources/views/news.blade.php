@include('nav_aside')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News & Notices</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            /* background-color: #f9f9f9; */
            margin: 0;
            padding: 0;
        }

        .container {
            margin-top: 50px;
            margin-left: 250px;
            padding: 20px;
        }

        .content {
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
        }

        .content h2 {
            text-align: center;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            font-size: 14px;
            color: #555;
        }

        input,
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        button {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
        }

        button:hover {
            background-color: #0056b3;
        }

        .success-message {
            background-color: #d4edda;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .form-container {
            display: none;
            margin-top: 20px;
            padding: 20px;
            background-color: aqua;
            border-radius: 8px;
            border: 1px solid #ddd;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .form-container.active {
            display: block;
        }

        .toggle-button {
            display: block;
            margin: 20px auto;
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        .toggle-button:hover {
            background-color: #218838;
        }

        .notice-item {
            margin-top: 20px;
            padding: 20px;
            background-color: aquamarine;
            border: 2px solid #ddd;
            border-radius: 4px;
        }

        .notice-item h4 {
            margin: 0;
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
            font-size: 24px;
            font-weight: 600;
        }

        .notice-item .actions {
            margin-top: 15px;
        }

        .actions button {
            background-color: #ffc107;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .actions button.delete {
            background-color: #dc3545;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="content">
            @if (session('success'))
                <div class="success-message">{{ session('success') }}</div>
            @endif

            <!-- Add Notice Button -->
            <button class="toggle-button" id="addNoticeButton">Add Notice</button>

            <!-- Add Notice Form -->
            <div class="form-container" id="addNoticeForm">
                <form action="{{ route('news.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" required>
                    </div>

                    <div class="form-group">
                        <label for="content">Content</label>
                        <textarea name="content" id="content" rows="4" required></textarea>
                    </div>

                    <button type="submit">Publish</button>
                </form>
            </div>

            <!-- Display Notices -->
            <h3>Posted Notices</h3>
            @foreach($notices as $notice)
                <div class="notice-item">
                    <h4>{{ $notice->title }}</h4>
                    <p>{{ $notice->content }}</p>
                    <p><small>Added on: {{ $notice->created_at }} | Updated on: {{ $notice->updated_at }}</small></p>
                    <div class="actions">
                        <a href="{{ route('news.edit', $notice->id) }}">
                            <button>Edit</button>
                        </a>
                        <form action="{{ route('news.destroy', $notice->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete">Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        const addNoticeButton = document.getElementById('addNoticeButton');
        const addNoticeForm = document.getElementById('addNoticeForm');

        addNoticeButton.addEventListener('click', () => {
            addNoticeForm.classList.toggle('active');
            if (addNoticeForm.classList.contains('active')) {
                addNoticeButton.textContent = 'Hide Notice Form';
            } else {
                addNoticeButton.textContent = 'Add Notice';
            }
        });
    </script>
</body>

</html>
