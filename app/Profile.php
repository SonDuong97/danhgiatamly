<?php
/**
 * Created by PhpStorm.
 * User: tuando
 * Date: 03/11/2018
 * Time: 22:59
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'profiles';
    protected $hidden = ['created_at', 'updated_at'];

}