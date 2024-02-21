<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Motif extends Model
{
    use HasFactory;
    protected $fillable = [
        'libelle',
    ];

    public function agents()
    {
        return $this->hasMany(Agents::class, 'code_motif', 'code_motif');
    }
}
