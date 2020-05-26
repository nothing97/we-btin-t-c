@extends('layout.index')
@section('content')
<div class="container">

    	<div class="row carousel-holder">
            <div class="col-md-4" style="margin-left: 350px;margin-top: 80px">
                <div class="panel panel-primary" >
						@if(count($errors)>0)
                            <div class="alert alert-danger">
                                @foreach($errors-> all() as $err)
                                    {{$err}}<br>
                                @endforeach
                            </div>
                        @endif
                        
                        @if(session('thongbao'))
                            <div class="alert alert-success">
                                {{session('thongbao')}}
                            </div>
                        @endif

				  	<div class="panel-heading">Đăng nhập</div>
				  	<div class="panel-body">
				    	<form action="dangnhap" method="post">
				    		<input type="hidden" name="_token" value="{{csrf_token()}}">
							<div>
				    			<label>Email</label>
							  	<input type="email" class="form-control" placeholder="Email" name="email" 
							  	>
							</div>
							<br>	
							<div>
				    			<label>Mật khẩu</label>
							  	<input type="password" class="form-control" name="password">
							</div>
							<br>
							<button type="button" class="btn btn-success " style="margin-left: 120px">Đăng nhập
							</button>
				    	</form>
				  	</div>
				</div>
            </div>
        </div>
        <!-- end slide -->
    </div>
@endsection
