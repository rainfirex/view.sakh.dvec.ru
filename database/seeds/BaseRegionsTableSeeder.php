<?php

use Illuminate\Database\Seeder;
//use \Illuminate\Support\Facades\DB;

class BaseRegionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('base_regions')->insert([
            [
                'title' => 'Южно-Сахалинск',
                'asuse_name' => 'ASUSE',
                'omnius_link' => '2',
                'asuse_code_dep'=> '1330',
                'omnius_division' => '2',
                'asuse_alias' => 'world',
                'description' => 'Южно-Сахалинск',
                'id_tns_name' => '1'
            ], [
                'title' => 'Анива',
                'asuse_name' => 'ANIVA',
                'omnius_link' => '4',
                'asuse_code_dep'=> '131483',
                'omnius_division' => '2',
                'asuse_alias' => 'world',
                'description' => 'Анива',
                'id_tns_name' => '2'
            ], [
                'title' => 'Долинск',
                'asuse_name' => 'DOL',
                'omnius_link' => '5',
                'asuse_code_dep'=> '57034',
                'omnius_division' => '2',
                'asuse_alias' => 'world',
                'description' => 'Долинск',
                'id_tns_name' => '3'
            ], [
                'title' => 'Корсаков',
                'asuse_name' => 'kors',
                'omnius_link' => '6',
                'asuse_code_dep'=> '57030',
                'omnius_division' => '2',
                'asuse_alias' => 'world',
                'description' => 'Корсаков',
                'id_tns_name' => '4'
            ], [
                'title' => 'Холмск',
                'asuse_name' => 'KH',
                'omnius_link' => '1',
                'asuse_code_dep'=> '18326',
                'omnius_division' => '1',
                'asuse_alias' => 'world',
                'description' => 'Холмск',
                'id_tns_name' => '5'
            ], [
                'title' => 'Невельск',
                'asuse_name' => 'nev',
                'omnius_link' => '8',
                'asuse_code_dep'=> '100087361',
                'omnius_division' => '2',
                'asuse_alias' => 'world',
                'description' => 'Невельск',
                'id_tns_name' => '6'
            ], [
                'title' => 'Поронайск',
                'asuse_name' => 'por',
                'omnius_link' => '9',
                'asuse_code_dep'=> '1331',
                'omnius_division' => '2',
                'asuse_alias' => 'world',
                'description' => 'Поронайск',
                'id_tns_name' => '7'
            ], [
                'title' => 'Смирных',
                'asuse_name' => 'sm',
                'omnius_link' => '10',
                'asuse_code_dep'=> '30173700',
                'omnius_division' => '2',
                'asuse_alias' => 'world',
                'description' => 'Смирных',
                'id_tns_name' => '8'
            ], [
                'title' => 'Макаров',
                'asuse_name' => 'mak',
                'omnius_link' => '7',
                'asuse_code_dep'=> '30190207',
                'omnius_division' => '2',
                'asuse_alias' => 'world',
                'description' => 'Макаров',
                'id_tns_name' => '9'
            ] ,[
                'title' => 'Углегорск',
                'asuse_name' => 'ugl',
                'omnius_link' => '13',
                'asuse_code_dep'=> '20055511',
                'omnius_division' => '2',
                'asuse_alias' => 'world',
                'description' => 'Углегорск',
                'id_tns_name' => '10'
            ], [
                'title' => 'Томари',
                'asuse_name' => 'tom',
                'omnius_link' => '11',
                'asuse_code_dep'=> '30087359',
                'omnius_division' => '2',
                'asuse_alias' => 'world',
                'description' => 'Томари',
                'id_tns_name' => '11'
            ], [
                'title' => 'Александровск',
                'asuse_name' => 'al',
                'omnius_link' => '3',
                'asuse_code_dep'=> '70110654',
                'omnius_division' => '2',
                'asuse_alias' => 'world',
                'description' => 'Александровск',
                'id_tns_name' => '12'
            ], [
                'title' => 'Тымовск',
                'asuse_name' => 'tym',
                'omnius_link' => '12',
                'asuse_code_dep'=> '80087692',
                'omnius_division' => '2',
                'asuse_alias' => 'world',
                'description' => 'Тымовск',
                'id_tns_name' => '13'
            ], [
                'title' => 'Чехов',
                'asuse_name' => 'ch',
                'omnius_link' => '14',
                'asuse_code_dep'=> '100133345',
                'omnius_division' => '2',
                'asuse_alias' => 'world',
                'description' => 'Чехов',
                'id_tns_name' => '14'
            ]
        ]);
    }
}
