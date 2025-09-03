<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\HasUuid;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, HasRoles, HasUuid;

   protected static function boot()
     {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = Str::uuid()->toString();
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid', 
        'first_name', 
        'last_name', 
        'email', 
        'phone',
        'country',
        'city',
        'birthdate',
        'profile_photo', 
        'gender_id', 
        'document_type_id', 
        'user_type_id',
        'document_number',
        'institution_name',
        'academic_program',
        'modality',
        'university',
        'company_name',
        'company_position',
        'company_address',
        'entrepreneur_name',
        'product_type',
        'occupation',        
        'status',
        'accepted_terms', 
        'password'
    ];

    /**
     * Relación: Un usuario pertenece a un género.
     */
    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }

    /**
     * Relación: Un usuario pertenece a un tipo de documento.
     */
    public function documentType()
    {
        return $this->belongsTo(DocumentType::class);
    }

    /**
     * Relación: Un usuario pertenece a un tipo de usuario.
     */
    public function userType()
    {
        return $this->belongsTo(UserType::class);
    }

    /**
     * Relación: Un usuario pertenece a un programa académico.
     */
    public function program()
    {
        return $this->belongsTo(Program::class, 'academic_program_id');
    }

    /**
     * Relación: Un usuario ha asistido a varios eventos.
     */
    public function attendedEvents()
    {
        return $this->belongsToMany(Event::class, 'attendance');
    }

    /**
     * Relación: Un usuario se ha registrado en varios eventos.
     */
    public function registeredEvents()
    {
        return $this->belongsToMany(Event::class, 'registrations');
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'birthdate' => 'date',
        'accepted_terms' => 'boolean',
        'status' => 'boolean',
    ];

    /**
     * Mutador para formatear el campo first_name antes de guardar.
     * Aplica trim, minúsculas y capitaliza las palabras.
     */
    public function setFirstNameAttribute($value)
    {
        $this->attributes['first_name'] = ucwords(strtolower(trim($value)));
    }

    /**
     * Mutador para formatear el campo last_name antes de guardar.
     * Aplica trim, minúsculas y capitaliza las palabras.
     */
    public function setLastNameAttribute($value)
    {
        $this->attributes['last_name'] = ucwords(strtolower(trim($value)));
    }

    /**
     * Mutador para formatear el campo country antes de guardar.
     * Aplica trim, minúsculas y capitaliza las palabras.
     */
    public function setCountryAttribute($value)
    {
        $this->attributes['country'] = ucwords(strtolower(trim($value)));
    }

    /**
     * Mutador para formatear el campo city antes de guardar.
     * Aplica trim, minúsculas y capitaliza las palabras.
     */
    public function setCityAttribute($value)
    {
        $this->attributes['city'] = ucwords(strtolower(trim($value)));
    }

    /**
     * Mutador para formatear el nombre de la institución educativa
     * Esto asegura que el nombre de la institución tenga formato legible.
     */
    public function setInstitutionNameAttribute($value)
    {
        $this->attributes['institution_name'] = ucwords(strtolower(trim($value)));
    }

    /**
     * Mutador para formatear el campo academic_program antes de guardar.
     * Aplica trim, minúsculas y capitaliza las palabras.
     */
    public function setAcademicProgramAttribute($value)
    {
        $this->attributes['academic_program'] = ucwords(strtolower(trim($value)));
    }

    /**
     * Mutador para formatear el campo university antes de guardar.
     * Aplica trim, minúsculas y capitaliza las palabras.
     */
    public function setUniversityAttribute($value)
    {
        $this->attributes['university'] = ucwords(strtolower(trim($value)));
    }   

     /**
     * Mutador para formatear el campo company_name antes de guardar.
     * Esto asegura que el nombre de la empresa tenga formato legible.
     */
    public function setCompanyNameAttribute($value)
    {
        $this->attributes['company_name'] = ucwords(strtolower(trim($value)));
    }

    /**
     * Mutador para formatear el campo company_position antes de guardar.
     * Aplica trim, minúsculas y capitaliza las palabras.
     */
    public function setCompanyPositionAttribute($value)
    {
        $this->attributes['company_position'] = ucwords(strtolower(trim($value)));
    }

    /**
     * Mutador para formatear el campo company_address antes de guardar.
     * Aplica trim, minúsculas y capitaliza las palabras.
     */
    public function setCompanyAddressAttribute($value)
    {
        $this->attributes['company_address'] = ucwords(strtolower(trim($value)));
    }

    /**
     * Mutador para formatear el campo entrepreneur_name antes de guardar.
     * Aplica trim y minúsculas.
     */
    public function setEntrepreneurNameAttribute($value)
    {
        $this->attributes['entrepreneur_name'] = ucwords(strtolower(trim($value)));
    }

    /**
     * Mutador para formatear el campo product_type antes de guardar.
     * Aplica trim, minúsculas y capitaliza las palabras.
     */
    public function setProductTypeAttribute($value)
    {
        $this->attributes['product_type'] = ucwords(strtolower(trim($value)));
    }

    /**
     * Mutador para formatear el campo occupation antes de guardar.
     * Aplica trim, minúsculas y capitaliza las palabras.
     */
    public function setOccupationAttribute($value)
    {
        $this->attributes['occupation'] = ucwords(strtolower(trim($value)));
    }

}