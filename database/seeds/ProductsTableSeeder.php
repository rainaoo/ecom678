<?php

use Illuminate\Database\Seeder;
use App\Product;
class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $productRecord=[
          ['id'=>1,'category_id'=>2,'section_id'=>1,'product_name'=>'blue t-shirt','product_code'=>'bt001','product_color'=>'blue',
          'product_price'=>1799,'product_discount'=>10,'product_weight'=>500,'product_video'=>'','main_image'=>'',
          'description'=>'test','wash_care'=>'','fabric'=>'','pattern'=>'','sleeve'=>'','fit'=>'','occasion'=>'',
          'meta_title'=>'','meta_description'=>'','meta_keywords'=>'','is_featured'=>'no','status'=>1],

          ['id'=>2,'category_id'=>2,'section_id'=>1,'product_name'=>'red t-shirt','product_code'=>'rt001','product_color'=>'red',
          'product_price'=>1799,'product_discount'=>10,'product_weight'=>500,'product_video'=>'','main_image'=>'',
          'description'=>'test','wash_care'=>'','fabric'=>'','pattern'=>'','sleeve'=>'','fit'=>'','occasion'=>'',
          'meta_title'=>'','meta_description'=>'','meta_keywords'=>'','is_featured'=>'yes','status'=>1],
        ];

        Product::insert($productRecord);
    }
}
