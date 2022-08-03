<?php

namespace Database\Seeders;

use App\Models\Car;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarSeeder extends AbstractSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this
            ->getSeedData('cars', 'json')
            ->each(function($car){
                $models = $car['models'] ?? [];
                unset($car['models']);
                $car = Car::query()->firstOrCreate($car);
                $car_id = $car->id;

                foreach ($models as $model) {
                    $model['parent_id'] = $car_id;
                    Car::firstOrCreate($model);
                }
            });
    }
}
