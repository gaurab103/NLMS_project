<nav class="bg-gray-800 p-4 text-white">
    <div class="container mx-auto flex justify-between items-center">
        <!-- Logo -->
        <a href="{{ route('home') }}" class="text-xl font-bold">LMS System</a>

        <!-- Navigation Links -->
        <div class="space-x-4">
            <a href="{{ route('news') }}" class="hover:underline">News</a>
            <a href="{{ route('attendance') }}" class="hover:underline">Attendance</a>
            <a href="{{ route('students') }}" class="hover:underline">Students</a>
            <a href="{{ route('teachers') }}" class="hover:underline">Teachers</a>
        </div>

        <!-- Authentication Links -->
        <div class="space-x-4">
            @guest
                <a href="{{ route('admin.login') }}" class="hover:underline">Admin Login</a>
                <a href="{{ route('teacher.login') }}" class="hover:underline">Teacher Login</a>
                <a href="{{ route('student.login') }}" class="hover:underline">Student Login</a>
            @else
                <span class="font-semibold">Welcome, {{ Auth::user()->name }}</span>

                <!-- Dashboard Link (based on user type) -->
                @if(auth()->guard('admin')->check())
                    <a href="{{ route('admin.dashboard') }}" class="hover:underline">Dashboard</a>
                @elseif(auth()->guard('teacher')->check())
                    <a href="{{ route('teacher.dashboard') }}" class="hover:underline">Teacher Portal</a>
                @elseif(auth()->guard('student')->check())
                    <a href="{{ route('student.dashboard') }}" class="hover:underline">Student Portal</a>
                @endif

                <!-- Logout Form -->
                <form action="{{ route('admin.logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="hover:underline">Logout</button>
                </form>
            @endguest
        </div>
    </div>
</nav>
