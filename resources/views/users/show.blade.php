@extends('main.main')

@section('title' , 'Update Post')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-12">
            <h4>
                User Profile
            </h4>
            <div class="mt-3">
                <div class="row">
                    <div class="col-md-4">



                        <div style="width: 80px ; height : 80px; padding : 5px ; border : 1px solid green; ">

                            @if ($user->image)

                            <img src="http://127.0.0.1:8000/{{$user->image->path}}" alt="profile_img">
                            @endif

                        </div>
                        <!-- <div>
                            <a href="" class="btn btn-info">update profile</a>
                        </div> -->
                    </div>
                    <div class="col-md-8">
                        <div class="card p-2">
                            <div class="d-flex ; gap : 15px ; ">
                                <div style="width : 260px ; display : flex ; justify-content : space-between"><b>User Name</b> <b>:</b></div>
                                <div class="ml-3">
                                    {{ $user->name }}
                                </div>
                            </div>
                            <div class="d-flex ; gap : 15px ; ">
                                <div style="width : 260px ; display : flex ; justify-content : space-between"><b>Email</b> <b>:</b></div>
                                <div class="ml-3">
                                    {{ $user->email }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection