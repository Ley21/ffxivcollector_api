<?php

# app/Models/Player.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

final class Player extends Model  
{
public $timestamps = false;

    public function mounts(){
            return $this->hasMany('App\Models\PlayerMount', 'player_id', 'id');
    }
    
    public function minions(){
            return $this->hasMany('App\Models\PlayerMinion', 'player_id', 'id');
            
    }
    protected $with = array('minions','mounts');
}