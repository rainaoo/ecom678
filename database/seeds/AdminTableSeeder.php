<?php

use Illuminate\Database\Seeder;

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
            'password'=>'$2y$10$U2eVpn0hSXNC3DZmC9vn8uMwb6OH31AVA6lT9xt8zaUCX/upFk.kq
            ','image'=>'','status' =>1 ],

            [ 'id'=>2,'name'=>'admin','type'=>'admin','mobile'=>'12345','email'=>'admin@a.com',
            'password'=>'$2y$10$U2eVpn0hSXNC3DZmC9vn8uMwb6OH31AVA6lT9xt8zaUCX/upFk.kq
            ','image'=>'','status' =>1 ],


            [ 'id'=>3,'name'=>'raina','type'=>'admin','mobile'=>'12345','email'=>'raina@admin.com',
            'password'=>'$2y$10$XIZ3cYICTvHJr/G0zlZKn.lOTDRrzqCK5dli2geyjvNfC23gm4KOy
            ','image'=>'','status' =>1 ],
        ];


        DB::table('admins')->insert($adminRecords);

       /* foreach($adminRecords as $key => $record){
            \App\Admin::create($record);
        }*/
    }
}
