<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student News & Notices</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <style>
    body {
      font-family: 'Roboto', sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f5f5f5;
    }
    .content-container {
      padding: 20px;
      transition: margin-left 0.3s ease;
    }
    @media (max-width: 768px) {
      .content-container {
        margin-left: 0;
      }
    }
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
  </style>
</head>
<body>

  <div class="content-container">
    <div class="row">
      <div class="col-12">
        <div class="page-header">
          <i class="fas fa-newspaper"></i>
          <h1 class="mb-0">Student News & Notices</h1>
        </div>
      </div>
    </div>

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
          </div>
        </div>
      @endforeach
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
