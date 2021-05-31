<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Todo;

class TodoController extends Controller
{
    //
    public function index()
    {
        echo 'Index controller';
        foreach(Todo::all() as $todo)
        {
            echo '<pre>';
            print_r($todo->title);
            echo '</pre>';
        }
        
    }
}
