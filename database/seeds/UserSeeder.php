<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *  php artisan db:seed
     * @return void
     */
    public function run()
    {
        //
        $arr = [];
        for ($i=0; $i < 50; $i++) { 
            $tmp = [];
            $tmp['name'] = 'admin'.($i+1);
            $tmp['email'] = 'admin'.($i+1).'@qq.com';
            $tmp['password'] = Hash::make('admin'.($i+1));
            $tmp['remember_token'] = str_random(50);
            $tmp['profile'] = 'http://class1.com/uploads/2019-04-19/20190419054120919.jpg';
            $tmp['created_at'] = date('Y-m-d H:i:s');
            $tmp['updated_at'] = date('Y-m-d H:i:s');
            $arr[] = $tmp;
        }
        DB::table('users')->insert($arr);
    }
}
