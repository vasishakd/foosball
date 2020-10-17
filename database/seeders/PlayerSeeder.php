<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlayerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            'Денис Васишак',
            'Миша Радионов',
            'Даниил Русаков',
            'Вова Рубинский',
            'Слава Козицын',
            'Сергей Злобин',
            'Тамара Зыкова',
            'Вадим Куксовский',
            'Алексей Смирнов',
            'Ирина Старцева',
            'Анна Порцева',
        ];

        foreach ($names as $name) {
            DB::table('players')->insert([
                'name' => $name,
            ]);
        }
    }
}
