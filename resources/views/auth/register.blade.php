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
                    <h4 class="account-titlse">Register to your account</h4> 
                    <form action="{{ route('register') }}" method="POST"> 
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
            </div>
        </div>  
    </div>  
@endsection