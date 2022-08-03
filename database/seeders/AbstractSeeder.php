<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

abstract class AbstractSeeder extends Seeder
{
    protected function getSeedData($name, $type)
    {
        $data = File::get(__DIR__ . "/data/{$name}.{$type}");

        if ($type == 'json') {
            $data = json_decode($data, true);
        } else {
            $data = array_filter(explode("\n", $data));
        }

        return collect($data);
    }
}
