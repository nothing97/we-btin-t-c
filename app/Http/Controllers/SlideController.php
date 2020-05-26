<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\support\facades\Auth;
use App\Http\Requests;
use App\Slide;

class SlideController extends Controller
{	
    public function getDanhSach()
    {
        $slide=Slide::all();
        return view ('admin.slide.danhsach', ['slide'=>$slide]);
    }

    public function getThem()
    {
        return view('admin.slide.them');
    }

    public function postThem(request $request)
    {
    	$this->$validate($request, 
    	[
    		'ten'=>'required',
    		'NoiDung'=>'required',

    	],

    	[
    		'ten.required'=>'Bạn chưa nhập tên',
    		'NoiDung.required'=>'Bạn chưa nhập nội dung',
    	]);

    	$slide =new Slide;
    	$slide->Ten=$request->Ten;
    	$slide->NoiDung=$request->NoiDung;

    	if($request-> hasfile('Hinh'))
        {
            $file= $request->file('Hinh');
            $duoi= $file->getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg')
            {
                return redirect('admin/tintuc/them')->with('loi','Ban chi duoc chon file co duoi jpg, png, jpeg');
            }
            $name = $file->getClientOriginalName();
            $Hinh = str_random(4)."_".$name;
            while (file_exists("public/upload/tintuc/"). $Hinh) 
            {
                $Hinh=str_random(4)."_".$name;
            }
            $file->move('public/upload/tintuc', $Hinh);
            $tintuc->Hinh=$Hinh;
            
        }
        else
        {
            $tintuc->Hinh = "";
        }

        $tintuc->save();
    	return redirect('admin/tintuc/them')->with('thongbao','thêm thành công');
    }
}
