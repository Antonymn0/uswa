<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionHistory extends Model
{
    use SoftDeletes;
    use HasFactory;
    
    /**
     * |---------------------------------------------------------------------------
     * | THIS MODEL RECORDS ALL TRANSACTION HISTORIES BOTH LOCAL AND EXTERNAL
     * | ACTUAL MONEY IS STORED ON STRIPE
     * | THE LOCAL ACCOUNT AND TRANSACTION HISTORY ARE FOR RECORD KEEPING PURPOSES
     * |-----------------------------------------------------------------------------
     */


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     *
     */
    protected $guarded = ['id'];
}
