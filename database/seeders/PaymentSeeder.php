<?php

namespace Database\Seeders;

use App\Models\Payment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Payment::create([
            'name' => 'Bank BCA',
            'norek' => '13131231231',
            'logo' => 'payments/bca.jpg'
        ]);

        Payment::create([
            'name' => 'Dana | Ryan_syah',
            'norek' => '943248844843',
            'logo' => 'payments/dana.png'
        ]);

        Payment::create([
            'name' => 'Gopay | Ryan_syah',
            'norek' => '082192598451',
            'logo' => 'payments/gopay.jpg'
        ]);
    }
}
