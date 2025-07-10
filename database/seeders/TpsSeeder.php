<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tps;
use Illuminate\Support\Facades\Http;

class TpsSeeder extends Seeder
{
    public function run()
    {
        $tpsList = [
            [
                'id' => 'TPS1',
                'name' => 'TPS 001',
                'address' => 'Kelurahan A',
                'max_voters' => 100,
            ],
            [
                'id' => 'TPS2',
                'name' => 'TPS 002',
                'address' => 'Kelurahan B',
                'max_voters' => 80,
            ],
        ];

        foreach ($tpsList as $tps) {
            Tps::create([
                'id' => $tps['id'],
                'name' => $tps['name'],
                'address' => $tps['address'],
                'max_voters' => $tps['max_voters'],
            ]);

            dump([
                'id' => $tps['id'],
                'name' => $tps['name'],
                'totalVoters' => $tps['max_voters'],
            ]);


            
            try {
                Http::post('http://172.26.140.53:3000/api/tps', [
                    'id' => $tps['id'],
                    'name' => $tps['name'],
                    'totalVoters' => $tps['max_voters'],
                ]);
            } catch (\Exception $e) {
                echo "Failed to add TPS to blockchain: {$tps['id']} - " . $e->getMessage() . PHP_EOL;
            }
        }
    }
}
