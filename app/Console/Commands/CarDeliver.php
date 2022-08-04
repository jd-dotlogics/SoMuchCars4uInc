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
        $car = Car::whereNull('parent_id')->findByFieldOrId($car_value, 'value');
        
        if(! $car) {
            $this->error('Car does not exist.');
            return;
        }

        $model_value = $this->ask('Model value or Id?');
        $model = $car->models()->findByFieldOrId($model_value, 'value');

        if(! $model) {
            $this->error('The model does not exist.');
            return;
        }

        $customer_name = $this->ask('Customer name or Id?');
        $customer = Customer::findByFieldOrId($customer_name, 'name');

        if(! $customer) {
            $this->error('Customer does not exist.');
            return;
        }

        $model->state_id = $customer->state_id;
        $model->save();

        $this->line('Car delivered successfully.');
    }
}
