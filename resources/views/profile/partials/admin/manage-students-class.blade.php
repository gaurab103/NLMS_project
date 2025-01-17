@extends('layouts.app')

@section('content')
<div class="class-container">
    <h2>Manage Students by Class</h2>
    <div class="grid-container">
        @foreach(range(1, 10) as $class)
            <div class="grid-item" onclick="openClass({{ $class }})">Class {{ $class }}</div>
        @endforeach
    </div>
</div>
@endsection

@section('styles')
<style>
    .class-container {
        text-align: center;
        margin: 20px;
    }
    .grid-container {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 20px;
        max-width: 1000px;
        margin: auto;
    }
    .grid-item {
        background-color: rgba(128, 128, 128, 0.8);
        color: white;
        padding: 20px;
        border-radius: 8px;
        cursor: pointer;
        transition: transform 0.2s;
    }
    .grid-item:hover {
        transform: scale(1.05);
    }
</style>
@endsection

@section('scripts')
<script>
    function openClass(classNumber) {
        // Redirect to the specific class manage page
        window.location.href = '/manage-students/class/' + classNumber;
    }
</script>
@endsection
