<?php
namespace App;

//use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class adminuser extends Eloquent implements Authenticatable
{
    //
    use AuthenticableTrait;
    protected $connection       = 'mongodb';
    
    protected $collection_1     = 'userMaster';
    protected $collection_2     = 'surveyType';
    protected $collection_3     = 'dimensionMaster';
    
    protected static $unguarded = true;
}
