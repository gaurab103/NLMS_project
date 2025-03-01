<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .news-container {
            max-width: 800px;
            margin: 0 auto;
        }
        .news-card {
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 5px;
        }
        .no-news {
            color: #666;
            text-align: center;
            font-style: italic;
        }
        .error-message {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="news-container">
        <h1>News</h1>

        @if(session('error'))
            <p class="error-message">{{ session('error') }}</p>
        @endif

        <!-- Display news if available -->
        @if($news->isEmpty())
            <p class="no-news">No news available at the moment.</p>
        @else
            @foreach($news as $item)
                <div class="news-card">
                    <h2>{{ $item->title ?? 'No Title' }}</h2>
                    <p>{{ $item->content ?? 'No content available for this news.' }}</p>
                    <small>Posted on: {{ $item->created_at->format('M d, Y') }}</small>
                </div>
            @endforeach
        @endif
    </div>
</body>
</html>
