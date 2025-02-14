<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingDataBaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::setMany([
            'default_locale'=>'ar',
            'default_timezone'=>'Africa/Cairo',
            'reviews_enabled'=>true,
            'auto_approve_reviews'=>true,
            'default_currency'=>'USD',
            'supported_currencies'=>['USD','LE','SAR'],
            'store_email'=>'sameeh@gmail.com',
            'search_engine'=>'mysql',


            'local_shipping_cost'=>0,
            'outer_shipping_cost'=>0,
            'free_shipping_cost'=>0,
            'outer_shipping_cost'=>0,

            'translatable'=>[
            'project name '=>'متجر موحا  ',
            'free_shipping_label'=>' التوصيل مجاني',
            'local_label'=>' التوصيل الداخلي',
            'outer_label'=>'التوصيل الخارجي',
            ],

        ]);
    }
}
