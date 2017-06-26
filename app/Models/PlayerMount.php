<?php

# app/Models/Player.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

final class PlayerMount extends Model  
{
    protected $primaryKey = null;
    public $incrementing = false;
    protected $fillable = array('player_id', 'mount_id');
    
    protected $table = 'FK_player_mount';
    public $timestamps = false;
    
}