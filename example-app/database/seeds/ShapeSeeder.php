<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShapeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ive created a multidimensional array to programmatically create the example shapes detailed in the task.
        // this allows me to modify the example shapes easily without explicitly defining the sql that would create them.
        $seedKey = [
            'red' => [
                'square' => 5,
                'triangle' => 2,
                'circle' => 1
            ],
            'blue' => [
                'square' => 5,
                'triangle' => 1,
                'pentagon' => 2
            ],
            'green' => [
                'square' => 2,
                'circle' => 3,
                'hexagon' => 3
            ],
            'yellow' => [
                'square' => 1,
                'triangle' => 1,
                'circle' => 2,
                'pentagon' => 2,
                'hexagon' => 2,
            ],
        ];

        // first stage of this loop is to determine what colour we're creating.
        foreach ( $seedKey as $colour => $types)
        {
            // second stage of this loop is to understand the type of shape we are creating
            foreach ($types as $type => $qty)
            {
                // and finally the for loop is designed to create the quantity of that colour/shape variant we need.
                for ($x = 1; $x <= $qty; $x++) {
                    DB::table('shapes')->insert([
                        'colour' => $colour,
                        'type' => $type,
                    ]);
                }
            }
        }
    }
}
