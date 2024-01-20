@extends("admin.layout")

@section('meta')
	<title>Reset Password</title>
@endsection

@section('main')
	<section>
		<div style="padding-top:32px;">
			@if(Session::has('failure'))
				<div class="alert alert-danger">
					<i class="fa fa-ban-circle"></i><strong>Failure!</strong> {{Session::get('failure')}}
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			            <img src="{{url('front-end/images/cancel.svg')}}" width="15px" height="15px" style="margin-top: -12px;">
			        </button>
				</div>
			@endif
			@if(Session::has('success'))
				<div class="alert alert-danger">
					<i class="fa fa-ban-circle"></i><strong>Success!</strong> {{Session::get('success')}}
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			            <img src="{{url('front-end/images/cancel.svg')}}" width="15px" height="15px" style="margin-top: -12px;">
			        </button>
				</div>
			@endif
			{{Form::open(array('url' => '/admin/reset-password','class' => 'login-form',"method"=>"POST")) }}
				<div class="row">
					<div class="col-md-4 form-group ">
						{{Form::password('old_password',["class"=>"form-control solid-fill","autocomplete"=>"off","placeholder"=>"Old Password"])}}
						<span class="error">{{$errors->first('old_password')}}</span>	
					</div>

		
					<div class="col-md-4 form-group ">
						{{Form::password('new_password',["class"=>"form-control solid-fill","autocomplete"=>"off","placeholder"=>"New Password"])}}
						<span class="error">{{$errors->first('new_password')}}</span>
						
					</div>

					<div class="col-md-4 form-group ">
						{{Form::password('confirm_password',["class"=>"form-control solid-fill","autocomplete"=>"off","placeholder"=>"Confirm Password"])}}
						<span class="error">{{$errors->first('confirm_password')}}</span>
						
					</div>
				</div>
				
				

				{{csrf_field()}}
		        

		        <div class="form-group mt-5">
					<button type="submit" class="btn btn-primary">
			           	Submit
			        </button>
				</div>
			{{ Form::close() }}
		</div>
	</section>
	
@endsection