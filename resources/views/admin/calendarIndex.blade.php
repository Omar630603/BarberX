@extends('layouts.admin')
@section('content')

<div class="page-body">
    <div class="card p-3">
        <div class="" style=" display : flex; justify-content: space-evenly; flex-wrap:wrap">
            <div class="calendarContainer px-3" style="width : 50%; height: 100%">
                <div id="calendar" class="mt-4"></div>
                <form action="{{route('calendar.index')}}" style="display:none" id="formDate">
                    <input type="date" id="selectDate" name="tanggal">
                </form>
            </div>
            <div class="penyewaanContainer"
                style="border-left: 1px solid rgb(221, 221, 221); width : 50%; padding: 10px">
                <div class="table-responsive">
                    <h5><b style="color: #00aced"> Reservation In {{$selectDate}} </b>
                    </h5>
                    <table class="table table-hover" style="margin-top: 10px;">
                        <thead>
                            <tr>
                                <th>reservation code</th>
                                <th>tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reservation as $s)
                            <tr>
                                <td>{{$s->reservation_code}}</td>
                                <td>{{$s->reservation_time}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection