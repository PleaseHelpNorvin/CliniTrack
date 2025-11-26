<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Form;

class FormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Form::create([
            'name' => 'Student Profile Form',
            'description' => 'Form for creating student profiles',
            'type' => 'Form',
            'link' => 'http://127.0.0.1:8000/public/student-profile/create',
            'status' => 'active',
            'is_public' => true
        ]);

        Form::create([
            'name' => 'Visit Form',
            'description' => 'Form for creating visit records',
            'type' => 'Form',
            'link' => 'http://127.0.0.1:8000/public/visit/create',
            'status' => 'active',
            'is_public' => true
            
        ]);

        Form::create([
            'name' => 'Medicinal Tracker Form',
            'description' => 'Form for N',
            'type' => 'Form',
            'link' => 'http://127.0.0.1:8000/public/referral_histories',
            'status' => 'active',
            'is_public' => false
        ]);

        
    }
}
