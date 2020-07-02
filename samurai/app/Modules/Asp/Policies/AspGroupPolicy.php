<?php

namespace App\Modules\Asp\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Modules\Asp\Models\AspUser;
use App\Modules\Asp\Models\AspGroup;

class AspGroupPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {

    }  
    public function before(AspUser $user){
        if($user->isAdmin()){
            return true;
        }
    }    
    public function index(AspUser $user){
        return true;        
    }
    public function show(AspUser $user,AspGroup $group){
        $gr_user = $user->group()->first();
        if(!$gr_user || $gr_user->id !== $group->id){ return false;}
        return true;
    }
    public function create(AspUser $user){
        return false;
    }        
    public function edit(AspUser $user,AspGroup $group){
        if($user->isMember()){ return false;}
        $gr_user = $user->group()->first();
        if(!$gr_user || $gr_user->id !== $group->id){ return false;}
        return true;
    }    
    public function destroy(AspUser $user,AspGroup $group){
        return false;        
    }   
        
}
