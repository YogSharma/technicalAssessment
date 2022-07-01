<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Event Crud</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<script async="" src="https://www.google-analytics.com/analytics.js"></script>
	<script src="{{asset('/js/custom.js') }}"></script>
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
	<br>
	<div class="container" style="background-image: url('image/event.jpg');">
		<div class="row">
			<div class="col-md-4">
				<div class="row">
					<div class="col-md-4">
						
					</div>
				</div>
			</div>
			<div class="col-md-4" style="background-color: #99b3ff;box-shadow: 10px 10px 15px black;">
  						<div class="w3-panel w3-pink">
  							<h1 class="w3-text-black"style="font-size: 1em; text-align: center !important;">
 							<b>Please Fill Up The Form</b></h1>
						</div>

						@if(Session::has('success'))
	    					<div class="alert alert-success alert-dismissible">
	    						<button type="button" class="close" data-dismiss="alert">&times;</button>
	    						<strong>Success!</strong> {{session('success')}}
	  						</div>
						@endif
						 
			<!-- Form to creating event. -->

				<form style="font-family: Georgia, serif;" action="{{url('/')}}/createEvent" method="post">
					@csrf
			  		<br><div class="form-group">
				    	<label>Title</label>
				    	<input type="title" name='title'class="form-control" id="title" placeholder="Enter the event title" value="{{old('title')}}"required>
				    	<span class="text-danger" style="background-color:#e0e0eb;">
				    		@error('title')
				    			{{$message}}
				    		@enderror
				    	</span>
			  		</div>
			  		<div class="form-group">
			  			<label>Description</label>
			  			<textarea name="description" class="form-control" id="textArea" rows="3" value="{{old('description')}}"required></textarea>
			  			<span class="text-danger" style="background-color:#e0e0eb;">
				    		@error('description')
				    			{{$message}}
				    		@enderror
				    	</span>
			  		</div>
			  		<div class="form-group">
				    	<label>Start Date</label>
				    	<input type="date" name='start_date'class="form-control" id="stDate" placeholder="Start Date" value="{{old('start_date')}}" required>
				    	<span class="text-danger" style="background-color:#e0e0eb;">
				    		@error('start_date')
				    			{{$message}}
				    		@enderror
				    	</span>
			  		</div>
			  		<div class="form-group">
				    	<label>End Date</label>
				    	<input type="date" name='end_date' class="form-control" id="enDate" placeholder="End Date" value="{{old('end_date')}}"required>
				    	<span class="text-danger" style="background-color:#e0e0eb;">
				    		@error('end_date')
				    			{{$message}}
				    		@enderror
				    	</span>
			  		</div>
			  		<div class="row">
					<div class="col-md-4"><button class="btn btn-primary">Submit</button></div>
					<div class="col-md-4"></div>
					<div class="col-md-4"><a href="{{url('/')}}"><button type="button" class="btn btn-primary">Go Back</button></a></div>	
					</div><br>
				</form><br>

			<!-- End of form for creating event. -->

			</div>
			<div class="col-md-4">
				
			</div>
		</div>
	</div>
</body>
</html>