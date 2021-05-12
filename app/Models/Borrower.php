<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrower extends Model
{
    use HasFactory;

    protected $table = 'borrower';

    protected $fillable = [
        'first_name',
        'last_name',
        'loan_application_id'
    ];

    public function loan_application()
    {
        return $this->belongsTo(LoanApplication::class);
    }

    public function income()
    {
        return $this->hasMany(Incomes::class);
    }

    public function bank_accounts()
    {
        return $this->hasMany(BanksAccounts::class);
    }
}
