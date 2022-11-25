<?php

namespace Database\Seeders;

use App\Imports\RecordPriceImport;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class RecordPriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Excel::import(new RecordPriceImport, 'record_prices.csv');
    }
}
