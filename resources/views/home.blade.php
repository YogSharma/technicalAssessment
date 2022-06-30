<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Event Crud</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body>
	<div class="container">
		<br>
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
 					<b>Select any one of the options !!!</b></h1>
				</div>
				<div class="row">
					<div class="col-md-4"><a href="{{url('createEvent')}}"><button type="button" class="btn btn-primary">Create Event</button></a></div>
					<div class="col-md-4"></div>
					<div class="col-md-4"><a href="{{url('viewEvent')}}"><button type="button" class="btn btn-primary">View Event</button></a></div>	
				</div><br>		
			</div>
			<div class="col-md-4">
				
			</div>
		</div>
	</div>
</body>
</html>