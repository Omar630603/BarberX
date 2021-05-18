@extends('layouts.admin')
@section('content')
<div>
    @if ($message = Session::get('fail'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Failed!!</strong><span> {{ $message }}</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @elseif ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!!</strong><span> {{ $message }}</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            &times;
        </button>
    </div>
    @endif
</div>
<div class="page-body">
    <div class="card">
        <div class="mt-3 ml-3">
            <div class="page-header-title">
                <i class="icofont icofont-table bg-c-blue"></i>
                <div class="d-inline">
                    <h4>Reservation List</h4>
                    <span>Here is the list of Reservations in BarberX</span>
                </div>
            </div>
        </div>
        <div class="card-header">
            <div class="card-header-right">
                <ul class="list-unstyled card-option">
                    <li><i class="icofont icofont-simple-left "></i></li>
                    <li><i class="icofont icofont-maximize full-card"></i></li>
                    <li><i class="icofont icofont-minus minimize-card"></i></li>
                    <li><i class="icofont icofont-refresh reload-card"></i></li>
                    <li><i class="icofont icofont-error close-card"></i></li>
                </ul>
            </div>
        </div>
        <div class="card-block table-border-style">
            <div id="header-content">
                <div class="d-flex mx-3 mb-3" style="justify-content:space-between !important">
                    <div class="pcoded-search" id="search" style="width: 500px !important;">
                        <span class="searchbar-toggle"></span>
                        <form method="get" action="{{ route('reservation.index') }}">
                            @csrf
                            <div class="pcoded-search-box d-flex">
                                <input name="search" type="text" class="mr-3" placeholder="Search">
                                <span>
                                    <button class="btn btn-info"><i class="ti-search"></i></button>
                                </span>
                            </div>
                        </form>
                    </div>
                    <button class="btn btn-primary ml-3" onclick="showFormAddReservation(); return false;"><i
                            class="ti-plus"></i>Add Data</button>
                </div>
            </div>


            {{-- Add Data --}}
            <div class="mx-3" style="display:none;" id="formAddReservation">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <h4 class="mb-3">New Customer</h4>
                <form method="post" action="{{ route('reservation.store') }}" id="myForm" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label">Customer Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="name" placeholder="Enter Customer Name"
                                name="name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-3 col-form-label">E-mail</label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" id="email" placeholder="Enter E-mail" name="email">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone" class="col-sm-3 col-form-label">Phone</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="phone" placeholder="Enter Phone" name="phone">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label" for="image">Photo</label>
                        <div class="col-sm-8">
                            <input type="file" class="form-control" id="image" placeholder="Upload Image" name="image">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="service_id" class="col-sm-3 col-form-label">Service</label>
                        <div class="col-sm-8">
                            <select name="service_id" id="category_service_id" class="form-control">
                                @foreach($service as $s)
                                <option value="{{$s->service_id}}">{{$s->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="reservation_time" class="col-sm-3 col-form-label">Phone</label>
                        <div class="col-sm-8">
                            <input type="datetime-local" class="form-control" id="reservation_time"
                                placeholder="Enter Reservation Time" name="reservation_time">
                        </div>
                    </div>
                    <div>
                        <a type="button" id="close" class="btn btn-primary btn-outline-primary"
                            onclick="hideForm()">Back</a>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>


            {{-- Table --}}
            <div class="table-responsive">
                <table class="table table-hover" id="reservationTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Reservation Code</th>
                            <th>Customer</th>
                            <th>Service</th>
                            <th>Reservation Time</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @foreach($reservation as $r)
                        <tr>
                            <th scope="row">{{$no++}}</th>
                            <td>{{$r->reservation_code}}</td>
                            <td>{{$r->customer->name}}</td>
                            <td>{{$r->service->name}}</td>
                            <td>{{$r->reservation_time}}</td>
                            <td style="display: flex">
                                <a type="button" class="btn btn-warning"
                                    href="{{ route('reservation.edit', $r->reservation_id) }}"><i
                                        class="ti-marker-alt"></i></a>
                                <form style="margin-left: 5px"
                                    action="{{ route('reservation.destroy', $r->reservation_id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"><i class="ti-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    function showFormAddReservation(){
        console.log('OK')
        var formAdd = document.getElementById('formAddReservation');
        var csTable = document.getElementById('reservationTable');
        var header = document.getElementById('header-content')
        console.log(header)
        if (formAdd.style.display === "none") {
            formAdd.style.display = "";
            csTable.style.display = "none";
            header.style.display= "none";
        } else {
            formAdd.style.display = "none";
            csTable.style.display = "";
            header.style.display = "block";
        }
    }

    function hideForm(){
        console.log('OK')
        var formAdd = document.getElementById('formAddReservation');
        var csTable = document.getElementById('reservationTable');
        var header = document.getElementById('header-content')
        if (formAdd.style.display === "") {
            formAdd.style.display = "none";
            csTable.style.display = "";
            header.style.display= "";
        }
    }
</script>
@endsection