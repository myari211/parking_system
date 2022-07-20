<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Ramsey\Uuid\Uuid;
use Carbon\Carbon;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');


        for($i = 0; $i < 100; $i++) {
            DB::table('park_systems')
                ->insert([
                    'vehicle_number' => "B"." ".$faker->randomNumber(4, true)." ".$faker->lexify('????'),
                    'gate_in' => $faker->date()." ".$faker->time(),
                    'gate_out' => $faker->date()." ".$faker->time(),
                    'unique_key' => Uuid::uuid4()->getHex(),
                    'petugas_id' => 2,
                    "created_at" => carbon::now(),
                    "updated_at" => Carbon::now(),
                ]);
        }
    }
}
