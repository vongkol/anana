@extends('layouts.page')
@section('content')
    <style>
    span{
    font-size:15px;
}
.box{
    padding:60px 0px;
    background: #212529;
}

.box-part{
    background:#212529;
    border-radius:0;
    color: #fff;
    margin:30px 0px;
    padding: 25px;
    box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
}

.box-part:hover {
   
}
.text{
    margin:20px 0px;
}

</style>
<div class="box">
    <div class="container">
     	<div class="row">
			 
			    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
               
					<div class="box-part text-center">
                        
                        <i class="fa fa-instagram fa-3x" aria-hidden="true"></i>
                        
						<div class="title">
							<h4 class="text-warning">Instagram</h4>
						</div>
					 </div>
				</div>	 
				
				 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
               
					<div class="box-part text-center">
					    
					    <i class="fa fa-twitter text-warning fa-3x" aria-hidden="true"></i>
                    
						<div class="title">
							<h4>Twitter</h4>
						</div>
					 </div>
				</div>	 
				
				 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
               
					<div class="box-part text-center">
                        
                        <i class="fa fa-facebook fa-3x" aria-hidden="true"></i>
                        
						<div class="title">
							<h4>Facebook</h4>
						</div>
					 </div>
				</div>	 
				
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
               
					<div class="box-part text-center">
                        
                        <i class="fa fa-pinterest-p fa-3x" aria-hidden="true"></i>
                        
						<div class="title">
							<h4>Pinterest</h4>
						</div>  
					 </div>
				</div>	 
				
				 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
               
					<div class="box-part text-center">
					    
					    <i class="fa fa-google-plus fa-3x" aria-hidden="true"></i>
                    
						<div class="title">
							<h4>Google</h4>
						</div>
					 </div>
				</div>	 
				
				 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
               
					<div class="box-part text-center">
                        
                        <i class="fa fa-github fa-3x" aria-hidden="true"></i>
                        
						<div class="title">
							<h4>Github</h4>
						</div>
					 </div>
				</div>
		
		</div>		
    </div>
@endsection