<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('todo_statuses')->insert([
            ['status' => 'draft'],
            ['status' => 'deferred'],
            ['status' => 'cancelled'],
            ['status' => 'in_progress'],
            ['status' => 'finished'],
            ['status' => 'archived']
        ]);
    }
}
