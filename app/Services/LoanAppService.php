<?php


namespace App\Services;


use App\Models\LoanApplication;

class LoanAppService
{
    /**
     * @param int $amount
     * @return LoanApplication
     * @throws \Exception
     */
    public function create(int $amount): LoanApplication
    {
        try {
            return LoanApplication::create([
                'loan_amount' => $amount
            ]);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

}
