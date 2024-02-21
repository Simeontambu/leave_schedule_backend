<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use App\Models\fonction;
class Agents extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'prenom',
        'libelle_motif',
    ];

    public function fonction()
    {
        return $this->belongsTo(fonction::class, 'code_fonction', 'code_fonction');
    }
    public function direction()
    {
        return $this->belongsTo(direction::class, 'code_direction', 'code_direction');
    }
}
