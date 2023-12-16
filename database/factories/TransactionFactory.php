<?php

namespace Database\Factories;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{

    protected $model = Transaction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'total' => rand(0, 1000),
            'inputs' => null,
        ];
    }

    public function cash(): Factory
    {
        return $this->state(function (array $attributes) {
            $banknotes = [
                'banknote_1' => rand(0, 5),
                'banknote_5' => rand(0, 5),
                'banknote_10' => rand(0, 5),
                'banknote_50' => rand(0, 5),
                'banknote_100' => rand(0, 5),
            ];

            $total = 0;
            foreach ($banknotes as $key => $value) {

                $multiplier = explode("_", $key);
                $total += $banknotes[$key] ? $banknotes[$key] * (int) $multiplier[1] : 0;

            }

            return [
                'total' => $total,
                'inputs' => json_encode($banknotes),
            ];
        });
    }

    public function creditcard(): Factory
    {
        return $this->state(function (array $attributes) {

            $total = rand(0, 1000);
            $data = [
                'creditCardNumber' => $this->faker->creditCardNumber,
                'month' => $this->faker->month,
                'year' => rand(date('Y')+1, date('Y')+10),
                'cvv' => $this->faker->randomNumber(3),
                'cardholderName' => $this->faker->name,
                'amount' => $total,
            ];

            return [
                'total' => $total,
                'inputs' => json_encode($data),
            ];
        });
    }

    public function bankTransfer(): Factory
    {
        return $this->state(function (array $attributes) {

            $total = rand(0, 1000);
            $data = [
                'transferDate' => $this->faker->dateTimeBetween('now', '1 year')->format('Y-m-d'),
                'accountNumber' => $this->faker->randomNumber(6),
                'customerName' => $this->faker->name,
                'amount' => $total,
            ];

            return [
                'total' => $total,
                'inputs' => json_encode($data),
            ];
        });
    }
}
