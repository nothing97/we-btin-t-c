<?php
use App\TheLoai;

Route::get('/', function () {     //root/sayhello
    return view('welcome');
});

Route::get('admin/dangnhap', 'UserController@getdangnhapAdmin');
Route::post('admin/dangnhap', 'UserController@postdangnhapAdmin');
Route::get('admin/logout', 'UserController@getLogout');

// Route::get('thu',function(){
// 	return view('admin.theloai.them');
// });


Route::group(['prefix'=>'admin'], function(){

	Route::group(['prefix'=>'theloai'], function(){
		Route::get('danhsach', 'TheLoaiController@getDanhSach');

		Route::get('sua/{id}', 'TheLoaiController@getSua');
		Route::post('sua/{id}', 'TheLoaiController@postSua');

		Route::get('them', 'TheLoaiController@getThem');
		Route::post('them', 'TheLoaiController@postThem');

		Route::get('xoa/{id}', 'TheLoaiController@getXoa');

	});

	Route::group(['prefix'=>'loaitin'], function(){
		Route::get('danhsach', 'LoaiTinController@getDanhSach');

		Route::get('sua/{id}', 'LoaiTinController@getSua');
		Route::post('sua/{id}', 'LoaiTinController@postSua');

		Route::get('them', 'LoaiTinController@getThem');
		Route::post('them', 'LoaiTinController@postThem');

		Route::get('xoa/{id}', 'LoaiTinController@getXoa');
	});

	Route::group(['prefix'=>'tintuc'], function(){
		Route::get('danhsach', 'TinTucController@getDanhSach');

		Route::get('sua/{id}', 'TinTucController@getSua');
		Route::post('sua/{id}', 'TinTucController@postSua');

		Route::get('them', 'TinTucController@getThem');
		Route::post('them', 'TinTucController@postThem');

		Route::get('xoa/{id}', 'TinTucController@getXoa');
	});

	Route::group(['prefix'=>'ajax'], function(){
		Route::get('loaitin/{idTheLoai}', 'AjaxController@getLoaiTin');
	});
	Route::group(['prefix'=>'slide'], function(){
		Route::get('danhsach', 'slideController@getDanhSach');

		Route::get('sua/{id}', 'slideController@getSua');
		Route::post('sua/{id}', 'slideController@postSua');

		Route::get('them', 'slideController@getThem');
		Route::post('them', 'slideController@postThem');

		Route::get('xoa/{id}', 'slideController@getXoa');
	});

	Route::group(['prefix'=>'comment'], function(){
		Route::get('xoa/{id}/{idTinTuc}', 'CommentController@getXoa');
	});

	Route::group(['prefix'=>'user'], function(){
		Route::get('danhsach', 'UserController@getDanhSach');

		Route::get('sua/{id}', 'UserController@getSua');
		Route::post('sua/{id}', 'UserController@postSua');

		Route::get('them', 'UserController@getThem');
		Route::post('them', 'UserController@postThem');

		Route::get('xoa/{id}', 'UserController@getXoa');
	});
});


Route::get('trangchu', 'pagesController@trangchu');
Route::get('lienhe', 'pagesController@lienhe');
Route::get('loaitin', 'pagesController@loaitin');

Route::get('dangnhap', 'pagesController@getDangnhap');
Route::post('dangnhap', 'pagesController@postDangnhap');
Route::post('comment/{id}', 'commentController@postComment');