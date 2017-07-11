<?php

# app/Models/Player.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

final class mountMethod extends Model  
{
    use HasCompositePrimaryKey;
    protected $hidden = ['mount_id'];
    protected $primaryKey = array('mount_id','method_name');
    public $incrementing = false;
    
    protected $table = 'mount_method';
    public $timestamps = false;
    
    
}