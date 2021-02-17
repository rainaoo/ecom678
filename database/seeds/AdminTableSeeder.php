<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('admins')->delete();
        $adminRecords=[
            [ 'id'=>1,'name'=>'admin','type'=>'admin','mobile'=>'12345','email'=>'admin@admin.com',
            'password'=>Hash::make('000')
            ,'image'=>'','status' =>1 ],

            [ 'id'=>2,'name'=>'admin','type'=>'admin','mobile'=>'12345','email'=>'admin@a.com',
            'password'=>Hash::make('123')
            ,'image'=>'','status' =>1 ],


            [ 'id'=>3,'name'=>'raina','type'=>'admin','mobile'=>'12345','email'=>'raina@admin.com',
            'password'=>Hash::make('000')
            ,'image'=>'','status' =>1 ],

            [ 'id'=>4,'name'=>'raina','type'=>'admin','mobile'=>'12345','email'=>'raina000@admin.com',
            'password'=>Hash::make('000')
            ,'image'=>'','status' =>1 ],
        ];


        DB::table('admins')->insert($adminRecords);

       /* foreach($adminRecords as $key => $record){
            \App\Admin::create($record);
        }*/
    }
}
