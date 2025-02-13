<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>News & Notices</title>
  <!-- Font Awesome and Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <style>
    /* Global styles to match nav_aside */
    body {
      font-family: 'Roboto', sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f5f5f5;
    }
    /* Ensure the content respects the fixed sidebar */
    .content-container {
      margin-left: 250px;
      padding: 20px;
      transition: margin-left 0.3s ease;
    }
    @media (max-width: 768px) {
      .content-container {
        margin-left: 0;
      }
    }
    /* Page header styling */
    .page-header {
      background-color: #2c3e50;
      color: #ecf0f1;
      padding: 15px 20px;
      border-radius: 8px;
      margin-bottom: 20px;
      display: flex;
      align-items: center;
    }
    .page-header i {
      margin-right: 10px;
      color: #ffcc00;
    }
    /* Button styling */
    .add-notice-btn {
      background-color: #4093e7;
      color: #ecf0f1;
      border: none;
      padding: 10px 20px;
      border-radius: 4px;
      display: inline-flex;
      align-items: center;
      border-left: 4px solid #ffcc00;
      transition: all 0.3s ease;
      cursor: pointer;
    }
    .add-notice-btn:hover {
      background-color: #34495e;
      color: #ecf0f1;
    }
    .add-notice-btn i {
      margin-right: 10px;
    }
    /* Notice form styling */
    .notice-form {
      display: none;
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      margin-bottom: 20px;
      border-left: 4px solid #ffcc00;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    .notice-form.active {
      display: block;
    }
    .form-group label {
      color: #2c3e50;
      font-weight: 500;
    }
    .form-control {
      border: 1px solid #ddd;
      border-radius: 4px;
    }
    .form-control:focus {
      border-color: #4093e7;
      box-shadow: none;
    }
    /* Notice card styling */
    .notice-card {
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      margin-bottom: 20px;
      border-left: 4px solid #2c3e50;
      transition: all 0.3s ease;
      height: 100%;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }
    .notice-card:hover {
      border-left-color: #ffcc00;
    }
    .notice-title {
      color: #2c3e50;
      font-size: 1.25rem;
      font-weight: 500;
      margin-bottom: 10px;
    }
    .notice-content {
      color: #34495e;
      margin-bottom: 15px;
      flex-grow: 1;
    }
    .notice-meta {
      color: #7f8c8d;
      font-size: 0.9rem;
      border-top: 1px solid #eee;
      padding-top: 10px;
      margin-bottom: 10px;
    }
    /* Action buttons */
    .notice-actions {
      display: flex;
      gap: 10px;
    }
    .btn-edit, .btn-delete {
      padding: 5px 15px;
      border-radius: 4px;
      border: none;
      display: inline-flex;
      align-items: center;
      transition: all 0.3s ease;
      cursor: pointer;
    }
    .btn-edit {
      background-color: #4093e7;
      color: #ecf0f1;
    }
    .btn-delete {
      background-color: #e74c3c;
      color: #ecf0f1;
    }
    .btn-edit:hover, .btn-delete:hover {
      background-color: #34495e;
    }
    .btn-edit i, .btn-delete i {
      margin-right: 5px;
    }
    /* Success message */
    .success-message {
      background-color: #2ecc71;
      color: #ecf0f1;
      padding: 10px 20px;
      border-radius: 4px;
      margin-bottom: 20px;
      border-left: 4px solid #27ae60;
    }
  </style>
</head>
<body>
  <!-- Include the sidebar and header -->
  @include('nav_aside')

  <!-- Main content container -->
  <div class="content-container">
    <!-- Page header -->
    <div class="row">
      <div class="col-12">
        <div class="page-header">
          <i class="fas fa-newspaper"></i>
          <h1 class="mb-0">News & Notices</h1>
        </div>
      </div>
    </div>

    <!-- Success Message and Add Notice Button -->
    <div class="row">
      <div class="col-12">
        @if (session('success'))
          <div class="success-message">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
          </div>
        @endif
        <button class="add-notice-btn mb-4" id="addNoticeButton">
          <i class="fas fa-plus"></i> Add New Notice
        </button>
      </div>
    </div>

    <!-- Add Notice Form -->
    <div class="row">
      <div class="col-12">
        <div class="notice-form" id="addNoticeForm">
          <form action="{{ route('news.store') }}" method="POST">
            @csrf
            <div class="form-group">
              <label for="title">Title</label>
              <input type="text" class="form-control" name="title" id="title" required>
            </div>
            <div class="form-group">
              <label for="content">Content</label>
              <textarea class="form-control" name="content" id="content" rows="4" required></textarea>
            </div>
            <button type="submit" class="add-notice-btn">
              <i class="fas fa-paper-plane"></i> Publish Notice
            </button>
          </form>
        </div>
      </div>
    </div>

    <!-- Edit Notice Form -->
    <div class="row">
      <div class="col-12">
        <div class="notice-form" id="editNoticeForm">
          <form id="editForm" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" id="editNoticeId">
            <div class="form-group">
              <label for="editTitle">Title</label>
              <input type="text" class="form-control" name="title" id="editTitle" required>
            </div>
            <div class="form-group">
              <label for="editContent">Content</label>
              <textarea class="form-control" name="content" id="editContent" rows="4" required></textarea>
            </div>
            <button type="submit" class="add-notice-btn">
              <i class="fas fa-save"></i> Update Notice
            </button>
          </form>
        </div>
      </div>
    </div>

    <!-- Display Notices in a responsive grid -->
    <div class="row">
      @foreach ($notices as $notice)
        <div class="col-12 col-md-6 col-lg-4 mb-4">
          <div class="notice-card">
            <h3 class="notice-title">{{ $notice->title }}</h3>
            <div class="notice-content">{{ $notice->content }}</div>
            <div class="notice-meta">
              <i class="fas fa-clock"></i> Posted: {{ $notice->created_at->format('M d, Y H:i') }}
              @if($notice->updated_at != $notice->created_at)
                | <i class="fas fa-edit"></i> Updated: {{ $notice->updated_at->format('M d, Y H:i') }}
              @endif
            </div>
            <div class="notice-actions">
              <button class="btn-edit" onclick="openEditForm('{{ $notice->id }}', '{{ addslashes($notice->title) }}', '{{ addslashes($notice->content) }}')">
                <i class="fas fa-edit"></i> Edit
              </button>
              <form action="{{ route('news.destroy', $notice->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-delete">
                  <i class="fas fa-trash-alt"></i> Delete
                </button>
              </form>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>

  <!-- JavaScript for toggling forms -->
  <script>
    const addNoticeButton = document.getElementById('addNoticeButton');
    const addNoticeForm = document.getElementById('addNoticeForm');
    const editNoticeForm = document.getElementById('editNoticeForm');
    const editForm = document.getElementById('editForm');
    const editNoticeId = document.getElementById('editNoticeId');
    const editTitle = document.getElementById('editTitle');
    const editContent = document.getElementById('editContent');

    // Toggle the Add Notice Form
    addNoticeButton.addEventListener('click', () => {
      // Hide the edit form if it's open
      editNoticeForm.classList.remove('active');
      if (addNoticeForm.classList.contains('active')) {
        addNoticeForm.classList.remove('active');
        addNoticeButton.innerHTML = '<i class="fas fa-plus"></i> Add New Notice';
      } else {
        addNoticeForm.classList.add('active');
        addNoticeButton.innerHTML = '<i class="fas fa-minus"></i> Hide Form';
      }
    });

    // Open the Edit Notice Form with pre-filled data
    function openEditForm(id, title, content) {
      // Hide the add notice form if it's open
      addNoticeForm.classList.remove('active');
      addNoticeButton.innerHTML = '<i class="fas fa-plus"></i> Add New Notice';
      // Set the edit form fields
      editNoticeId.value = id;
      editTitle.value = title;
      editContent.value = content;
      // Set the form action URL for updating (ensure a leading slash)
      editForm.action = `/news/${id}`;
      // Show the edit form
      editNoticeForm.classList.add('active');
      // Optionally, scroll into view for better UX
      editNoticeForm.scrollIntoView({ behavior: 'smooth' });
    }
  </script>

  <!-- Bootstrap JS Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
