@extends('admin.layout.index')
@section('content')
<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Slide
                            <small>Thêm</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        <form action="admin/slide/them" method="POST">
                            <input type="hidden" name="_token" value="csrf_token()">
                            
                            <div class="form-group">
                                <label>Tên</label>
                                <input class="form-control" name="Ten" placeholder="Nhập tên slide..." />
                            </div>
                            
                            <div class="form-group">
                                <label>Nội dung</label>
                                <input class="form-control" name="Noidung" placeholder="Nhập nội dung..." />
                            </div>

                            <div class="form-group">
                                <label>Hình</label>
                                <input class="form-control" name="Hinh" type="file" />
                            </div>

                            <div class="form-group">
                                <label>Link</label>
                                <input class="form-control" name="Link" placeholder="Nhập link..." />
                            </div>

                            <button type="submit" class="btn btn-default">Thêm</button>

                            <button type="reset" class="btn btn-default">Reset</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
@endsection