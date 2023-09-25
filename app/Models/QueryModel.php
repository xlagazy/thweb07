<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QueryModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'Employee Number',
        'Name',
        'Assign Date',
    ];
}
