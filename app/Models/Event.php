<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'events';

    protected $fillable = [
        'uuid',
        'event_type_id',   // ID del tipo de evento (conferencia, taller, etc.)
        'title',           // Título del evento
        'image',           // URL de la imagen del evento
        'description',     // Descripción detallada
        'modality_id',     // ID de la modalidad (presencial, virtual, etc.)
        'max_capacity',    // Capacidad máxima de asistentes
        'virtual_link',    // Enlace para eventos virtuales
        'is_active'       // Estado de activación
    ];

    /**
     * Relación: Un evento pertenece a una modalidad.
     */
    public function modality()
    {
        return $this->belongsTo(Modality::class);
    }

    /**
     * Relación: Un evento puede tener muchas agendas.
     */
    public function agendas()
    {
        return $this->hasMany(Agenda::class);
    }

    /**
     * Relación: Un evento puede tener muchos temas.
     */
    public function themes()
    {
        return $this->belongsToMany(Theme::class, 'event_theme'); // si deseas modelo intermedio
    }

    /**
     * Un evento puede tener múltiples horarios en diferentes ubicaciones
     */
    public function schedules()
    {
        return $this->belongsToMany(Schedule::class, 'event_schedule_location'); // Incluir timestamps del pivot
    }

    /**
     * Un evento puede realizarse en múltiples ubicaciones con diferentes horarios
     */
    public function locations()
    {
        return $this->belongsToMany(Location::class, 'event_schedule_location'); // Incluir timestamps del pivot
    }

     /**
     * Un evento puede tener múltiples speakers
     */
    public function speakers()
    {
        return $this->belongsToMany(Speaker::class, 'event_speaker');
    }

    /**
     * Relación many-to-many con Speaker incluyendo eliminados (para administración)
     */
    public function speakersWithTrashed()
    {
        return $this->belongsToMany(Speaker::class, 'event_speaker');
    }

    /**
     * Conversiones de tipos para los atributos.
     *
     * @var array
     */
    protected $casts = [
        'is_active' => 'boolean',
        'max_capacity' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Valores por defecto para los atributos.
     *
     * @var array
     */
    protected $attributes = [
        'is_active' => true,
    ];

   }
