<?php

# app/Models/Player.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

final class MinionMethod extends Model  
{
    use HasCompositePrimaryKey;
    protected $hidden = ['minion_id'];
    protected $primaryKey = array('minion_id','method_name');
    public $incrementing = false;
    
    protected $table = 'minion_method';
    public $timestamps = false;
    
    
}