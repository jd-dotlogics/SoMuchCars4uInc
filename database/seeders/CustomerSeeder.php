<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\State;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends AbstractSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this
            ->getSeedData('users', 'txt')
            ->diff(Customer::query()->pluck('name'))
            ->map(fn($name) => ['name' => $name, 'state_id' => State::first()->id])
            ->each(function($data) {
                Customer::create($data);
            });
    }
}
