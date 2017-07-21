<?php

namespace App\Http\Controllers;

use App\Models\Minion;
use App\Models\Mount;
use Illuminate\Support\Facades\Input;

class LanguageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    
    public function indexMinions(){
        $lang = Input::get('lang');
        
        $minions = Minion::all();
        $langTable = array();
        foreach($minions as $minion){
            $id = $minion['id'];
            $identifier = 'minion_'.$id;
            $langTable[$identifier] = $minion['name_'.$lang];
            $langTable[$identifier.'_desc'] = $minion['description_'.$lang];
            $langTable[$identifier.'_summon'] = $minion['summon_'.$lang];
            $methodes = $minion->methodes();
            
            foreach($minion->methodes as $method){
                $method_name = str_replace(' ', '_', $method['method_name']);;
                $method_identifier = $identifier.'_'.$method_name.'_desc';
                $langTable[$method_identifier] = $method['description_'.$lang];
            }
        }
        return $langTable;
    }
    
    public function indexMounts(){
        $lang = Input::get('lang');
        
        $mounts = Mount::all();
        $langTable = array();
        foreach($mounts as $mount){
            $id = $mount['id'];
            $identifier = 'mount_'.$id;
            $langTable[$identifier] = $mount['name_'.$lang];
            $langTable[$identifier.'_desc'] = $mount['description_'.$lang];
            $langTable[$identifier.'_summon'] = $mount['summon_'.$lang];
            foreach($mount->methodes as $method){
                $method_name = str_replace(' ', '_', $method['method_name']);;
                $method_identifier = $identifier.'_'.$method_name.'_desc';
                $langTable[$method_identifier] = $method['description_'.$lang];
            }
        }
        return $langTable;
    }

    //
}
