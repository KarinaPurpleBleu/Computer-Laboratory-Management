<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountRequest extends Model
{
    use HasFactory;

    protected $table = 'account_requests';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];
}
