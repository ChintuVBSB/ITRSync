<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\IncomeType;
use App\Models\DeductionType;
class IncomeAndDeductionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
         $incomeTypes = [
            ['slug' => 'salary', 'label' => 'Income from Salary'],
            ['slug' => 'house_property', 'label' => 'Income from House Property'],
            ['slug' => 'business', 'label' => 'Income from Business and Profession'],
            ['slug' => 'capital_gains', 'label' => 'Income from Capital Gains'],
            ['slug' => 'other_sources', 'label' => 'Income from Other Sources'],
        ];

        foreach ($incomeTypes as $type) {
            IncomeType::firstOrCreate(['slug' => $type['slug']], $type);
        }

        $deductionTypes = [
            ['slug' => '80C', 'label' => '80 C - Investments'],
            ['slug' => '80D', 'label' => '80 D - Mediclaim'],
            ['slug' => '80E', 'label' => '80 E - Education Loan Interest'],
            ['slug' => '80G', 'label' => '80G / 80GGA / 80GGC - Donation'],
            ['slug' => 'other', 'label' => 'Other Deduction Document'],
        ];

        foreach ($deductionTypes as $type) {
            DeductionType::firstOrCreate(['slug' => $type['slug']], $type);
        }
    }
}
