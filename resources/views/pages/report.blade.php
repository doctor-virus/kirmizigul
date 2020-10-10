@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title">Dashboard</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card m-b-30">
            <div class="card-body">
                <form action="{{route('report.store')}}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label for="example-text-input" class="col-sm-2 col-form-label">From</label>
                        <div class="col-sm-10">
                            <div class="input-group ">
                                <input type="date" name="from" class="form-control" value="{{$from ?? date('Y-m-d')}}">
                                <div class="input-group-append bg-primary b-0"></div>
                            </div><!-- input-group -->
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-search-input" class="col-sm-2 col-form-label">To</label>
                        <div class="col-sm-10">
                            <div class="input-group ">
                                <input type="date" name="to" class="form-control" value="{{$to ?? date('Y-m-d')}}">
                                <div class="input-group-append bg-primary b-0"></div>
                            </div><!-- input-group -->
                        </div>
                    </div>
                    <button type="submit" class="btn btn-raised btn-primary float-right">Search</button>
                </form>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
<div class="row">
    <div class="col-md-12 col-xl-3">
        <div class="card mini-stat">
            <div class="mini-stat-icon text-right">
                <i class="mdi mdi-coin"></i>
            </div>
            <div class="p-4">
                <h6 class="text-uppercase mb-3">Earn</h6>
                <div class="float-right">
                </div>
                <h4 class="mb-0">{{$earn}}<small class="ml-2"></small></h4>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-xl-3">
        <div class="card mini-stat">
            <div class="mini-stat-icon text-right">
                <i class="mdi mdi-trending-up"></i>
            </div>
            <div class="p-4">
                <h6 class="text-uppercase mb-3">Income</h6>
                <div class="float-right">
                </div>
                <h4 class="mb-0">{{$income}}<small class="ml-2"></small></h4>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-xl-3">
        <div class="card mini-stat">
            <div class="mini-stat-icon text-right">
                <i class="mdi mdi-trending-down"></i>
            </div>
            <div class="p-4">
                <h6 class="text-uppercase mb-3">Outcome</h6>
                <div class="float-right">
                </div>
                <h4 class="mb-0">{{$outcome}}<small class="ml-2"></small></h4>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-xl-3">
        <div class="card mini-stat">
            <div class="mini-stat-icon text-right">
                <i class="mdi mdi-check"></i>
            </div>
            <div class="p-4">
                <h6 class="text-uppercase mb-3">Order Done</h6>
                <div class="float-right">
                </div>
                <h4 class="mb-0">{{$done}}<small class="ml-2"></small></h4>
            </div>
        </div>
    </div>

    <div class="col-md-12 col-xl-3">
        <div class="card mini-stat">
            <div class="mini-stat-icon text-right">
                <i class="mdi mdi-cart-outline"></i>
            </div>
            <div class="p-4">
                <h6 class="text-uppercase mb-3">Order Pending</h6>
                <div class="float-right">
                </div>
                <h4 class="mb-0">{{$pending}}<small class="ml-2"></small></h4>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-xl-3">
        <div class="card mini-stat">
            <div class="mini-stat-icon text-right">
                <i class="mdi  mdi-package-variant-closed"></i>
            </div>
            <div class="p-4">
                <h6 class="text-uppercase mb-3">Product</h6>
                <div class="float-right">
                </div>
                <h4 class="mb-0">{{$product}}<small class="ml-2"></small></h4>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-xl-3">
        <div class="card mini-stat">
            <div class="mini-stat-icon text-right">
                <i class="mdi mdi-truck"></i>
            </div>
            <div class="p-4">
                <h6 class="text-uppercase mb-3">Product In Taxi</h6>
                <div class="float-right">
                </div>
                <h4 class="mb-0">{{$tproduct}}<small class="ml-2"></small></h4>
            </div>
        </div>
    </div>

    <div class="col-md-12 col-xl-3">
        <div class="card mini-stat">
            <div class="mini-stat-icon text-right">
                <i class="mdi mdi-taxi"></i>
            </div>
            <div class="p-4">
                <h6 class="text-uppercase mb-3">Taxi</h6>
                <div class="float-right">
                </div>
                <h4 class="mb-0">{{$taxi}}<small class="ml-2"></small></h4>
            </div>
        </div>
    </div>
</div><!-- end row -->
@endsection