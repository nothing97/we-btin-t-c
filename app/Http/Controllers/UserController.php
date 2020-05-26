<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\support\facades\Auth;
use App\Http\Requests;
use App\User;

class UserController extends Controller
{	
    public function getDanhSach()
    {
        $user=User::all();
        return view ('admin.user.danhsach', ['user'=>$user]);
    }

    public function getThem()
    {
        return view('admin.user.them');
    }

    public function postThem(Request $request)
    {
        $this ->validate($request, 
        [
            'name'=>'required|min:3',
            'email'=>'required|email|unique:user, email',
            'password'=>'required|min:3|max:32',
            'passwordAgain'=>'required|same:password'
        ],

        [
            'name.required'=>'Bạn chưa nhập tên',
            'name.min'=>'Tên người dùng phải có ít nhất 3 ký tự',
            'email.required'=>'Bạn chưa nhập email',
            'email.email'=>'Bạn chưa nhập đúng định dạng email',
            'email.unique'=>' email đã tồn tại',
            'password.required'=>'Bạn chưa nhập pasword',
            'password.min'=>'mật khẩu quá ngắn',
            'password.max'=>'mật khẩu không quá 32 kí tự',
            'passwordAgain.required'=>'Bạn chưa nhập lại mật khẩu',
            'passwordAgain.same'=>'Mật khẩu nhập lại chưa khớp',
        ]);

        $user= new User;
        $user->name = $request->name;
        $user->email = $request->amail;
        $user->password = bcrypt($request->password);
        $user->quyen = $request->quyen;
        $user->save();
        return redirect('admin/user/them')->with('thongbao', 'Bạn đã thêm thành công');
    }




        /*if (Auth::attempt(['email'=>$request->email, 'password'=>$request->password]))
        {
            return redirect('admin/theloai/danhsach');
        } 
        else
        {
            return redirect('admin/ dangnhap')->with('thongbao', 'Đăng nhập thành công');
        }*/
    

    public function getDangNhapAdmin()
        {
            return view ('admin.login');
        }

   public function postDangNhapAdmin(Request $request)
   {
        $this ->validate($request, 
        [
            'email'=>'required',
            'password'=>'required|min:3|max:32'
        ],

        [
            'email.required'=>'Bạn chưa nhập email',
            'password.required'=>'Bạn chưa nhập pasword',
            'password.min'=>'mật khẩu quá ngắn',
            'password.max'=>'mật khẩu không quá 32 kí tự',
        ]

        );

        if (Auth::attempt(['email'=>$request->email, 'password'=>$request->password]))
        {
            return redirect('admin/theloai/danhsach');
        } 
        else
        {
            return redirect('admin/ dangnhap')->with('thongbao', 'Đăng nhập thành công');
        } 
    }

    public function getLogout()
    {
        Auth::logout();
        return redirect ('admin/dangnhap');
    }
}
