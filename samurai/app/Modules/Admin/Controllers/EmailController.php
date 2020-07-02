<?php

namespace App\Modules\Admin\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmailController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    /**
    *   Created by  :   vnaluuit - 20/08/2018 
    *   Description :   get View master Uploaded
    *   @return     :
    */
    public function getEmail()
    {
        return view("Admin::employee.email");
    } 
}