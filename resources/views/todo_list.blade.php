<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Todo List</title>

    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
            

            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <table>
                @forelse ($todos as $todo)
                    <tr>
                        <td><span>{{ $todo->title }}</span></td>
                        <td><span>{{ $statuses->where('id', $todo->status)->first()->status }}</span></td>
                        <td><a href="">X</a></td>
                        <td><a href="">Mission completed</a></td>
                        <td><a href="">Mission impossible</a></td>
                    </tr>
                @empty
                    <tr><td colspan="5">Nothing to do</td></tr>
                @endforelse
                </table>
            </div>
            <form action="{{ route('store') }}" method="post">
                <label>What can I do? <input type="text" name="title" pattern="{\w}50" required /></label>
                <label>When should I start? <input type="datetime" name="start_datetime" required /></label>
                <input type="submit" value="Run">
            </form>
        </div>
    </body>
</html>
