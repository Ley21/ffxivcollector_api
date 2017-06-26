<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;

class SearchController extends Controller {

    public function search()
    {
        $world = Input::get('world');
        $name = Input::get('name');
        
        return PlayerController::search($world,$name);
    }
}