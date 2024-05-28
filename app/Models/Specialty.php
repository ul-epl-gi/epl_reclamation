<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Specialty extends Model
{
    use HasFactory;
    
    protected $fillable = ['name'];

    public function  teachingUnits():BelongsToMany
    {
        return $this->belongsToMany(TeachingUnit::class, 'specialty_teaching_unit')->withPivot('semester');
    }
}
