<?php

use Illuminate\Database\Seeder;
use App\State;
class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('states')->truncate();

        $data = [
            [
                'state_en_name' => 'Northern Borders',
                'state_ar_name' => 'الحدود الشمالية',
            ],
            [
                'state_en_name' => 'Al Jawf',
                'state_ar_name' => 'الجوف',
            ],
            [
                'state_en_name' => 'Tabuk',
                'state_ar_name' => 'تبوك',
            ],
            [
                'state_en_name' => 'Hail',
                'state_ar_name' => 'حائل',
            ],
            [
                'state_en_name' => 'Al Qassim',
                'state_ar_name' => 'القصيم',
            ],
            [
                'state_en_name' => 'Ar Riyadh',
                'state_ar_name' => 'الرياض',
            ],
            [
                'state_en_name' => 'Al Madinah',
                'state_ar_name' => 'المدينة المنورة',
            ],
            [
                'state_en_name' => 'Asir',
                'state_ar_name' => 'عسير',
            ],
            [
                'state_en_name' => 'Al Baha',
                'state_ar_name' => 'الباحة',
            ],
            [
                'state_en_name' => 'Jazan',
                'state_ar_name' => 'جازان',
            ],
            [
                'state_en_name' => 'Makkah',
                'state_ar_name' => 'مكة المكرمة',
            ],
            [
                'state_en_name' => 'Najran',
                'state_ar_name' => 'نجران',
            ],
            [
                'state_en_name' => 'Eastern',
                'state_ar_name' => 'الشرقية',
            ],
        ];

        State::insert($data);
    }
}
