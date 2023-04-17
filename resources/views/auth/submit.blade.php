@extends('layouts.app')

@section('content')
@php
    $data = session('data');
@endphp
<div class="login_page">
    
    <div class="container po">
        
        <div class="row justify-content-center">
            
            <div class="col-12 col-md-6 col-lg-5 login_page_main_all">
                @if (session()->has('error'))
                    <div class="alert alert-danger" role="alert">
                        {{session('error')}}
                  </div>
                @endif
                @if (session()->has('msg'))
                    <div class="alert alert-success" role="alert">
                        {{session('msg')}}
                    </div>
                @endif
               
                
                <div class="login_page_main">
                    <div class="login_logo">
                         <img src="{{'/uploads/login_logo.png'}}" alt="">
                    </div>                 
                  <!--   <p class="login_page_main_title text_center">SIGN IN</p> -->
                    <div class="card-body">
                        <form method="POST" action="{{ url('/change-Password') }}" aria-label="{{ __('Login') }}">
                            @csrf

                            <div class="form-group input_group">
                                <div class="input_group_input">
                                    <input id="code" type="text" placeholder="Enter 4 digit Code" class="form-control{{ $errors->has('code') ? ' is-invalid' : '' }}" name="code" value="{{ old('code') }}" required autofocus>
                                </div>
                            </div>
                            <input  type="hidden"  name="username" value="{{ $data['username'] }}" >
                           
                            <div class="form-group">
                                <div class="text_center log_button">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Submit') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

           <!--  <p class="copy_right">COPYRIGHTS DREAMS GALLERY</p> -->
        </div>
    </div>
</div>
@endsection
<style>
/*============= login page ============*/
.login_page {
    background: #f3f3f359;
    position: fixed;
    width: 100%;
    height: 100vh;
    top: 0;
    left: 0;
    z-index: 1;
}
.login_page_main {
    background: #000;
    border-radius: 10px;
    padding: 50px 0px 0px 0px;
    margin: 0px 30px;
}
    .login_page_main_title {
    font-size: 23px;
    color: #333;
    letter-spacing: 5px;
}
    .input_group {

}
.input_group_input input:focus{
    background: #fff;
    outline:none !important;
    border:none !important;
    box-shadow:none !important;
}
.log_button button:focus{
    box-shadow:none !important;
}
input:focus{

}
.input_group_input input {
   /* border-radius: 48px;*/
    height: 39px;
    background: #fff;
    border: none;
    padding:0 15px;
    font-size: 13px;
}
.input_group_title {
    padding: 0 0 5px 13px;
    opacity: .7;
    font-size: 15px;
}
.input_group_input{}
.input_group_button{}
.log_forget_pass {
    text-align: right;
    margin: -10px 12px 0 0;
    opacity: .7;
    color: #fff;
}
.text_center{
    text-align: center;
}
.log_button {
    margin: 18px 0 0;
}


.log_button button:hover{
    border:none;
    background-color: #ee3333;
}
.log_button button {
    /* border-radius: 34px; */
    padding: 11px 58px 10px;
    text-transform: uppercase;
    font-size: 13px;
    letter-spacing: 2px;
    border: none;
    background: #939393;
    width: 100%;
}
.btn{
    border-radius: 34px;
    padding: 7px 32px 6px;
    text-transform: uppercase;
    font-size: 13px;
    letter-spacing: 2px;
    background: #524e4e;
    border: none;
}
.btn:hover{
    border:none;
    background-color: #3a3838;
}
.login_page_main_all{padding-bottom: 0;}
    .copy_right {
    position: fixed;
    width: 100%;
    bottom: 68px;
    left: 0;
    text-align: center;
    opacity: .7;
    font-size: 15px;
    letter-spacing: 7px;
}
.po {
    position: relative;
    width: 100%;
    height: 100%;
}
.log_forget_pass {
    text-align: right;
    margin: -10px 12px 0 0;
    font-size: 15px;
    color: #fff;
    opacity: 1;
}
.login_page_main_all {
    position: absolute !important;
    width: 100% !important;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
}
._remenbr_me{
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
        -ms-flex-align: center;
            align-items: center;
            margin-bottom: 30px;
}
._remenbr_me span {
    color: #ffffffd9;
    margin-left: 5px;
}
._pass_frgt{
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack: justify;
        -ms-flex-pack: justify;
            justify-content: space-between;
            padding-top: 40px;
}
._pass_frgt a{
    color: #ffffffd9;
}
._pass_frgt a:hover{
    color: #ffffffd9;
}
.{}
.{}
.{}
.{}
.{}
/*============= login page ============*/





@media only screen and (max-width: 750px) {
.copy_right {
    bottom: 18px;
    font-size: 12px;
    letter-spacing: 4px;
}
.log_forget_pass {
    font-size: 12px;
}









}
</style>