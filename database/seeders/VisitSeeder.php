<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Visit;
use App\Models\Student;
use App\Models\User;


class VisitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Make sure you have some students and nurses first
        $students = Student::all();
        $nurses   = User::all(); // assuming nurses are users

        if ($students->isEmpty() || $nurses->isEmpty()) {
            $this->command->info('No students or nurses found. Please seed them first.');
            return;
        }

        $faker = \Faker\Factory::create();

        $statusOptions = ['treated', 'referred', 'sent_home'];
        $reasonOptions = ['checkup', 'sick', 'injury', 'asthma', 'other'];

        foreach (range(1, 50) as $i) {
            $reason = $faker->randomElement($reasonOptions);
            $status = $faker->randomElement($statusOptions);

            Visit::create([
                'student_id'     => $students->random()->id,
                'nurse_id'       => $nurses->random()->id,
                'visited_at'     => $faker->dateTimeBetween('-1 month', 'now'),
                'reason'         => $reason,
                'other_reason'   => $reason === 'other' ? $faker->sentence() : null,
                'temperature'    => $faker->numberBetween(36, 40),
                'blood_pressure' => $faker->numberBetween(90, 140) . '/' . $faker->numberBetween(60, 90),
                'pulse_rate'     => $faker->numberBetween(60, 120),
                'treatment_given'=> $faker->optional()->sentence(),
                'nurse_notes'    => $faker->optional()->paragraph(),
                'status'         => $status,
                'referred_to'    => $status === 'referred' ? $faker->name() : null,
                'emergency'      => $faker->boolean(10), // 10% chance
            ]);
        }
    }
}
