<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['uuid', 'type', 'description', 'is_active'];

    /**
     * Relación: Un tipo de usuario puede estar asociado a muchos usuarios.
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Relación: Un tipo de usuario puede tener distintos precios en diferentes planes.
     */
    public function planPrices()
    {
        return $this->hasMany(PlanPrice::class);
    }
}
