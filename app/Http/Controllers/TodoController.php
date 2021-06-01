<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Models\Todo;
use App\Models\TodoStatus;

class TodoController extends Controller
{
    use ValidatesRequests;
    
    public function index()
    {
        return view('todo_list', [
            'todos' => Todo::all()->filter(function($value)
            {
                return $value->status !== TodoStatus::where('status', 'archived')->first()->id;
            }),
            'statuses' => TodoStatus::all()]);
    }

    public function createTodoItem(Request $request) : int
    {
        $this->validate($request, [
            'title' => 'required',
            'start_datetime' => 'required'
        ]);

        $todo = new Todo();
        $todo->title = $request->input('title');
        $todo->status = $request->input('status') ? $request->input('status') : 1;
        $todo->start_datetime = $request->input('start_datetime');
        $todo->end_datetime = $request->input('end_datetime');
        $todo->save();
        return $todo->id;
    }
}
