<?php

namespace Database\Seeders;

use App\Models\BanksAccounts;
use App\Models\Borrower;
use App\Models\Incomes;
use App\Models\LoanApplication;
use App\Services\BorrowerService;
use App\Services\LoanAppService;
use Illuminate\Database\Seeder;

class BasicDataSeeder extends Seeder
{


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {

            LoanApplication::truncate();
            Borrower::truncate();
            BanksAccounts::truncate();
            Incomes::truncate();

            $LoanApplicationService = new LoanAppService;
            $BorrowerService = new BorrowerService;
            $data = json_decode(file_get_contents(storage_path('data/loan_app.json')));

            $LoanApp = $LoanApplicationService->create($data->amount);
            echo "Loan Application inserted\n";
            foreach ($data->borrowers as $key => $borrower) {
                $borrower_db[$key] = $BorrowerService->create($borrower->first_name, $borrower->last_name, $LoanApp->id)->toArray();
                echo "Borrower inserted\n";
                foreach ($borrower->bank_accounts as $key1 => $bank_account) {
                    $borrower_db[$key]['bank_accounts'][$key1] = $BorrowerService->createBankAcct($bank_account->bank_name, $bank_account->amount, $borrower_db[$key]['id'])->toArray();
                    echo "Borrower bank info inserted\n";
                }

                foreach ($borrower->annual_incomes as $annual_income) {
                    $borrower_db[$key]['annual_incomes'][] = $BorrowerService->createIncomeAnnual($annual_income->income_type, $annual_income->amount, $borrower_db[$key]['id'])->toArray();
                    echo "Borrower income info inserted\n";
                }
            }
        } catch (\Exception $e) {

            throw new \Exception($e->getMessage());
        }
    }
}
