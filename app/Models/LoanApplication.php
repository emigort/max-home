<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanApplication extends Model
{
    use HasFactory;

    protected $table = 'loan_application';

    protected $fillable = [
        'loan_amount',
        'current_status'
    ];

    public function borrowers(){
        return $this->hasMany(Borrower::class);
    }
}
