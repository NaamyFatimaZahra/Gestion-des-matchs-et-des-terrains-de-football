<?php

    namespace Database\Seeders;

    use App\Models\User;
    use Illuminate\Database\Console\Seeds\WithoutModelEvents;
    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\Hash;

    class UserSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         */
        public function run(): void
        {
            $users = [
                [
                    'name' => 'fatima',
                    'email' => 'fatima@gmail.com',
                    'password' => Hash::make('password'),
                    'city' => 'New York',
                    'profile_picture' => 'path/to/profile_picture1.jpg',
                    'bio' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                    'phone_number' => '1234567890',
                    'role_id' => 1,
                    'status' => 'active',
                ],
                [
                    'name' => 'Jane Smith',
                    'email' => 'jane@example.com',
                    'password' => Hash::make('password'),
                    'city' => 'London',
                    'profile_picture' => 'path/to/profile_picture2.jpg',
                    'bio' => 'Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                    'phone_number' => '9876543210',
                    'role_id' => 2,
                    'status' => 'pending',
                ],
                [
                    'name' => 'Mike Johnson',
                    'email' => 'mike@example.com',
                    'password' => Hash::make('password'),
                    'city' => 'Paris',
                    'profile_picture' => 'path/to/profile_picture3.jpg',
                    'bio' => 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                    'phone_number' => '5555555555',
                    'role_id' => 3,
                    'status' => 'active',
                ],
            ];

            foreach ($users as $userData) {
                User::create($userData);
            }
        }
    }
