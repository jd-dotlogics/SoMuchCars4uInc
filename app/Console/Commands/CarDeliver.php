<?php

namespace App\Console\Commands;

use App\Models\Car;
use App\Models\Customer;
use Illuminate\Console\Command;

class CarDeliver extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'car:deliver';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deliver the car to the customer.';

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

        $model_value = $this->ask('Model value or Id?');
        $modelQuery = $car->models();

        if(is_numeric($model_value)){
            $modelQuery->whereId($model_value);
        }else{
            $modelQuery->whereValue($model_value);
        }
        
        $model = $modelQuery->first();

        if(! $model) {
            $this->error('The model does not exist.');
            return;
        }

        $customer_name = $this->ask('Customer name or Id?');

        $query = Customer::query();

        if(is_numeric($customer_name)){
            $query->whereId($customer_name);
        }else{
            $query->whereValue($customer_name);
        }
        
        $customer = $query->first();

        if(! $customer) {
            $this->error('Customer does not exist.');
            return;
        }

        $model->state_id = $customer->state_id;
        $model->save();

        $this->line('Car delivered successfully.');
    }
}
