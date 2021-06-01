@extends('layouts.admin')
@section('content')
<div class="page-body">
    <div class="card">
        <h3 class="mt-5 ml-5 main-title">{{$user->name}}'s Profile</h3>
        <div class="p-3" style="justify-content:space-around">
            {{-- Form To edit Information --}}
            <div id="formEdit" style="display: none" class="collapse my-4">
                <div class="d-flex">
                    <div class=" imageContainer py-5" style="width: 45% !important; justify-content: center;">
                        <div style="display: flex; justify-content: center">
                            <img src="{{asset('storage/'.$user->image) }}" width="260px" alt=""
                                style="border-radius: 50%">
                        </div>
                        <center><a href="#" type="button" class="btn btn-sm btn-danger mt-3" id="triggerChange"
                                onclick="$('#imageInput').show()">Change
                                Picture</a></center>
                        <center>
                            <form style="display:none" method="post"
                                action="{{route('user.updateImage', $user->user_id)}}" id="imageInput"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="file" name="image">
                                <button class="btn btn-sm btn-primary">Submit</button>
                                <a href="#" class="btn btn-sm" onclick="$('#imageInput').hide()">
                                    &times;</a>
                            </form>
                        </center>
                    </div>
                    <div id="bio-container" class="p-5"
                        style="border-left: 1.5px solid rgb(216, 214, 214); width: 55% !important;">
                        <form method="post" action="{{route('user.updateBio', $user->user_id)}}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name" class="col-form-label">Name</label>
                                <div class="">
                                    <input type="text" class="form-control" id="name" value="{{$user->name}}"
                                        name="name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-form-label">Email</label>
                                <div class="">
                                    <input type="email" class="form-control" id="email" value="{{$user->email}}"
                                        name="email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-form-label">Password</label>
                                <div class="">
                                    <input type="password" class="form-control" id="password"
                                        value="{{$user->password}}" name="password">
                                </div>
                            </div>
                            <a href="#" class="btn btn-sm btn-primary btn-outline-primary mt-3"
                                onclick="$('#formEdit').hide(); $('#info-bio').show(); return false;">Cancel</a>
                            <button class="btn btn-sm btn-primary  mt-3">Submit</button>
                        </form>

                    </div>
                </div>
            </div>


            {{-- Biodata Informastion --}}
            <div id="info-bio">
                <div class="d-flex">
                    <div class=" imageContainer py-5" style="width: 45% !important; justify-content: center;">
                        <div style="display: flex; justify-content: center">
                            <img src="{{asset('storage/'.$user->image) }}" width="280px" alt=""
                                style="border-radius: 50%">
                        </div>
                    </div>
                    <div id="bio-container" class="p-5"
                        style="border-left: 1.5px solid rgb(216, 214, 214); width: 55% !important;">
                        <h5 class="title-profile">Name:</h5>
                        <p class="content-profile">{{$user->name}}</p>
                        <hr>
                        <h5 class="title-profile">Email:</h5>
                        <p class="content-profile">{{$user->email}}</p>
                        <hr>
                        <h5 class="title-profile">Password:</h5>
                        <p class="content-profile">{{$user->password}}</p>
                        <hr>
                        <div>
                            <button class="btn btn-sm btn-primary"
                                onclick="$('#formEdit').show(); $('#info-bio').hide(); return false;">Edit
                                Profile</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection