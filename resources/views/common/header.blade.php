<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/favicon.ico">
    <link rel="icon" type="image/png" href="./assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>@yield('title')</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,700|Source+Sans+Pro:400,600,700" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <!-- Main CSS -->
    <link href=" {{ asset('./templates/assets/css/main.css') }} " rel="stylesheet" />

    <style>
        .dropdown-menu {
            left: -61%;
        }

        .dropdown-menu:before {
            left: 128px;
        }

        .btn__to__text,
        .btn__to__text:focus,
        .btn__to__text:active {
            background: transparent;
            border: none;
            outline: none;
            margin-left: -5px;
        }
    </style>


</head>

<body>
    <!--------------------------------------
NAVBAR
--------------------------------------->
    <nav class="topnav navbar navbar-expand-lg navbar-light bg-white fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}"><strong>Mhdy</strong></a>
            <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse collapse" id="navbarColor02" style="">
                <ul class="navbar-nav mr-auto d-flex align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('post.create') }}">Create</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./article.html">Culture</a>
                    </li>

                </ul>
                <ul class="navbar-nav ml-auto d-flex align-items-center">
                    <!-- <li class="nav-item highlight">
                        
                    </li> -->

                    <li class="nav-item highlight">

                        <div class="btn-group dropmiddle">
                            <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                @if (Auth::user())
                                {{ Auth::user()->name }}
                                @else
                                login
                                @endif

                            </button>

                            @if (Auth::user())
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('profile.edit')}}">Profile</a>
                                <a class="dropdown-item" href="#">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <button class="btn__to__text" style="cursor: pointer;" type="submit">Log out</button>
                                    </form>
                                </a>
                            </div>
                            @else
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{route('login')}}">login</a>

                            </div>
                            @endif


                        </div>
                    </li>



                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->


    <!--------------------------------------
HEADER
--------------------------------------->
    <div class="container">
        <div class="jumbotron jumbotron-fluid mb-3 pt-0 pb-0 bg-lightblue position-relative">
            <div class="pl-4 pr-0 h-100 tofront">
                <div class="row justify-content-between">
                    <div class="col-md-6 pt-6 pb-6 align-self-center">
                        <h1 class="secondfont mb-3 font-weight-bold">Mhdy is a professional blogging build with Laravel</h1>
                        <p class="mb-3">
                            Beautifully crafted with the latest technologies, SASS & Bootstrap 4.1.3, Mundana is the perfect design for your professional blog. Homepage, post article and category layouts available.
                        </p>
                    </div>
                    <div class="col-md-6 d-none d-md-block pr-0" style="background-size:cover;background-image:url(/templates/assets/img/demo/home.jpg);"> </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Header -->