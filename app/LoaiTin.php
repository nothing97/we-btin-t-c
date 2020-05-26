<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\LoaiTin;
class Loaitin extends Model
{
    //
    protected $table="LoaiTin";
    
    public function theloai()
    {
    	return $this->belongsto('App\TheLoai','idTheLoai','id');
    }

    public function tintuc()
    {
    	return $this->hasMany('App\TinTuc','idLoaiTin', 'id' );
    }
}
