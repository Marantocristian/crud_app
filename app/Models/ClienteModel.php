<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClienteModel extends Model
{
    protected $table = 'clientes';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address'
    ];
}
