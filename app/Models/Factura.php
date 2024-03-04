<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;

    protected $fillable = ['total', 'numerofactura'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
