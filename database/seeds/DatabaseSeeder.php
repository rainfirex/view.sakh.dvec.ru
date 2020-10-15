<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * Вначале обновим список файлов, чтобы все наши новые классы (файлы) «посевки» были видны скрипту:
     * composer.phar dump-autoload
     *
     * @return void
     */
    public function run()
    {
        $this->call(BaseRegionsTableSeeder::class);
        $this->call(TnsNamesTableSeeder::class);
    }
}
