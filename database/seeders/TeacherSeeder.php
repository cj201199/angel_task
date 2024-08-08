<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Teacher::create([
            'teacher_name' => 'John doe',
        ]);
        Teacher::create(['teacher_name' => 'Maya']);
        Teacher::create(['teacher_name' => 'Ramesh']);
        Teacher::create(['teacher_name' => 'Pooja']);
    }
}
