<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Tps;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin
        User::create([
            'name' => 'Admin',
            'nik' => '0000000000000000',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'tps_id' => null,
        ]);

        $blockchainApi = 'http://localhost:3000/api/register';

        $tps1 = Tps::find('TPS1');
        $tps2 = Tps::find('TPS2');

        // Voters for TPS1
        for ($i = 1; $i <= 3; $i++) {
            $nik = '100000000000000' . $i;
            $name = "Voter TPS001 - $i";

            User::create([
                'name' => $name,
                'nik' => $nik,
                'password' => Hash::make('voter123'),
                'role' => 'voter',
                'tps_id' => $tps1->id,
            ]);

            Http::post($blockchainApi, [
                'tpsId' => $tps1->id,
                'userId' => $nik,
                'username' => $name,
            ]);
        }

        // Voters for TPS2
        for ($i = 1; $i <= 2; $i++) {
            $nik = '200000000000000' . $i;
            $name = "Voter TPS002 - $i";

            User::create([
                'name' => $name,
                'nik' => $nik,
                'password' => Hash::make('voter123'),
                'role' => 'voter',
                'tps_id' => $tps2->id,
            ]);

            Http::post($blockchainApi, [
                'tpsId' => $tps2->id,
                'userId' => $nik,
                'username' => $name,
            ]);
        }
    }
}
