<?php

use Illuminate\Database\Seeder;

class TnsNamesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tns_names')->insert([
            [
                'title' => 'Южно-Сахалинск',
                'service_name' => 'ORCL',
                'host' => '172.26.78.9',
                'port' => '1521',
                'sid' => 'ORCL',
                'db' => 'sah',
                'user' => 'sah',
                'password' => 'maddogs'
            ],
            [
                'title' => 'Анива',
                'service_name' => 'aniva',
                'host' => '172.26.79.96',
                'port' => '1522',
                'sid' => 'aniva',
                'db' => 'sah',
                'user' => 'sah',
                'password' => 'maddogs'
            ],
            [
                'title' => 'Долинск',
                'service_name' => 'dolinsk',
                'host' => '172.26.79.96',
                'port' => '1521',
                'sid' => 'dolinsk',
                'db' => 'sah',
                'user' => 'sah',
                'password' => 'maddogs'
            ],
            [
                'title' => 'Корсаков',
                'service_name' => 'korsakov',
                'host' => '172.26.79.96',
                'port' => '1523',
                'sid' => 'korsakov',
                'db' => 'sah',
                'user' => 'sah',
                'password' => 'maddogs'
            ],
            [
                'title' => 'Холмск',
                'service_name' => 'ORCL',
                'host' => '172.26.87.2',
                'port' => '1521',
                'sid' => 'ORCL',
                'db' => 'sah',
                'user' => 'sah',
                'password' => 'maddogs'
            ],
            [
                'title' => 'Невельск',
                'service_name' => 'ORCL',
                'host' => '172.26.89.2',
                'port' => '1521',
                'sid' => 'ORCL',
                'db' => 'sah',
                'user' => 'sah',
                'password' => 'maddogs'
            ],
            [
                'title' => 'Поронайск',
                'service_name' => 'ORCL',
                'host' => '172.26.81.2',
                'port' => '1521',
                'sid' => 'ORCL',
                'db' => 'sah',
                'user' => 'sah',
                'password' => 'maddogs'
            ],
            [
                'title' => 'Смирных',
                'service_name' => 'ORCL',
                'host' => '172.26.82.2',
                'port' => '1521',
                'sid' => 'ORCL',
                'db' => 'sah',
                'user' => 'sah',
                'password' => 'maddogs'
            ],
            [
                'title' => 'Макаров',
                'service_name' => 'ORCL',
                'host' => '172.26.83.2',
                'port' => '1521',
                'sid' => 'ORCL',
                'db' => 'sah',
                'user' => 'sah',
                'password' => 'maddogs'
            ],
            [
                'title' => 'Углегорск',
                'service_name' => 'ORCL',
                'host' => '172.26.90.2',
                'port' => '1521',
                'sid' => 'ORCL',
                'db' => 'sah',
                'user' => 'sah',
                'password' => 'maddogs'
            ],
            [
                'title' => 'Томари',
                'service_name' => 'ORCL',
                'host' => '172.26.91.2',
                'port' => '1521',
                'sid' => 'ORCL',
                'db' => 'sah',
                'user' => 'sah',
                'password' => 'maddogs'
            ],
            [
                'title' => 'Александровск',
                'service_name' => 'ORCL',
                'host' => '172.26.93.130',
                'port' => '1521',
                'sid' => 'ORCL',
                'db' => 'sah',
                'user' => 'sah',
                'password' => 'maddogs'
            ],
            [
                'title' => 'Тымовск',
                'service_name' => 'ORCL',
                'host' => ' 172.26.93.2',
                'port' => '1521',
                'sid' => 'ORCL',
                'db' => 'sah',
                'user' => 'sah',
                'password' => 'maddogs'
            ],
            [
                'title' => 'Чехов',
                'service_name' => 'ORCL',
                'host' => '172.26.88.2',
                'port' => '1521',
                'sid' => 'ORCL',
                'db' => 'sah',
                'user' => 'sah',
                'password' => 'maddogs'
            ]
        ]);
    }
}
