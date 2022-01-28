<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Game extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $dates = [
        'date'
    ];

    /**
     * RELATIONSHIPS
     */
    public function homeTeam(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'home_team_id');
    }

    public function guestTeam(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'guest_team_id');
    }
}
