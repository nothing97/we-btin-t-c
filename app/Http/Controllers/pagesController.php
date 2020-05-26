<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\support\facades\Auth;

use App\Http\Requests;
use App\TheLoai;
use App\LoaiTin;
use App\TinTuc;
use App\Slide;
use App\User;

class pagesController extends Controller
{	

	function trangchu()
	{
		$theloai=TheLoai::all();
		return view('pages.trangchu',['theloai'=>$theloai]);
	}

	function lienhe()
	{
		$theloai=TheLoai::all();
		return view('pages.contact',['theloai'=> $theloai]);
	}

	function slide()
	{
		$slide=Slide::all();
		return view('pages.trangchu',['slide'=> $slide]);
	} 

	function loaitin()
	{
		return view('pages.loaitin');
	}

	function getDangnhap()
	{
		return view('pages.dangnhap');
	}

	function postDangnhap(Request $request)
	{
		$this->validate($request,
		[
			'email'=>'required',
			'password'=>'required| min:3| max:32',
		],

		[
			'email.required'=>'email đã tồn tại',
			'password.required'=>'Mật khẩu đã tồn tại',
			'password.min'=>'Mật khẩu quá ngắn',
			'password.max'=>'Mật khẩu quá dài',
		]);

		if (Auth::attempt(['email'=>$request->email, 'password'=>$request->password]))
        {
            return redirect('trangchu');
        } 
        
        else
        {
            return redirect('dangnhap')->with('thongbao', 'Đăng nhập thành công');
        } 
	}
}
