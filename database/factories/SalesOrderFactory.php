<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SalesOrder>
 */
class SalesOrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        $faker = Faker::create();
        return [
            'amount_to_invoice' => $faker->randomFloat(2, 0, 10000),
            'amount_total' => $faker->randomFloat(2, 0, 10000),
            'amount_untaxed' => $faker->randomFloat(2, 0, 10000),
            'create_date' => now(),
            'delivery_status' => $faker->randomElement(['pending', 'partial', 'full']),
            'internal_note_display' => $faker->paragraph,
            'name' => $faker->unique()->uuid, // Ensure unique identifier
            'partner_id_contact_address' => $faker->address,
            'partner_id_display_name' => $faker->name,
            'partner_id_phone' => $faker->phoneNumber,
            'state' => $faker->randomElement(['draft', 'sale', 'void']),
            'x_studio_commission_paid' => $faker->boolean,
            'x_studio_invoice_payment_status' => $faker->randomElement(['pending', 'paid', 'failed']),
            'x_studio_payment_type' => $faker->word,
            'x_studio_referrer_processed' => $faker->boolean,
            'x_studio_sales_rep_1' => $faker->name,
            'x_studio_sales_source' => $faker->word,
        ];
    }
}
