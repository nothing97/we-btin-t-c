<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\TheLoai;
use App\LoaiTin;


class LoaiTinController extends Controller
{	
    public function getDanhSach()
    {
    	$loaitin= LoaiTin::all();
    	return view('admin.loaitin.danhsach',['loaitin'=>$loaitin]);
    }

    public function getThem()
    {
        $theloai=TheLoai::all();
    	return view('admin/loaitin/them',['theloai'=>$theloai]);	
    }

    public function postThem(Request $request)
    {
    	$this->validate($request, 
    		[	
    			'Ten'=> 'required|unique:LoaiTin,Ten| min:3| max:100',
                'TheLoai'=>'required'
    		],

    		[
    			'Ten.required'=>'Bạn chưa nhập tên loại tin',
    			'Ten.unique'=>'Ten the loai da ton tai',
    			'Ten.min'=> 'Tên thể loại phải có độ dài từ 3 đến 100 ký tự',
    			'Ten.max'=> 'Tên thể loại phải có độ dài từ 3 đến 100 ký tự',
                'TheLoai.required'=>'Bạn chưa chọn thể loại'
    		]
    	);
    	$loaitin = new LoaiTin;
    	$loaitin->Ten=$request->Ten;
    	$loaitin->TenKhongDau=changeTitle($request->Ten);
        $loaitin->idTheLoai=$request->TheLoai;
    	$loaitin->save();
    	return redirect('admin/loaitin/them')->with('thongbao','thêm thành công');
    }

    public function getSua($id)
    {
    	$loaitin=loaitin::find($id);
    	return view('admin.loaitin.sua', ['loaitin'=>$loaitin]);
    }

	public function postSua(Request $request, $id)
    {
    	$loaitin=LoaiTin::find($id);
    	// kiem tra cac TH loi co the xay ra
    	$this->validate($request,
    		[
    			'Ten'=>'required|unique:TheLoai,Ten|min:3|max:100'
    		],
    		
    		[
    			'Ten.required'=>'Ban chua nhap ten the loai',
    			'Ten.unique'=>'Ten the loai da ton tai',
    			'Ten.min'=> 'Tên thể loại phải có độ dài từ 3 đến 100 ký tự',
    			'Ten.max'=> 'Tên thể loại phải có độ dài từ 3 đến 100 ký tự',
    		] 
    	);
    	$loaitin->Ten=$request->Ten;
    	$loaitin->TenKhongDau=changeTitle($request->Ten);
    	$loaitin->save();
    	return redirect('admin/loaitin/sua/'.$id)->with('thongbao','sửa thành công');
    } 

    public function getXoa($id)
    {
    	$loaitin=LoaiTin::find($id);
    	$loaitin->delete();
    	return redirect('admin/loaitin/danhsach')->with('thongbao', 'bạn đã xóa thành công');
    }   
}
