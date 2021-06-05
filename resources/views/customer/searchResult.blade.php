@extends('layouts.customer')

@section('hero')
<div class="page-header">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<h2>Reservation</h2>
			</div>
			<div class="col-12">
				<a href="">Home</a>
				<a href="">Your Reservation</a>
			</div>
		</div>
	</div>
</div>
@endsection


@section('content')

<div class="" id="reservation{{$r->reservation_id}}" tabindex="-1" role="dialog"
	aria-labelledby="reservation{{$r->reservation_id}}" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<div>
					<h5 class="modal-title" id="exampleModalLongTitle">Detail
						{{$r->customer->name}}'s Reservation</h5>
					<h6 class="mt-3">Code Reservation: <b>{{$r->reservation_code}}</b></h6>
				</div>
				<a style="border-radius:5px" class="btn btn-sm btn-success" href="{{route('printReservationPDF', $r)}}"
					target="_blank" rel="noopener noreferrer">Print
					PDF</a>
			</div>
			<div class="modal-body">
				<div style="border:2px solid rgba(0,0,0,.125); padding: 10px; border-radius: 10px; margin-bottom: 15px">
					<h5 class="modal-title" id="exampleModalLongTitle">Customer</h5>
					<div style="display: flex; justify-content: space-between">
						<ul class="list-group list-group-flush">
							<li class="list-group-item">Name :{{$r->customer->name}}</li>
							<li class="list-group-item">E-Mail :{{$r->customer->email}}</li>
							<li class="list-group-item">Phone :{{$r->customer->phone}}</li>
							<li class="list-group-item">Reservation Time
								:{{$r->reservation_time}}</li>
						</ul>
						<img class="float-right my-2" width="170px" height="170px" style="border-radius: 10%"
							src="{{asset('storage/'.$r->customer->image)}}">
					</div>
				</div>
				<div style="border:2px solid rgba(0,0,0,.125); padding: 10px; border-radius: 10px; margin-bottom: 15px">
					<h5 class="modal-title" id="exampleModalLongTitle">Services</h5>
					<div>
						<ul class="list-group list-group-flush">
							@foreach ($reservationServices as $rS)
							@if ($r->reservation_code == $rS->reservation_code)
							<li style="display: flex; justify-content: space-between" class="list-group-item">
								Service: {{$rS->service->name}}<br>
								Price: {{$rS->service->price}}
								<img width="50px" height="50px" style="border-radius: 10%"
									src="{{asset('storage/'.$rS->service->image)}}"></li>
							@endif
							@endforeach
						</ul>
					</div>
				</div>
				<div style="border:2px solid rgba(0,0,0,.125); padding: 10px; border-radius: 10px">
					<h5 class="modal-title" id="exampleModalLongTitle">Reservation Status</h5>
					<div>
						<ul class="list-group list-group-flush">
							@foreach ($reservationStatus as $rStatus)
							@if ($r->reservation_code == $rStatus->reservation_code)
							<li class="list-group-item">Total: {{$rStatus->price}}</li>
							@if ($rStatus->status)
							<li class="list-group-item">Status: Done</li>
							@else
							<li class="list-group-item">Status: Waiting Customer</li>
							@endif
							@endif
							@endforeach
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

{{-- MODAL --}}
<div class="modal fade" id="reservationEditForm" tabindex="-1" role="dialog"
	aria-labelledby="reservation{{$r->reservation_id}}" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<div>
					<h5 class="modal-title" id="exampleModalLongTitle">Detail
						{{$r->customer->name}}'s Reservation</h5>
					<h6 class="mt-3">Code Reservation: <b>{{$r->reservation_code}}</b></h6>
				</div>
			</div>
			<div class="modal-body">
				<div style="text-align: center">
					<h3 class="main-title">Add New Reservation</h3>
				</div>
				<div class="content-form">
					<form method="post" action="{{ route('reservation.store') }}" id="myForm" enctype="multipart/form-data">
						@csrf
						<h4 class="sub-title">Customer Bio</h4>
						<div class="form-group row">
							<label for="name" class="col-sm-3 col-form-label">Customer Name</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="name" placeholder="Enter Customer Name" name="name">
							</div>
						</div>
						<div class="form-group row">
							<label for="email" class="col-sm-3 col-form-label">E-mail</label>
							<div class="col-sm-9">
								<input type="email" class="form-control" id="email" placeholder="Enter E-mail" name="email">
							</div>
						</div>
						<div class="form-group row">
							<label for="phone" class="col-sm-3 col-form-label">Phone</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="phone" placeholder="Enter Phone" name="phone">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-3 col-form-label" for="image">Photo</label>
							<div class="col-sm-9">
								<button onclick="$('#image').click(); return false;" class="btn btn-sm btn-dark buttonAddPhoto">Add
									Photo</button>
								<input style="display:none" disabled type="text" class="form-control" id="photoCustomer"
									placeholder="Click Add Photo to Add Photo" name="phone">
								<input type="file" style="display:none" class="form-control" id="image" placeholder="Upload Image" name="image">
							</div>
						</div>
						<h4 class="sub-title">Service</h4>
						<div class="form-group row">
							<label for="service_id" class="col-sm-3 col-form-label">Service</label>
							<div class="col-sm-9">
								<div class="checkboxContainer">
									@foreach($service as $s)
									<div class="serviceBiggerBox" style="display: flex">
										<input type="checkbox" id="service{{$s->service_id}}" class="checkboxService" name="service_id[]"
											value="{{$s->service_id}}">
										<div class="col-lg-3 col-md-5 col-sm-6">
											<div class="serviceBox">
												<div class="">
													<img src="{{asset('storage/'.$s->image) }}" alt="Image" width="50px">
												</div>
												<div class="labelService">
													<h2 class="serviceName">{{$s->name}}</h2>
													<h3 class="servicePrice">R{{$s->price}}</h3>
												</div>
											</div>
										</div>
									</div>
									@endforeach
								</div>
							</div>
						</div>
						<div class="form-group row">
							<label for="reservation_time" class="col-sm-3 col-form-label">Reservation Time</label>
							<div class="col-sm-9">
								<input type="datetime-local" class="form-control" id="reservation_time" placeholder="Enter Reservation Time"
									name="reservation_time">
							</div>
						</div>
						<input type="text" name="customer" value="1" style="display: none">
						<div>
							<button type="submit" class="btn-reservation">Reserve</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<div class = "buttonContainer" style="display: flex; justify-content: center">
		<a data-target = "#reservationEditForm" data-toggle = "modal" type="button" class = " button-edit">
			Edit Reservation
		</a>
		<form action="{{ route('reservation.destroy', $r) }}" method="POST">
		@csrf
		@method('DELETE')
			<input type="hidden" name="customer" value = "1" id="">
			<button class = " button-delete" >
				Delete Reservation
			</button>
	</form>
</div>

@endsection