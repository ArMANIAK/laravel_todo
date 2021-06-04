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

    public function store(Request $request) : int
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

    public function update(Request $request, $todo_id)
    {
        $todo = Todo::find($todo_id);
        foreach($request->request as $prop => $value)
        {
            $todo[$prop] = $value;
        }
        $todo->save();
    }

    public function destroy($todo_id)
    {
        $todo = Todo::find($todo_id);
        $todo->delete();
        return redirect()->route('todo.index');
    }

    public function run($todo_id)
    {
        $todo = Todo::find($todo_id);
        $statuses = TodoStatus::all()->pluck('status', 'id')->all();
        if ($todo->start_datetime > date('Y-m-d H:i:s'))
        {
            $todo->status = array_search('deferred', $statuses);
        }
        elseif (isset($todo->end_datetime) && $todo->end_datetime < date('Y-m-d H:i:s')) {
            $todo->status = array_search('cancelled', $statuses);
        }
        else
        {
            $todo->status = array_search('in_progress', $statuses);
        }
        $todo->save();
        return $todo->status;
    }

    public function archive()
    {
        $statuses = TodoStatus::all()->pluck('status', 'id')->filter(function ($value, $key) {
            return $value === 'archived' || $value === 'finished' || $value === 'cancelled';
        })->all();

        $todos = Todo::all();
        
        foreach ($todos as $todo)
        {
            if (array_key_exists($todo->status, $statuses))
            {
                $todo->status = array_search('archived', $statuses);
                $todo->save();
            }
        }
    }
}
