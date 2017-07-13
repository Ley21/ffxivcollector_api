<?php

# app/Models/Player.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

final class PlayerMinion extends Model  
{
    protected $primaryKey = null;
    public $incrementing = false;
    protected $fillable = array('player_id', 'minion_id');
    protected $hidden = ['player_id'];
    protected $table = 'FK_player_minion';
    public $timestamps = false;
    
}