<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incomes extends Model
{
    use HasFactory;

    protected $table = 'borrower_income';

    protected $fillable = [
        'income_type',
        'amount',
        'borrower_id'
    ];

    public function borrower()
    {
        return $this->belongsTo(Borrower::class);
    }
}
