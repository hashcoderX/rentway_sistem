<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class PermitionController extends Controller
{
     public function createUserRoll(){
        Role::create(['name' => 'OO']);
        Role::create(['name' => 'CC']);
        Role::create(['name' => 'CO']);
        Role::create(['name' => 'AM']);
        Role::create(['name' => 'HCC']);
        Role::create(['name' => 'BM']);
        Role::create(['name' => 'RM-I']);
        Role::create(['name' => 'RM-II']);
        Role::create(['name' => 'RM-III']);
        Role::create(['name' => 'HOQA']);
        Role::create(['name' => 'HOLR']);
        Role::create(['name' => 'HOAF']);
        Role::create(['name' => 'HHRM']);
        Role::create(['name' => 'AGM']);
        Role::create(['name' => 'HOIT']);
        Role::create(['name' => 'HORD']);
        Role::create(['name' => 'HOLM']);
        Role::create(['name' => 'DGM']);
        Role::create(['name' => 'HOR']);
        Role::create(['name' => 'RPMC']);
        Role::create(['name' => 'MD']);
        Role::create(['name' => 'ALCO']);
        Role::create(['name' => 'SPC']);
        Role::create(['name' => 'HOIA']);
        Role::create(['name' => 'BOD']);
     }

     
}
