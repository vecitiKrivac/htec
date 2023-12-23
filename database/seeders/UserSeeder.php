<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = $this->getGeneralData();
        $users = $this->getUserSpecificData();

        foreach ($users as $user) {
            $salt = Str::random(16);

            User::create([
                'first_name' => $user['first_name'],
                'last_name' => $data['last_name'],
                'username' => $user['username'],
                'password' => Hash::make($data['password'] . $salt),
                'salt' => $salt,
                'admin' => $user['admin']
            ]);
        }
    }

    private function getGeneralData()
    {
        return [
            'last_name' => 'Userovic',
            'password' => 'test1234'
        ];
    }

    private function getUserSpecificData()
    {
        return [
            0 => ['first_name' => 'Admin', 'username' => 'admin', 'admin' => 1],
            1 => ['first_name' => 'Regular', 'username' => 'regular', 'admin' => 0]
        ];
    }
}
