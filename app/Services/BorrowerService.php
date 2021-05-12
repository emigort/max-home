<?php


namespace App\Services;


use App\Models\BanksAccounts;
use App\Models\Borrower;
use App\Models\Incomes;

class BorrowerService
{
    /**
     * @param string $first_name
     * @param string $last_name
     * @param int $loan_application_id
     * @return Borrower
     * @throws \Exception
     */
    public function create(string $first_name, string $last_name, int $loan_application_id): Borrower
    {
        try {
            return Borrower::create([
                'first_name' => $first_name,
                'last_name' => $last_name,
                'loan_application_id' => $loan_application_id
            ]);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }

    }

    /**
     * @param string $bank_name
     * @param float $bank_amount
     * @param int $borrower_id
     * @return BanksAccounts
     * @throws \Exception
     */
    public function createBankAcct(string $bank_name, float $bank_amount, int $borrower_id): BanksAccounts
    {
        try {
            return BanksAccounts::create([
                'bank_name' => $bank_name,
                'amount' => $bank_amount,
                'borrower_id' => $borrower_id
            ]);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * @param string $income_type
     * @param float $amount
     * @param int $borrower_id
     * @return Incomes
     * @throws \Exception
     */
    public function createIncomeAnnual(string $income_type, float $amount, int $borrower_id): Incomes
    {
        try {
            return Incomes::create([
                'income_type' => $income_type,
                'amount' => $amount,
                'borrower_id' => $borrower_id
            ]);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }

    }
}
