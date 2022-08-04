<?php

namespace App\Console\Commands;

use App\Models\Car;
use Illuminate\Console\Command;

class AddCarModel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:car:model';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add new car model';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $car_value = $this->ask('Car value or Id?');

        $carQuery = Car::whereNull('parent_id');

        if(is_numeric($car_value)){
            $carQuery->whereId($car_value);
        }else{
            $carQuery->whereValue($car_value);
        }
        
        $car = $carQuery->first();

        if(! $car) {
            $this->error('Car does not exist.');
            return;
        }

        $title = $this->ask('Model title?');
        $value = $this->ask('Model value?');

        $parent_id = $car->id;

        if(Car::query()->whereParentId($parent_id)->whereTitle($title)->whereValue($value)->count()){
            $this->error('Car model already exist agains this car.');
            return;
        }

        Car::create(compact('parent_id', 'title', 'value'));

        $this->line('Car model created successfully.');
    }
}
