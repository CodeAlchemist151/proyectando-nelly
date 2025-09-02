<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['uuid', 'name'];


    /**
     * Relación: Un género puede tener muchos usuarios.
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
