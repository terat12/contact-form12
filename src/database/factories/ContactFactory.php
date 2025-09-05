<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    protected $model = Contact::class;

    public function definition(): array
    {
        // 日本語寄りのダミーにしたい場合は config('app.locale') が ja でもOK
        $lastName  = $this->faker->lastName();
        $firstName = $this->faker->firstName();

        return [
            // 既存の categories からランダムで外部キーを選ぶ（無ければ 1）
            'category_id' => Category::inRandomOrder()->value('id') ?? 1,

            'first_name'  => $firstName,
            'last_name'   => $lastName,
            'gender'      => $this->faker->randomElement([1, 2, 3]),
            'email'       => $this->faker->unique()->safeEmail(),
            'tel'         => $this->faker->numerify('0##########'), // 0 から始まる 11 桁想定
            'address'     => '東京都世田谷区' . $this->faker->numberBetween(1, 20) . '-' . $this->faker->numberBetween(1, 20) . '-' . $this->faker->numberBetween(1, 20),
            'building'    => $this->faker->boolean(70) ? 'コーチテックマンション' . $this->faker->numberBetween(101, 905) : null,
            'detail'      => mb_substr($this->faker->realText(60), 0, 120), // 120文字以内
        ];
    }
}
