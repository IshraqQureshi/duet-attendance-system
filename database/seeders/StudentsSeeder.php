<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('students')->insert([
            'first_name' => 'Muhammad',
            'last_name' => 'Ismail',
            'roll_no' => 'D-17-TE-20',
            'section' => 1,
            'batch_id' => 1,
        ]);
    }
}
