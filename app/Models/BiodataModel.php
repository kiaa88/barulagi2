<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BiodataModel extends Model
{
    use HasFactory;
    protected $table = 'biodata';
    protected $fillable = [
        'name',
        'email',
        'phone',
        'alamat',
    ];
}
