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

        $blockchainApi = 'http://172.26.140.53:3000/api/register';

        sleep(1);
        $tps1 = Tps::find('TPS1');
        $tps2 = Tps::find('TPS2');

        echo "🔍 TPS1 ID: " . var_export($tps1?->id, true) . "\n";
        echo "🔍 TPS2 ID: " . var_export($tps2?->id, true) . "\n";

        // Voters for TPS1
        for ($i = 1; $i <= 3; $i++) {
            $nik = '100000000000000' . $i;
            $name = "Voter TPS001 - $i";

            $user = User::create([
                'name' => $name,
                'nik' => $nik,
                'password' => Hash::make('voter123'),
                'role' => 'voter',
                'tps_id' => $tps1->id,
            ]);

            $payload = [
                'tpsId' => $tps1->id,
                'userId' => $nik,
                'username' => $name,
            ];

            echo "📤 Registering TPS1 voter: ";
            print_r($payload);

            try {
                $res = Http::post($blockchainApi, $payload);

                if ($res->successful()) {
                    echo "✅ Success: {$nik} added to blockchain\n";
                } else {
                    echo "❌ Failed: HTTP {$res->status()} - {$res->body()}\n";
                }
            } catch (\Exception $e) {
                echo "🔥 Exception while adding user {$nik}: " . $e->getMessage() . "\n";
            }
        }

        // Voters for TPS2
        for ($i = 1; $i <= 2; $i++) {
            $nik = '200000000000000' . $i;
            $name = "Voter TPS002 - $i";

            $user = User::create([
                'name' => $name,
                'nik' => $nik,
                'password' => Hash::make('voter123'),
                'role' => 'voter',
                'tps_id' => $tps2->id,
            ]);

            $payload = [
                'tpsId' => $tps2->id,
                'userId' => $nik,
                'username' => $name,
            ];

            echo "📤 Registering TPS2 voter: ";
            print_r($payload);

            try {
                $res = Http::post($blockchainApi, $payload);

                if ($res->successful()) {
                    echo "✅ Success: {$nik} added to blockchain\n";
                } else {
                    echo "❌ Failed: HTTP {$res->status()} - {$res->body()}\n";
                }
            } catch (\Exception $e) {
                echo "🔥 Exception while adding user {$nik}: " . $e->getMessage() . "\n";
            }
        }
    }
}
