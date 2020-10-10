@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title">Finished Orders</h4>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                @if(session('success'))
                <div class="alert alert-warning alert-dismissible fade show d-flex align-items-center" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <i class="mdi mdi-checkbox-marked-circle font-32"></i><strong class="pr-1">Success !</strong>
                    {{session('success')}}
                </div>
                @endif
                @if(count($errors) > 0)
                @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <i class="mdi mdi-close-circle font-32"></i><strong class="pr-1">Error !</strong> {{$error}}
                </div>
                @endforeach
                @endif
                <h4 class="mt-0 header-title">Taxi per Product</h4>
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Order Phone</th>
                            <th>Address</th>
                            <th>Taxi</th>
                            <th>Phone</th>
                            <th>City</th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Price All</th>
                            <th>Amount</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Action</th>
                        </tr>
                    </thead>


                    <tbody>
                        @foreach ($data as $key=>$value)
                        <tr>
                            <td>{{++$key}}</td>
                            <td>{{$value->id}}</td>
                            <td>{{$value->s_name}}</td>
                            <td>{{$value->s_phone}}</td>
                            <td>{{$value->s_address}}</td>
                            <td>{{$value->taxi->t_name}}</td>
                            <td>{{$value->taxi->t_phone}}</td>
                            <td>{{$value->taxi->city->c_name}}</td>
                            <td>{{$value->product->p_name}}</td>
                            <td>{{$value->s_price}}</td>
                            <td>{{$value->s_all_price}}</td>
                            <td>{{$value->s_amount}}</td>
                            <td>{{$value->created_at}}</td>
                            <td>{{$value->updated_at}}</td>
                            <td>
                                <div class="btn-group m-b-10">
                                    <button type="button"
                                        class="btn btn-primary dropdown-toggle"
                                        data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">Actions</button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item"
                                            href="{{route('selling.edit',$value->id)}}">Pending</a>
                                        <div class="dropdown-divider"></div>
                                        <form
                                        action="{{route('selling.destroy',$value->id)}}"
                                        method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item text-danger">Delete</button>
                                    </form>

                                    </div>
                                </div>
                            </td>
                        </tr>
                       
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end col -->
</div>
@endsection