<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>View Events</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="{{asset('/css/custom.css') }}" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<script async="" src="https://www.google-analytics.com/analytics.js"></script>
	<script src="{{asset('/js/custom.js') }}"></script>
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script
</head>
<body>
	<br>
	<div class="container">
		@csrf
		@if(Session::has('updated'))
	    	<div class="alert alert-success alert-dismissible">
	    		<button type="button" class="close" data-dismiss="alert">&times;</button>
	    		<strong>Success!</strong> {{session('updated')}}
	  		</div>
		@endif
		<div class="row">
			<div class="col-md-4">
		  		<select id="filter">
			    	<option value="1" id="finishedEvent">Finished event</option>
			    	<option value="2" id="upcommingEvent">Upcomming event</option>
			    	<option value="3" id="uCEwithIn7Days">Upcomming event within 7 days</option>
			    	<option value="4" id="fEofLast7Days">Finished event of last 7 days</option>
	  			</select>
  			</div>
			<div class="col-md-4">
				
			</div>
			<div class="col-md-4">
				<div class="row">
					<div class="col-md-4">
						
					</div>
					<div class="col-md-4">
						
					</div>
					<div class="col-md-4">
						<a href="{{url('/')}}"><button class="button button2"><i class="fa fa-angle-double-left"></i> Go Back </button></a>
					</div>

				</div>
			</div>
		</div>
		<table class="table table-striped">
		  	<thead>
		  		
		    	<tr id="heading">
			      <th scope="col">SN</th>
			      <th scope="col">Title</th>
			      <th scope="col">Description</th>
			      <th scope="col">Start date</th>
			      <th scope="col">End date</th>
			      <th scope="col">Update</th>
			      <th scope="col">Delete</th>
		   		</tr>
		   		
		  	</thead>
		  	<tbody id="tbody">
		  		@foreach($events as $event)
		    	<tr>
			      <td scope="col" id="#th1"></td>
			      <td scope="col">{{$event->title}}</td>
			      <td scope="col">{{$event->description}}</td>
			      <td scope="col">{{$event->start_date}}</td>
			      <td scope="col">{{$event->end_date}}</td>
			      <td><a href="{{url('editEvent',['id'=> $event->id])}}"><i class="fa fa-edit" style="font-size:20px;color:blue"></i></a></td>
			      <td><a href="" id="{{$event->id}}" class="delete"><i class="fa fa-trash-o" style="font-size:20px;color:red"></i></a></td>
		    	</tr>
		    	@endforeach
		  	</tbody>
		</table>
	</div>
	<script>

// This is an ajax call for filtering events.

	$(document).ready(function(){
		$('#filter').on('change',function(e){
			e.preventDefault();
			var filter = $(this).val();
			$.ajaxSetup({
   			headers: {
     		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
   				}
			});
			 $.ajax({
			      url: "{{url('viewEvent')}}",
			      type: 'get',
			      data: {'filter':filter},
			      dataType:'json',
			      success: function(response){
			      	console.log(response);
			      	var filter = response.filter;
			      	var html = '';
			      	if(filter.length != 0){
			      		for(let i = 0; i < filter.length;i++){
			      		var k = filter[i]['id'];
			      		html+='<tr>\
			      				<td>'+i+'</td>\
			      				<td>'+filter[i]['title']+'</td>\
			      				<td>'+filter[i]['description']+'</td>\
			      				<td>'+filter[i]['start_date']+'</td>\
			      				<td>'+filter[i]['end_date']+'</td>\</tr>';
			      	}
			      	$('#tbody').html(html);
			      	}
			      }
   			});
		});

// This is an ajax call for detleting event.

		$('.delete').on('click',function(){
			var deleteId = $(this).attr('id');
			$.ajaxSetup({
   			headers: {
     		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
   				}
			});
			 $.ajax({
			      url: "{{url('/viewEvent/delete')}}" + '/' + deleteId,
			      type: 'get',
			      data: {'deleteId':deleteId},
			      dataType:'json'
   			});
		});
	});
</script>
</body>

</html>