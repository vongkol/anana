@extends('layouts.security')
@section('content')
<body class="my-login-page my-sign-up main-page-login">
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center  h-100">
				<div class="card-wrapper">
					<div class="card fat">
						<div class="card-body">
							<h4 class="card-title">Sign Up</h4>
							<hr>
							
							@if(Session::has('sms1'))
								<div class="alert alert-danger" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									<div>
										{{session('sms1')}}
									</div>
								</div>
							@endif
							@if ($errors->any())
								<div class="alert alert-danger" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									<ul>
										@foreach ($errors->all() as $error)
											<li>{{ $error }}</li>
										@endforeach
									</ul>
								</div>
							@endif
							<?php
								$countries = DB::table('countries')->orderBy('name')->get();
							?>
							<form method="POST" action="{{url('/member/register')}}" name="frm" id="frm">
								{{csrf_field()}}
								<div class="form-group row">
									<div class="col-md-6">
										<label>
											<strong>Sponsor ID</strong>
											<input type="text" class="form-control" name="sponsor_id" value="{{$sponsor_id}}">
										</label>
									</div>
									<div class="col-md-6">
										<label for="">
											<strong>Full Name <span class="text-danger">*</span></strong>
											<input type="text" class="form-control" required autofocus name="full_name" value="{{old('full_name')}}">
										</label>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-md-6">
										<label for="">
											<strong>Username <span class="text-danger">*</span></strong>
											<input type="text" class="form-control" required name="username" value="{{old('username')}}">
										</label>
									</div>
									<div class="col-md-6">
										<label for="">
											<strong>Email <span class="text-danger">*</span></strong>
											<input type="email" class="form-control" required name="email" value="{{old('email')}}">
										</label>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-md-6">
										<label for="">
											<strong>Phone </strong>
											<input type="text" class="form-control" name="phone" value="{{old('phone')}}">
										</label>
									</div>
									<div class="col-md-6">
										<label for="">
											<strong>Country <span class="text-danger">*</span> </strong>
											<select name="country" id="country" class="form-control">
												@foreach($countries as $c)
													<option value="{{$c->name}}">{{$c->name}}</option>
												@endforeach
											</select>
										</label>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-md-6">
										<label for="">
											<strong>Password <span class="text-danger">*</span> </strong>
											<input type="password" class="form-control" name="password" required value="{{old('password')}}">
										</label>
									</div>
									<div class="col-md-6">
										<label for="">
											<strong>Confirm Password <span class="text-danger">*</span> </strong>
											<input type="password" class="form-control" name="cpassword" required>
										</label>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-md-12">
										<label for="">
											<strong>Security PIN <span class="text-danger">*</span> </strong>
											<input type="password" class="form-control" name="security_pin" required value="{{old('security_pin')}}">
										</label>
									</div>
								</div>
							
								<div class="form-group no-margin">
									<button type="button" class="btn btn-learn btn-primary btn-block" data-toggle="modal" data-target=".bd-example-modal-lg">
										Continue
									</button>
								</div>
								<div class="margin-top20 text-center">
									Already have an account? <a href="{{url('sign-in')}}">Sign In</a>
								</div>
							</form>
							</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Terms and Conditions</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		Lorem, ipsum dolor sit amet consectetur adipisicing elit. 
		Similique et rerum quia praesentium facilis quas. Autem, 
		quae provident libero expedita, rem ipsa dolore, dolorem aliquid 
		asperiores illum minima obcaecati dicta magnam facilis! Dolor quas, 
		illum ipsam, modi error ratione tenetur expedita mollitia libero voluptates 
		quibusdam rem nihil quod esse consequatur vitae aperiam maiores 
		at reiciendis veritatis perspiciatis excepturi odio! Accusantium 
		assumenda animi odio optio fugiat explicabo est nulla! Reiciendis 
		architecto voluptas esse laborum expedita quisquam tempore iure 
		asperiores, placeat cupiditate accusantium explicabo veritatis fuga, 
		optio, animi officiis quasi eligendi doloribus officia dolores sit 
		ducimus inventore molestias. Sit atque ea ipsam cupiditate nesciunt 
		maxime velit laudantium laboriosam placeat sint soluta officia 
		explicabo repellat ratione iure ad, vero eum sapiente dolore consequuntur 
		architecto nisi enim aperiam? Architecto deserunt, perspiciatis voluptatem 
		veritatis tenetur illo labore quo laudantium velit distinctio fugit 
		voluptate perferendis hic aspernatur accusantium repellendus reprehenderit 
		sunt cumque quae ullam praesentium id?
		<p>
			Lorem ipsum dolor sit amet consectetur adipisicing elit. Explicabo tenetur deserunt quod dolor, culpa cupiditate ab quia voluptates dolore quam. Voluptatem laborum quisquam architecto nulla neque sapiente praesentium, tenetur recusandae. Quas, doloremque quia veniam temporibus fugit sequi est deserunt laboriosam eos esse ab quos asperiores aliquid quae voluptatibus atque enim, nemo voluptas odio ipsam illum! Optio, natus? Temporibus error consequatur, pariatur atque ipsum sequi harum ea maxime eligendi? Voluptates nostrum sed corporis alias sint deserunt ea placeat culpa esse, quo, nihil illum, blanditiis iste. Veniam laborum velit ab dolores animi sit aperiam numquam sequi commodi non suscipit voluptate eveniet doloremque sunt optio, dolore aspernatur soluta alias. Excepturi facere aut tempora ab qui ipsum blanditiis natus possimus est expedita distinctio veniam odio cupiditate eaque, ut ea explicabo hic beatae, sapiente, soluta delectus quisquam placeat? Architecto, provident itaque? Incidunt temporibus amet molestias dolor, magnam non, ab doloribus illo obcaecati quam laboriosam repudiandae molestiae quidem, dolorum sapiente error. Dignissimos atque commodi rerum non, voluptatibus excepturi praesentium reiciendis recusandae. Assumenda, ullam esse reiciendis cum modi in possimus atque quas eaque consectetur ducimus nobis quos iusto vitae sit impedit fugit perspiciatis corrupti unde placeat minima sint earum. Amet dolores dolore veniam atque beatae nostrum sunt!
		</p>
		<p>
			Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste autem dolor quae natus nesciunt incidunt. Veniam, ad, libero error et eligendi maxime sunt officiis perferendis vero doloribus molestiae aperiam neque commodi, repellat ipsum temporibus ipsam ullam odit quae architecto nisi dolor dolores possimus quaerat. Quidem reprehenderit libero exercitationem recusandae quos hic pariatur, harum cum ducimus ipsam. Eos est harum doloremque suscipit autem error ex, ducimus, assumenda repudiandae unde earum ipsum, quis at eligendi? Expedita dolore, deleniti sed omnis blanditiis eligendi eum impedit inventore corporis aliquam cum? Nulla ut porro accusamus. Non a quos earum reiciendis corrupti blanditiis delectus voluptas. Eum illum asperiores neque maxime enim eius aut, molestiae laudantium expedita architecto quidem temporibus possimus qui, placeat repellendus explicabo in officia impedit consectetur esse vel voluptas non rem incidunt? Ullam commodi hic porro possimus quia consectetur et eius vero tempora dicta doloremque, eos, minus dolore enim culpa sunt magnam ea amet.
		</p>
      </div>
	  
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal" id="btn">I have read and agreed.</button>
      </div>

    </div>
  </div>
</div>


@endsection
@section('js')
	<script>
		$(document).ready(function(){
			$("#btn").click(function(){
				$("#frm").submit();
			});
		});
	</script>
@stop