<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRecords = [
        	['id'=>1,'name'=>'Super Admin','type'=>'superadmin','vendor_id'=>0,'mobile'=>'01676410301','email'=>'super@gmail.com','password'=>'$2a$12$EOY6aQWWBuPfaGXTwb4HG.Vov/SAGZEBoIQ0qv04Zz6EGDQA7PzaK','image'=>'','status'=>1],
        ];
        Admin::insert($adminRecords);
    }
}
