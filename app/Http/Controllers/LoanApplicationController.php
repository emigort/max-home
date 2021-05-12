<?php

namespace App\Http\Controllers;

use App\Models\Borrower;
use App\Models\LoanApplication;
use App\Services\BorrowerService;
use App\Services\LoanAppService;
use Illuminate\Http\Request;

class LoanApplicationController extends Controller
{
    private $LoanApplicationService;
    private $BorrowerService;

    public function __construct()
    {
        $this->LoanApplicationService = new LoanAppService;
        $this->BorrowerService = new BorrowerService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $json = json_decode($request->getContent());
        return response([
            "data" => $json,
            "message" => NULL,
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $data = json_decode($request->getContent());
            $borrower_db = [];

            $LoanApp = $this->LoanApplicationService->create($data->amount);
            foreach ($data->borrowers as $key => $borrower) {
                $borrower_db[$key] = $this->BorrowerService->create($borrower->first_name, $borrower->last_name, $LoanApp->id)->toArray();

                foreach ($borrower->bank_accounts as $key1 => $bank_account) {
                    $borrower_db[$key]['bank_accounts'][$key1] = $this->BorrowerService->createBankAcct($bank_account->bank_name, $bank_account->amount, $borrower_db[$key]['id'])->toArray();
                }

                foreach ($borrower->annual_incomes as $annual_income) {
                    $borrower_db[$key]['annual_incomes'][] = $this->BorrowerService->createIncomeAnnual($annual_income->income_type, $annual_income->amount, $borrower_db[$key]['id'])->toArray();
                }
            }
            return response([
                "data" => [
                    'loan_application_id' => $LoanApp->id,
                    'amount' => $LoanApp->loan_amount,
                    'current_status' => $LoanApp->current_status,
                    'borrowers' => $borrower_db
                ],
                "message" => NULL,
            ], 200);

        } catch (\Exception $e) {
            return response([
                "data" => null,
                "message" => [
                    'File' => $e->getFile(),
                    'Line' => $e->getLine(),
                    'message' => $e->getMessage()
                ],
            ], 500);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\LoanApplication $loanApplication
     * @return \Illuminate\Http\Response
     */
    public function show(LoanApplication $loanApplication)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\LoanApplication $loanApplication
     * @return \Illuminate\Http\Response
     */
    public function edit(LoanApplication $loanApplication)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\LoanApplication $loanApplication
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LoanApplication $loanApplication)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\LoanApplication $loanApplication
     * @return \Illuminate\Http\Response
     */
    public function destroy(LoanApplication $loanApplication)
    {
        //
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function getAnnualIncAndBankValueForApp($id)
    {
        $total_income = 0;
        $bank_account_total = 0;
        $Borrowers = LoanApplication::find($id)->borrowers;
        foreach ($Borrowers as $borrower) {
            $total_income += $borrower->income->sum('amount');
            $bank_account_total += $borrower->bank_accounts->sum('amount');
        }
        return response([
            "data" => [
                'annual_income' => $total_income,
                'bank_value_total' => $bank_account_total
            ],
            "message" => NULL,
        ], 200);
    }
}
