@extends('layouts.auth')

@section('content')
    <div >
        <div class="row m-0 p-0 " style="min-height: 100vh">
            <div class="col-md-6 text-white  align-items-center d-flex  p-4  card-cover" style="background:linear-gradient(#00000310, #00000056) ,url('{{ asset('public/asset/images/login_bg.jpg') }}');  ">
                <h3 class="display-4"><b>EG1 Inventory Management System</b></h3>
            </div>
            <div class="col-md-6 py-md-5 py-3 px-lg-5">
                <div class="p-3   text-center"> 
                    <img src="{{ asset('public/asset/images/logo/logo.png') }}" alt="q">
                    <h4 class="account-titlse">Login to your account</h4> 
                    <form action="{{ route('login') }}" method="POST"> 
                        @csrf
                        <div class="form-group mb-2">
                            <label>User ID</label>
                            <div>
                                <div class="btn-group d-flex bg-white rounded-pill shadow border">
                                    <i class="fa fa-user btn bg-lmight rounded-pill m-1 text-secondary" style="font-size: 25px"></i>
                                    <input name="user_login_id" class=" form-control-lg  form-control rounded-pill m-1 border-0 bg-light ms-0" placeholder="Type here .." type="password">
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary p-2 px-3 rounded-pill" type="submit"><i class="bi bi-box-arrow-in-right me-1"></i>Login</button>
                    </form>
                </div>
                <div class="text-center my-2 ">
                    <small>----- OR ----</small>
                </div><br>
                <div style="width: 350px " class="mx-auto p-3 border rounded-5 bg-white shadow-hover text-center align-items-center d-flex justify-content-center">
                    <div>
                        <h4 class="account-titlse m-0">Login via your barcode</h4>
                        <img class="my-2" width="300px" src="https://lh3.googleusercontent.com/EASWqGp10M-RQANx9krxrmGHuH0_u6Jy_9lN9JPJhuFRDVKe8KrgEXGkOW8Yorum5tyg-vrx-cg0L5vy-t-7dFEg0eiwfyC7xJZ5WqUT=s660" alt="">
                        <p class="m-0  ">SCAN WITH YOUR BARCODE TO LOG IN</p>
                    </div>
                </div> 
            </div>
        </div> 

    </div> 
    {{-- <div class="card-cover" style="background:url('{{ asset('public/asset/images/banner_bg_login.jpg') }}'); background-position: -336px center !important;">
        <div class="row container h-100 align-items-center d-flex justify-content-center" style="min-height: 100vh;">
            <div class="col-md-4 offset-8 h-100">
                <form action="{{ route('dashboard') }}">
                    <div class="form-group mb-2">
                        <label class="text-white font-20 ps-3 mb-2">User ID :</label>
                        <div class="mb-2">
                            <div class="btn-group d-flex bg-white rounded-pill shadow border">
                                <i class="fa fa-user btn bg-lmight rounded-pill m-1 text-secondary" style="font-size: 25px"></i>
                                <input class="form-control form-control-lg rounded-pill m-1 border-0 bg-light ms-0" placeholder="Type here .." type="password">
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary p-3 form-control rounded-pill mt-2" type="submit"><i class="bi bi-box-arrow-in-right me-1"></i>Login</button>
                </form>
            </div>
        </div>
    </div> --}}
@endsection