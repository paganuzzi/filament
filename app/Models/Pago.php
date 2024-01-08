<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pago extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['importe', 'descripcion'];

    public function user(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
