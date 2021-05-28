@extends('layouts.admin')
@section('content')
<table class="table table-hover" id="serviceTable">
    <thead>
        <tr>
            <th>Reservation Code</th>
            <th>Total Price</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($reservationStatus as $rs)
        <tr>
            <td>{{$rs->reservation_code}}</td>
            <td>{{$rs->price}}</td>
            <td>
                <div id="status{{$rs->reservation_status_id}}">
                    @if($rs->status)
                    Done
                    @else
                    Waiting Customer
                    @endif
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection