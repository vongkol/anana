@extends('layouts.page')
@section('content')
    <style>
    span{
    font-size:15px;
}
.box{
    padding:60px 0px;
}

.box-part{
    border-radius:0;
    margin:30px 0px;
    padding: 25px;
    background: #f5f5f5;
    box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
}

.text{
    margin:20px 0px;
}

</style>
<div class="box">
    <div class="container">
     	<div class="row">
			 
			    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
               
					<a href="{{url('member/account/'.session('member')->id)}}" class="text-primary">
						<div class="box-part text-center">
                        
							<i class="fa fa-user text-warning fa-3x" aria-hidden="true"></i>
							
							<div class="title">
								<h4>My Account</h4>
							</div>
						 </div>
					</a>
				</div>	 
				
				 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
               
					<a href="{{url('member/investment/'.session('member')->id)}}" class="text-primary">
						<div class="box-part text-center">
					    
							<i class="fa fa-dollar text-warning fa-3x" aria-hidden="true"></i>
						
							<div class="title">
								<h4>Investment</h4>
							</div>
						 </div>
					</a>
				</div>	 
				
				 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
               
					<a href="#" class="text-primary">
						<div class="box-part text-center">
                        
							<i class="fa fa-star text-warning fa-3x" aria-hidden="true"></i>
							
							<div class="title">
								<h4>Earning</h4>
							</div>
						 </div>
					</a>
				</div>	 
				
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
               
					<a href="#" class="text-primary">
						<div class="box-part text-center">
                        
							<i class="fa fa-th text-warning  fa-3x" aria-hidden="true"></i>
							
							<div class="title">
								<h4>My Network</h4>
							</div>  
						 </div>
					</a>
				</div>	 
				
				 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
               
					<a href="#" class="text-primary">
						<div class="box-part text-center">
					    
							<i class="fa fa-plane text-warning  fa-3x" aria-hidden="true"></i>
						
							<div class="title">
								<h4>Transactions</h4>
							</div>
						 </div>
					</a>
				</div>	 
				
				 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
               
					<a href="#" class="text-primary">
						<div class="box-part text-center">
                        
							<i class="fa fa-file text-warning  fa-3x" aria-hidden="true"></i>
							
							<div class="title">
								<h4>Terms & Conditions</h4>
							</div>
						 </div>
					</a>
				</div>
		
		</div>		
    </div>
@endsection