<?php

use Illuminate\Database\Seeder;
use App\Products;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 100000) as $index)  {
            DB::table('products')->insert([
                'name' => $faker->name,
                'quantity' => $faker->numberBetween(1,10),
                'price' => $faker->numberBetween($min = 500, $max = 8000),
                'status'=> $faker->numberBetween(0,1)
            ]);
        }

    }
}
