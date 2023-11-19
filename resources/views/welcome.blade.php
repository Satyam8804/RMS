@extends('layouts.app')

@section('content')
<style>

  @import url('https://fonts.googleapis.com/css2?family=Black+Ops+One&display=swap');

    .custom-text {
        color: #fff; 
        font-weight:900;
        font-size:10em;
        font-family:Black,Ops,One; 
        text-transform:uppercase;
    }
    .custom-card {
       
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .custom-list {
        background-color: #ffffff; 
    }
    .custom-list-item {
        border: 1px solid #e1e1e1;
        padding: 10px;
        background-color: #f1c40f; 
        border-radius: 5px;
        margin: 10px;
    }
    .title {
        background: transparent !important;
    }
    .home {
        background: #c4e1c5;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            @auth
            <div class="main">
                <span class="custom-text">{{ Auth::user()->restaurant_name }}</span>
            </div>
            @endauth

            @guest
            <div class="card custom-card">
                <div class="card-header text-center title">
                    <h1 class="card-title">Restaurant Management System</h1>
                </div>
                <div class="card-body">
                    <p class="card-text ">
                        Here's what you can do with our system:
                    </p>
                    <ul class="list-group custom-list">
                        <li class="list-group-item custom-list-item">
                            <h3 class="">Manage Restaurants</h3>
                            - Register and manage restaurants in the system.
                        </li>
                        <li class="list-group-item custom-list-item">
                            <h3 class="">Manage Menu Items</h3>
                            - Add, edit, and update menu items for registered restaurants.
                        </li>
                        <li class="list-group-item custom-list-item">
                            <h3 class="">Track Customer Bills</h3>
                            - View and manage customer bills for all registered restaurants.
                        </li>
                    </ul>
                </div>
            </div>
            @endguest
        </div>
    </div>
</div>
@endsection
