<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class DocumentType extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['uuid', 'name', 'code'];

    /**
     * Relación: Un tipo de documento puede estar asociado a muchos usuarios.
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
