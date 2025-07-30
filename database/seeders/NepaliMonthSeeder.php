<?php

namespace Database\Seeders;

use App\Models\NepaliMonth;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NepaliMonthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    
    public function run(): void
    {
        DB::table('nepali_months')->delete();

        $months = [
            ['id' => 1,  'slug' => 'Baisakh',  'name' => 'बैशाख'],
            ['id' => 2,  'slug' => 'Jestha',   'name' => 'जेठ'],
            ['id' => 3,  'slug' => 'Ashadh',   'name' => 'असार'],
            ['id' => 4,  'slug' => 'Shrawan',  'name' => 'श्रावण'],
            ['id' => 5,  'slug' => 'Bhadra',   'name' => 'भदौ'],
            ['id' => 6,  'slug' => 'Ashwin',   'name' => 'आश्विन'],
            ['id' => 7,  'slug' => 'Kartik',   'name' => 'कार्तिक'],
            ['id' => 8,  'slug' => 'Mangsir',  'name' => 'मंसिर'],
            ['id' => 9,  'slug' => 'Poush',    'name' => 'पुष'],
            ['id' => 10, 'slug' => 'Magh',     'name' => 'माघ'],
            ['id' => 11, 'slug' => 'Falgun',   'name' => 'फाल्गुण'],
            ['id' => 12, 'slug' => 'Chaitra',  'name' => 'चैत्र'],
        ];

        NepaliMonth::insert($months);
    }
}
