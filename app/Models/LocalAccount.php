<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LocalAccount extends Model
{
    use SoftDeletes;
    use HasFactory;
    
    /**
     * |---------------------------------------------------------------------
     * | LOCAL ACCOUNT MENTAINS ACCOUNT BALANCES LOCALLY SO AS TO FASCILITATE LOCAL PROCESSING OF ACCOUNTS
     * | EACH USER MUST HAVE A LOCAL ACCOUNT IN ORDER TO TRANSACT ON USWA
     * |-------------------------------------------------------------------
     */

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     *
     */
    protected $guarded = ['id'];
}

