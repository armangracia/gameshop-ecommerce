@extends('layouts.admin')

@section('content')


<div class="row">
            <div class="col-md-12 grid-margin">
              <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                  <div class="me-md-3 me-xl-5">
                    <h2>Welcome back,</h2>
                    <p class="mb-md-0">Your analytics dashboard template.</p>
                  </div>
                  <div class="d-flex">
                    <i class="mdi mdi-home text-muted hover-cursor"></i>
                    <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</p>
                    <p class="text-primary mb-0 hover-cursor">Analytics</p>
                  </div>
                </div>
                <div class="d-flex justify-content-between align-items-end flex-wrap">
                  <button type="button" class="btn btn-light bg-white btn-icon me-3 d-none d-md-block ">
                    <i class="mdi mdi-download text-muted"></i>
                  </button>
                  <button type="button" class="btn btn-light bg-white btn-icon me-3 mt-2 mt-xl-0">
                    <i class="mdi mdi-clock-outline text-muted"></i>
                  </button>
                  <button type="button" class="btn btn-light bg-white btn-icon me-3 mt-2 mt-xl-0">
                    <i class="mdi mdi-plus text-muted"></i>
                  </button>
                  <button class="btn btn-primary mt-2 mt-xl-0">Generate report</button>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-3">
                <div class="card card-body bg-primary text-white mb-3">
                  <label> Total Orders</label>
                  {{-- <h1>{{ $totalOrder }}</h1> --}}
                  <h1> 4 </h1>
                  <a href="{{ url('/') }}" class="text-white">View</a>
                </div>
            </div>
          
          
            <div class="col-md-3">
                <div class="card card-body bg-success text-white mb-3">
                  <label> Today Orders</label>
                  {{-- <h1>{{ $todayOrder }}</h1> --}}
                  <h1> 4 </h1>
                  <a href="{{ url('/') }}" class="text-white">View</a>
                </div>
            </div>
          
          
            <div class="col-md-3">
                <div class="card card-body bg-danger text-white mb-3">
                  <label> This Month Orders</label>
                  {{-- <h1>{{ $thisMonthOrder }}</h1> --}}
                  <h1> 4 </h1>
                  <a href="{{ url('/') }}" class="text-white">View</a>
                </div>
            </div>
          
          
            <div class="col-md-3">
                <div class="card card-body bg-warning text-white mb-3">
                  <label> Year Orders</label>
                  {{-- <h1>{{ $thisYearOrder }}</h1> --}}
                  <h1> 4 </h1>
                  <a href="{{ url('/') }}" class="text-white">View</a>
                </div>
            </div>
          </div>
          

          <div class="row">
            <div class="col-md-3">
                <div class="card card-body bg-primary text-white mb-3">
                  <label> Total Products </label>
                  {{-- <h1>{{ $totalOrder }}</h1> --}}
                  <h1> 100 </h1>
                  <a href="{{ url('/') }}" class="text-white">View</a>
                </div>
            </div>
          
          
            <div class="col-md-3">
                <div class="card card-body bg-success text-white mb-3">
                  <label> Total Categories </label>
                  {{-- <h1>{{ $todayOrder }}</h1> --}}
                  <h1> 5 </h1>
                  <a href="{{ url('/') }}" class="text-white">View</a>
                </div>
            </div>
          
          
            <div class="col-md-3">
                <div class="card card-body bg-danger text-white mb-3">
                  <label> Total Game Company </label>
                  {{-- <h1>{{ $thisMonthOrder }}</h1> --}}
                  <h1> 2 </h1>
                  <a href="{{ url('/') }}" class="text-white">View</a>
                </div>
            </div>
          
          </div>


          <div class="row">
            <div class="col-md-3">
                <div class="card card-body bg-primary text-white mb-3">
                  <label> Total Products </label>
                  {{-- <h1>{{ $totalOrder }}</h1> --}}
                  <h1> 100 </h1>
                  <a href="{{ url('/') }}" class="text-white">View</a>
                </div>
            </div>
          
          
            <div class="col-md-3">
                <div class="card card-body bg-success text-white mb-3">
                  <label> Total Users </label>
                  {{-- <h1>{{ $todayOrder }}</h1> --}}
                  <h1> 5 </h1>
                  <a href="{{ url('/') }}" class="text-white">View</a>
                </div>
            </div>
          
          
            <div class="col-md-3">
                <div class="card card-body bg-danger text-white mb-3">
                  <label> Total Admins </label>
                  {{-- <h1>{{ $thisMonthOrder }}</h1> --}}
                  <h1> 2 </h1>
                  <a href="{{ url('/') }}" class="text-white">View</a>
                </div>
            </div>
          
          </div>
          
@endsection