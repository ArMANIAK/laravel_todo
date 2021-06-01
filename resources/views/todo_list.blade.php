<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Todo List</title>

    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('/home') }}" class="text-sm text-gray-700 underline">Home</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                @forelse ($todos as $todo)
                    <li>
                        <span>{{ $todo->title }}</span>
                        <span>{{ $statuses->where('id', $todo->status)->first()->status }}</span>
                        <a href="">X</a>
                        <a href="">Mission completed</a>
                        <a href="">Mission impossible</a>
                    </li>
                @empty
                    <p>Nothing to do</p>
                @endforelse
            </div>
            <form action="{{ route('createTodo') }}" method="post">
                <label>What can I do? <input type="text" name="title" pattern="{\w}50" required /></label>
                <label>When should I start? <input type="datetime" name="start_datetime" required /></label>
                <input type="submit" value="Run">
            </form>
        </div>
    </body>
</html>