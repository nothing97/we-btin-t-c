<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\TheLoai;
use App\LoaiTin;
use App\TinTuc;
use App\Comment;

class TinTucController extends Controller
{	
    public function getDanhSach()
    {
    	$tintuc= TinTuc::orderby('id', 'DESC') ->get();
    	return view('admin.tintuc.danhsach',['tintuc'=>$tintuc]);
    }

    public function getThem()
    {
        $theloai=TheLoai::all();
        $loaitin=LoaiTin::all();
    	return view('admin.tintuc.them',['theloai'=> $theloai, 'loaitin'=> $loaitin]);	
    }

    public function postThem(Request $request)
    {
    	$this->validate($request, 
    		[	
                'LoaiTin'=>'required',
    			'TieuDe'=>'required|unique:TinTuc,TieuDe| min:3',
                'TomTat'=>'required',
                'NoiDung'=>'required'
    		],

    		[
    			'LoaiTin.required'=>'Bạn chưa chọn loại tin',
    			'TieuDe.required'=>'Bạn chưa nhập tiêu đề',
    			'TieuDe.min'=> 'Tiêu đề phải có ít nhất 3 ký tự',
    			'TieuDe.unique'=> 'Tiêu đề đã tồn tại',
                'TomTat.required'=> 'Bạn chưa nhập tóm tắt',
                'NoiDung.required'=> 'Bạn chưa nhập nội dung'
    		]);

    	$tintuc = new TinTuc;
    	$tintuc->TieuDe=$request->TieuDe;
    	$tintuc->TieuDeKhongDau=changeTitle($request->TieuDe);
        $tintuc->idLoaiTin=$request->LoaiTin;
        $tintuc->TomTat=$request->TomTat;
        $tintuc->NoiDung=$request->NoiDung;
        $tintuc->SoLuotXem=0;
        

        /*if($request-> hasfile('Hinh'))
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
        }*/
        

    	$tintuc->save();
    	return redirect('admin/tintuc/them')->with('thongbao','thêm thành công');
    }

    public function getSua($id)
    {
        $theloai=TheLoai::all();
        $loaitin=LoaiTin::all();

    	$tintuc=TinTuc::find($id);
    	return view('admin.tintuc.sua', ['tintuc'=>$tintuc, 'theloai'=>$theloai, 'loaitin'=>$loaitin]);
    }

	public function postSua(Request $request, $id)
    {
    	$tintuc=TinTuc::find($id);
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
    	$tintuc->Ten=$request->Ten;
    	$tintuc->TenKhongDau=changeTitle($request->Ten);
    	$tintuc->save();
    	return redirect('admin/tintuc/sua/'.$id)->with('thongbao','sửa thành công');
    } 

    public function getXoa($id)
    {
    	$tintuc=TinTuc::find($id);
    	$tintuc->delete();
    	return redirect('admin/tintuc/danhsach')->with('thongbao', 'bạn đã xóa thành công');
    }   
}
