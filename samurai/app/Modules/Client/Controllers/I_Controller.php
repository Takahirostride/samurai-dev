<?php

namespace App\Modules\Client\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class I_Controller extends Controller
{
    /**
    *   Created by  :   Trieunb - 20/08/2018 
    *   Description :   get View subsidylist
    *   @return     :
    */
    public function getSubsidylist()
    {
        return view("Client::Ipage.subsidylist");
    }
}