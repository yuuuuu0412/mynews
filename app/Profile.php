<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
  // 以下実験的追記
  protected $table = 'profile';
  // 以上実験的追記終わり
  protected $guarded = array('id');
//
  public static $rules = array(
    'name' => 'required',
    'gender' => 'required',
    'hobby' => 'required',
    'introduction' => 'required',
  );
}
