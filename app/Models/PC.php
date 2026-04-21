<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PC extends Model
{
    use HasFactory;

    protected $table = 'pcs';
    public $timestamps = false;

    protected $fillable = [
        'pc_name',
        'status',
    ];
}
