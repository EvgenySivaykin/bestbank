<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Evgeny',
            'email' => 'Evgeny@gmail.com',
            'password' => Hash::make('125'),
        ]);
        DB::table('users')->insert([
            'name' => 'Jonas',
            'email' => 'Jonas@gmail.com',
            'password' => Hash::make('413'),
        ]);
        DB::table('customers')->insert([
            'fname' => 'Jonas',
            'lname' => 'Jonaitis',
            'code' => '37811068925',
            'account_code' => 'LT44-7044-0300-0552-8673',
            'balance' => '225.50',
        ]);
        DB::table('customers')->insert([
            'fname' => 'Viktorija',
            'lname' => 'Armonienė',
            'code' => '47206121492',
            'account_code' => 'LT33-7022-0100-0789-1828',
            'balance' => '355.70',
        ]);
        DB::table('customers')->insert([
            'fname' => 'Petras',
            'lname' => 'Bebraitis',
            'code' => '38505087711',
            'account_code' => 'LT22-7033-0100-0987-5274',
            'balance' => '225.50',
        ]);
    }
}

// public function up()
//     {
//         Schema::create('customers', function (Blueprint $table) {
//             $table->id();
//             $table->string('fname', 100);
//             $table->string('lname', 100);
//             $table->string('code', 11);
//             $table->string('account_code', 24);
//             $table->decimal('balance', 8, 2)->unsigned();
//             $table->timestamps();
//         });
//     }