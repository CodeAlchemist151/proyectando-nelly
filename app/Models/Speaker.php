<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Speaker extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'speakers';

    /**
     * Atributos que pueden ser asignados masivamente.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'name',            // Nombre completo del ponente
        'profession',      // Profesión o cargo actual
        'bio',            // Biografía profesional
        'photo',          // URL de la foto de perfil
        'phone',         // Teléfono de contacto
        'website',       // Sitio web personal
        'social_links'  // Enlaces a redes sociales (JSON)
    ];

    /**
     * Accesor para obtener la URL completa de la foto del ponente
     * @param string $photo
     * @return string
     */
    function getPhotoAttribute($photo)
    {
        // This might be causing the error if 'file' route doesn't exist
        return route('file', ['file' => $photo]);
    }

    /**
     * Conversiones de tipos para los atributos.
     *
     * @var array
     */
    protected $casts = [
        'social_links' => 'array', // Convierte social_links a array
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Relación con los eventos (muchos a muchos).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_speaker');
    }

    /**
     * Filtro para ponentes activos (no eliminados).
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->whereNull('deleted_at');
    }

    /**
     * Obtiene el enlace principal de redes sociales.
     *
     * @return string|null
     */
    public function getMainSocialLinkAttribute()
    {
        if (is_array($this->social_links) && count($this->social_links) > 0) {
            return $this->social_links[0];
        }
        return null;
    }

}
