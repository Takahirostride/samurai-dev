<?php

namespace App\Modules\Asp\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Modules\Asp\Models\AspUser;

class AspUserPolicy
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
    public function create(AspUser $user){
        if($user->isMod()){
            return true;
        }
        return false;
    }        
    public function edit(AspUser $user,AspUser $member){
        if($user->isMember()){return false;}
        $gr_mem = $member->group()->first();
        if(!$gr_mem || $gr_mem->mod_id != $user->id){ return false;}
        return true;
    }    
    public function destroy(AspUser $user,AspUser $group){
        return $user->id === $group->mod_id;        
    }   
        
}
