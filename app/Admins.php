<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Cache\TaggableStore;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
class Admins extends Model
{
    protected $table ="admins";
    //public $relationships = array('Author', 'Category');
    protected $guarded = [];
    protected $hidden = ['password'];
    public function test(){

    	return $this->getAllPermission;
    }
     public function cachedPermission()
    {
        $userPrimaryKey = $this->primaryKey;
        $cacheKey = 'permissions'.$this->$userPrimaryKey;
        //dd(Cache::getStore() instanceof TaggableStore);
        if(Cache::getStore() instanceof TaggableStore) {
        	//dd(Cache::getStore() instanceof TaggableStore);
            return Cache::tags('permissions')->remember($cacheKey, Config::get('cache.ttl'), function () {

                return $this->getPermission()->get();
            });
        }
        else return $this->getPermission()->get();
    }
    public function can($permission, $requireAll = false)
    {   if(session('admin')->id==1){
            return true;
        }
        if (is_array($permission)) {
            foreach ($permission as $permName) {
                $hasPerm = $this->can($permName);
                if ($hasPerm && !$requireAll) {
                    return true;
                } elseif (!$hasPerm && $requireAll) {
                    return false;
                }
            }
            // If we've made it this far and $requireAll is FALSE, then NONE of the perms were found
            // If we've made it this far and $requireAll is TRUE, then ALL of the perms were found.
            // Return the value of $requireAll;
            return $requireAll;
        } else {
            foreach ($this->cachedPermission() as $perm) {
                       
                    if (str_is( $permission, $perm->key) ) {
                        return true;
                    }
                
            }
        }
        return false;
    }
    public function attachPermissions($permissions)
    {
        foreach ($permissions as $permission) {
            $this->attachPermission($permission);
        }
    }
     public function attachPermission($permission)
    {
        if (is_object($permission)) {
            $permission = $permission->getKey();
        }
        if (is_array($permission)) {
            $permission = $permission['id'];
        }
        $this->getPermission()->attach($permission);
    }
    public function savePermission($permission)
    {   

        if (is_object($permission)) {
            $permission = $permission->getKey();
        }
        if (is_array($permission)) {
            $permission = $permission['id'];
        }
        if (!empty($permission)) {  

            $this->getPermission()->sync($permission);
           
        }
        else{
            // xoa het trong db
             $this->getPermission()->delete();
           //  $this->getCategory()->detach($permission); 
        }
        
    }

    public function getPermission(){

    	return $this->belongsToMany('App\Permission', 'permission_admin', 'admin_id', 'permission_id');
    }
     
}
