<?php

# app/Models/Player.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

final class Player extends Model  
{
public $timestamps = false;

    public function mounts(){
            return $this->hasMany('App\Models\PlayerMount', 'player_id', 'id')->get();
    }
}