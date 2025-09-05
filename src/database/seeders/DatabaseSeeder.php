<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contact;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 既に作ってある 5 件のカテゴリを流し込む
        $this->call([
            CategorySeeder::class,
        ]);

        // contacts を 35 件生成
        Contact::factory()->count(35)->create();
    }
}
