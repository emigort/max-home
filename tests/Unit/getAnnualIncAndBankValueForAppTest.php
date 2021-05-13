<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class getAnnualIncAndBankValueForAppTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $data = [
            'data' =>
                [
                    'annual_income',
                    'bank_value_total',
                ],
            'message',
        ];
        $loan_app = DB::table('loan_application')->inRandomOrder()->first('id');
        $response = $this->json('GET', '/api/loan/income_values/' . $loan_app->id);
        $response->assertJsonStructure($data);


    }
}
