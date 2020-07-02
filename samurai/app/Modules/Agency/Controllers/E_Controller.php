<?php

namespace App\Modules\Agency\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class E_Controller extends Controller
{
    /**
    *   Created by  :   Trieunb - 20/08/2018 
    *   Description :   get View Index
    *   @return     :
    */
    public function getMsearch()
    {
        return view("Agency::Epage.search");
    }
}