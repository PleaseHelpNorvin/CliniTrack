<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Student;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Carbon\Carbon;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 50; $i++) { // Create 50 students
            $gradeLevels = [11, 12, 21, 22, 23, 24];
            $gradeLevel = $faker->randomElement($gradeLevels);

            Student::create([
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'student_number' => 'S' . $faker->unique()->numberBetween(1000, 9999),
                'grade_level' => $gradeLevel,
                'grade_level_other' => null,
                'section' => $faker->randomElement(['A', 'B', 'C', null]),
                'dob' => $faker->dateTimeBetween('-20 years', '-10 years')->format('Y-m-d'),
                'contact_number' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'address' => $faker->address,
                'photo' => null, // or fake path: 'students/photos/default.png'
                'allergies' => $faker->optional()->words(2, true),
                'medical_notes' => $faker->optional()->sentence,
            ]);
        }
    }

}
