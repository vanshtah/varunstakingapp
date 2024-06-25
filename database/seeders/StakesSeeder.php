<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StakesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('stakes')->insert([
            'amount' => '70',
            'userId' => '1',
            'type' => 'BTC',
            'created_at' => '2023-03-21 09:24:00'
        ]);

        DB::table('stakes')->insert(
            [
                'amount' => '36',
                'userId' => '1',
                'type' => 'BTC',
                'created_at' => '2023-06-03 19:47:00'
            ]
        );

        DB::table('stakes')->insert(
            [
                'amount' => '24',
                'userId' => '1',
                'type' => 'BTC',
                'created_at' => '2023-10-07 02:12:00'
            ]
        );

        DB::table('stakes')->insert(
            [
                'amount' => '8',
                'userId' => '1',
                'type' => 'BTC',
                'created_at' => '2024-05-22 18:38:00'
            ]
        );

        DB::table('stakes')->insert(
            [
                'amount' => '6',
                'userId' => '1',
                'type' => 'BTC',
                'created_at' => '2024-06-17 22:52:00'
            ]
        );

        DB::table('stakes')->insert(
            [
                'amount' => '78000',
                'userId' => '1',
                'type' => 'SOL',
                'created_at' => '2023-04-13 13:10:00'
            ]
        );

        DB::table('stakes')->insert(
            [
                'amount' => '63000',
                'userId' => '1',
                'type' => 'SOL',
                'created_at' => '2023-07-28 17:52:00'
            ]
        );

        DB::table('stakes')->insert(
            [
                'amount' => '318.47',
                'userId' => '1',
                'type' => 'SOL',
                'created_at' => '2024-05-22 18:02:00'
            ]
        );

        DB::table('stakes')->insert(
            [
                'amount' => '769.20',
                'userId' => '1',
                'type' => 'SOL',
                'created_at' => '2024-06-21 19:42:00'
            ]
        );
    }
}
