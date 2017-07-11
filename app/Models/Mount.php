<?php

# app/Models/Player.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

final class Mount extends Model  
{
public $timestamps = false;
    public function methodes(){
            return $this->hasMany('App\Models\MountMethod', 'mount_id', 'id');
    }
    
     protected $with = array('methodes');
}