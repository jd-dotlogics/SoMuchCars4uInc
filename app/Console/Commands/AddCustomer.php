<?php

namespace App\Console\Commands;

use App\Models\Customer;
use App\Models\State;
use Illuminate\Console\Command;

class AddCustomer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:customer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add new customer';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = $this->ask('What is customer name?');

        if(Customer::query()->whereName($name)->count()){
            $this->error('Customer already exist.');
            return;
        }

        $states = State::pluck('id', 'code');
        $state = $this->choice('State?', $states->keys()->toArray());

        Customer::create([
            'name' => $name,
            'state_id' => $states[$state],
        ]);

        $this->line('Customer created successfully.');
    }
}
