<?php

namespace App\Modules\Client\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class G_Controller extends Controller
{
	/**
    *   Created by  :   Trieunb - 20/08/2018 
    *   Description :   get View home
    *   @return     :
    */
    public function getHome() {
   		return view("Client::Gpage.home");
   	}
   	/**
    *   Created by  :   Trieunb - 20/08/2018 
    *   Description :   get View List
    *   @return     :
    */
    public function getList() {
   		return view("Client::Gpage.list");
   	}
}