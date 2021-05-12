<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BanksAccounts extends Model
{
    use HasFactory;

    protected $table = 'borrower_bank_acc';

    protected $fillable = [
        'bank_name',
        'amount',
        'borrower_id'
    ];

    public function borrower()
    {
        return $this->belongsTo(Borrower::class);
    }
}
