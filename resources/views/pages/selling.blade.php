@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title">Items</h4>
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
                            <th>Taxi</th>
                            <th>Phone</th>
                            <th>City</th>
                            <th>Product</th>
                            <th>Price</th>
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
                            <td>{{$value->taxi->t_name}}</td>
                            <td>{{$value->taxi->t_phone}}</td>
                            <td>{{$value->taxi->city->c_name}}</td>
                            <td>{{$value->product->p_name}}</td>
                            <td>{{$value->product->p_price_sell}}</td>
                            <td>{{$value->tp_amount}}</td>
                            <td>{{$value->created_at}}</td>
                            <td>{{$value->updated_at}}</td>
                            <td>
                                <div class="btn-group m-b-10">
                                    <button type="button"
                                        class="btn btn-primary dropdown-toggle"
                                        data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">Actions</button>
                                    <div class="dropdown-menu">
                                        {{-- <a class="dropdown-item"
                                            href="{{route('dashboard.tag.edit',$value->id)}}">{{ $value->tg_state == 1 ? 'Inactive' :'Active'}}</a> --}}
                                        <button class="dropdown-item" data-toggle="modal"
                                            data-target=".bd-example-modal-form-{{$value->id}}">Order</button>
                                        <div class="dropdown-divider"></div>
                                        <form
                                            action="{{route('product.delete',$value->id)}}"
                                            method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item text-danger">Delete</button>
                                        </form>

                                    </div>
                                </div>
                            </td>
                        </tr>
                        <div class="modal fade bd-example-modal-form-{{$value->id}}"
                            tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
                            aria-hidden="true">
                            <form action="{{route('selling.store')}}" method="post">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalform">Order
                                                Product #{{$value->product->p_name}}</h5>
                                            <button type="button" class="close"
                                                data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true"
                                                    class="text-dark">&times;</span>
                                            </button>
                                        </div>
                                        <input type="hidden" name="id" value="{{$value->id}}">
                                        <div class="modal-body">
                                            @csrf
                                            <div class="form-group row">
                                                <div class="col-12">
                                                    <input class="form-control" type="text"
                                                        required="" name="name"
                                                        placeholder="Name">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-12">
                                                    <input class="form-control" type="text"
                                                        required="" name="phone"
                                                        placeholder="Phone">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-12">
                                                    <input class="form-control" type="number"
                                                        required="" name="amount"
                                                        placeholder="Amount"  max="{{$value->tp_amount}}" value="1">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-12">
                                                    <input class="form-control" type="number"
                                                        required="" name="price"
                                                        placeholder="Price Of Sell"
                                                        value="{{$value->product->p_price_sell}}">
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row">
                                                <div class="col-12">
                                                    <textarea class="form-control"
                                                        name="address"
                                                        placeholder="Address" cols="5"
                                                        rows="10"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group mb-0 row">
                                                <div class="col-md-9">
                                                    <div class="form-check-inline my-1">
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" checked id="customRadio4" value="0" name="state" class="custom-control-input">
                                                            <label class="custom-control-label"  for="customRadio4">Pending</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-check-inline my-1">
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" id="customRadio5" value="1" name="state" class="custom-control-input">
                                                            <label class="custom-control-label" for="customRadio5">Done</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                      
                                        <div class="modal-footer">
                                            <button type="submit"
                                                class="btn btn-raised btn-primary ml-2">Make Order</button>
                                            <button type="button"
                                                class="btn btn-raised btn-danger"
                                                data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end col -->
</div>
@endsection