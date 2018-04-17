<?php

use Illuminate\Database\Seeder;

class OrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orders')->insert([
        'code' => '01',
        'customer_id' => '2',
        'emission' => '2018-04-15',
        'total_order' => '100'
        ]);
        DB::table('order_product')->insert([
        'order_id' => '1',
        'product_id' => '1',
        'quantity' => '1',
        'discount' => '0',
        'total' => '50'
        ]);
       DB::table('order_product')->insert([
        'order_id' => '1',
        'product_id' => '2',
        'quantity' => '1',
        'discount' => '0',
        'total' => '50'
        ]);

       DB::table('orders')->insert([
        'code' => '02',
        'customer_id' => '3',
        'emission' => '2018-04-15',
        'total_order' => '50'
        ]);
        DB::table('order_product')->insert([
        'order_id' => '2',
        'product_id' => '4',
        'quantity' => '1',
        'discount' => '0',
        'total' => '50'
        ]);

       DB::table('orders')->insert([
        'code' => '03',
        'customer_id' => '10',
        'emission' => '2018-04-15',
        'total_order' => '50'
        ]);
        DB::table('order_product')->insert([
        'order_id' => '3',
        'product_id' => '1',
        'quantity' => '1',
        'discount' => '0',
        'total' => '50'
        ]);
    }
}
