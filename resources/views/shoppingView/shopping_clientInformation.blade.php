@extends('layouts.client')

@section('content')
<link rel="stylesheet" href="{{ URL::asset('css/client_information.css') }}">
<div class="container">
	@if(isset($btn_nav['next']))
	<form method="POST" action="{{route('contact_post')}}">
        {{ csrf_field() }}
<div class="row">

	<div class="col-8">
 <div class="row">
                                    <div class="col-12">
                                        <h5 class="">Customer Information</h5>
                                    </div>
                                    <div class="col-12">
                                        <hr>
                                    </div>
                                </div>
		<div class="row">
<div class="col-6">

    	<div class="d-flex justify-content-center"><i class="far fa-3x fa-envelope"></i></div>
        <div  class="d-flex justify-content-center"><label>Enter E-mail:</label></div>
        <div ><input class="form-control" name="email" value="{{$contact_info['email']}}" required/></div>
  
    </div>
    <div class="col-6 ">
      
    	<div class="d-flex justify-content-center"><i class="fas fa-3x fa-phone-square"></i></div>
        <div class="d-flex justify-content-center" ><label>Enter the phone number:</label></div>
        <div ><input class="form-control" name="telephone" value="{{$contact_info['telephone']}}" required/></div>

</div>
</div>
@if(isset($customer_type_id) && $customer_type_id==1)
<div class="card company_panel">
	
		<div class="card-header"><h5>Company Information</h5>
		</div>
  <div class="card-body">
		
	
			<div class="row">
<div class="col-4">

    	
        <div  class="d-flex justify-content-center"><label>Company Name:</label></div>
        <div ><input class="form-control" name="company_name" value="{{$contact_info['company_name']}}" required/></div>
  
    </div>
    <div class="col-4 ">
      
    	
        <div class="d-flex justify-content-center" ><label>Company ID:</label></div>
        <div ><input class="form-control" name="company_id" value="{{$contact_info['company_id']}}" required/></div>

</div>
   <div class="col-4 ">
      
    	
        <div class="d-flex justify-content-center" ><label>Taxi ID:</label></div>
        <div ><input class="form-control" name="taxi_id" value="{{$contact_info['taxi_id']}}" required/></div>

</div>
</div> 

</div>
</div>
@endif
        <div class="row buttons_row">
        	<div class="col-6">
        		@if(isset($btn_nav['back']))
        <a href="{{$btn_nav['back']['url']}}" class="form-control col-4 btn btn_back">Backwards</a>
        @endif
        </div>
        <div class="col-6">
        
        <button type="submit" class="form-control col-4 float-right btn btn-light btn_next">Continue</button>
    
    </div>
    </div>
    </div>
  <div class="col-4">
  @include ('layouts.basketcard')
  </div>
</div>


</form>
@endif
</div>
@endsection


