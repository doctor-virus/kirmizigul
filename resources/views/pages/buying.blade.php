@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title">Buying</h4>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-12">
        <div class="card m-b-30">
            <div class="card-body">
                @if(session('success'))
                <div class="alert alert-warning alert-dismissible fade show d-flex align-items-center" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <i class="mdi mdi-checkbox-marked-circle font-32"></i><strong class="pr-1">Success !</strong>
                    {!!session('success')!!}
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

                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link {{isset($prod) ? '' : 'active'}}" data-toggle="tab" href="#cat" role="tab">All Buying</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{!isset($prod) ? '' : 'active'}}" data-toggle="tab" href="#create" role="tab">Buy Product</a>
                    </li>
                    
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane {{isset($prod) ? '' : 'active'}} p-3" id="cat" role="tabpanel">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">

                                        <h4 class="mt-0 header-title">Buying table</h4>
                                        <table id="datatable-buttons"
                                            class="table table-striped table-bordered dt-responsive nowrap"
                                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>ID</th>
                                                    <th>Doc ID</th>
                                                    <th>Product</th>
                                                    <th>Amount</th>
                                                    <th>Price</th>
                                                    <th>Price All</th>
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
                                                    <td>{{$value->b_docment_id}}</td>
                                                    <td>{{$value->product->p_name}}</td>
                                                    <td>{{$value->b_amount  }}</td>
                                                    <td>{{$value->b_price}}</td>
                                                    <td>{{$value->b_all_price}}</td>
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
                                                                    data-target=".bd-example-modal-form-{{$value->id}}">Edit</button>
                                                                <div class="dropdown-divider"></div>
                                                                <form
                                                                    action="{{route('buying.destroy',$value->id)}}"
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
                                                    <form action="{{route('buying.update',$value->id)}}"
                                                        method="post">
                                                        @method('PUT')

                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalform">Update
                                                                        Buying #{{$value->id}}</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true"
                                                                            class="text-dark">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    @csrf
                                                                    <div class="form-group row">
                                                                        <div class="col-12">
                                                                            <input class="form-control" type="text"
                                                                                required="" name="document"
                                                                                placeholder="Document ID"
                                                                                value="{{$value->b_docment_id}}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-12">
                                                                            <input class="form-control"
                                                                                type="number" required="" name="amount" placeholder="Amount"
                                                                                value="{{$value->b_amount}}">
                                                                          
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-12">
                                                                            <input class="form-control"
                                                                                type="number" required="" name="price" placeholder="Price"
                                                                                value="{{$value->b_price}}">
                                                                        </div>
                                                                    </div>
                                                                    

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit"
                                                                        class="btn btn-raised btn-primary ml-2">Update</button>
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
                        </div> <!-- end row -->

                    </div>
                    <div class="tab-pane p-3 {{!isset($prod) ? '' : 'active'}}" id="create" role="tabpanel">
                        <form action="{{route('buying.store')}}" method="post">
                            @csrf
                            <div class="form-group row">
                                <div class="col-12">
                                    <input class="form-control {{ $errors->has('document')? 'is-invalid' : '' }}" id="tranlate_en"
                                        type="text" required="" name="document" placeholder="Document ID" value="{{old('document')}}">
                                    @if($errors->has('document'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('document') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <input class="form-control {{ $errors->has('amount')? 'is-invalid' : '' }}"
                                        type="number" required="" name="amount" placeholder="Amount"
                                        value="{{old('amount')}}">
                                    @if($errors->has('amount'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('amount') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <input class="form-control {{ $errors->has('price')? 'is-invalid' : '' }}"
                                        type="number" required="" name="price" placeholder="Price"
                                        value="{{old('price')}}">
                                    @if($errors->has('price'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('price') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Product</label>
                                <div class="col-sm-10">
                                    <select name="product" class="form-control">
                                        @foreach ($product as $key=>$pro)
                                        <option {{$pro->id == old('product') ? 'selected' : ''}} {{$pro->id == ($prod ?? 0) ? 'selected' : ''}} value="{{$pro->id }}">{{$pro->p_name}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>                            
                            <div class="form-group text-right row m-t-20">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Add</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    
                </div>

            </div>
        </div>
    </div>
</div>
@endsection