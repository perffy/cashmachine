<?php

namespace Database\Seeders;

use App\Models\Transaction;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // Transaction::factory()->count(5)->create();
        Transaction::factory()->count(5)->cash()->create();
        Transaction::factory()->count(5)->creditcard()->create();
        Transaction::factory()->count(5)->bankTransfer()->create();
    }
}
