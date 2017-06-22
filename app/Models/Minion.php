<?php

# app/Models/Player.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

final class Minion extends Model  
{
public $timestamps = false;
    public function verminion(){
            return $this->hasOne('App\Models\Verminion', 'id', 'id');
    }
    
}