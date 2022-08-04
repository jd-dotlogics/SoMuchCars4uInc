<?php

namespace App\Console\Commands;

use App\Models\Car;
use Illuminate\Console\Command;

class AddCar extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:car';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add new car';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $title = $this->ask('Title?');
        $value = $this->ask('Value?');

        if(Car::query()->whereTitle($title)->whereValue($value)->count()){
            $this->error('Car already exist.');
            return;
        }

        Car::create(compact('title', 'value'));

        $this->line('Car created successfully.');
    }
}
