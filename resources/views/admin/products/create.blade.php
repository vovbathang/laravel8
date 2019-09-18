@extends ('admin.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <a href="{{route('admin.product.index')}}" class="btn btn-primary">Back to products</a>
                </div>
                <br/>
                <div class="panel panel-default"> Add a new product
                    <div class="panel-heading">

                        <form action="{{route('admin.product.store')}}" method="post">
                            {{csrf_field()}}
                            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }} ">
                                <label>product Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                       placeholder="product Name"
                                       value="{{old('name')}}">
                                <span class="help-block">{{ $errors->first('name') }}</span>
                            </div>
                            {{--slug--}}

                            {{--order--}}
                            <div class="form-group {{ $errors->has('order') ? 'has-error' : '' }} ">
                                <label for="order">Order</label>
                                <input type="text" class="form-control" id="order" name="order" placeholder="Order"
                                       value="{{old('order')}}">
                                <span class="help-block">{{ $errors->first('order') }}</span>
                            </div>

                            {{--parent--}}
                            <div class="form-group {{ $errors->has('parent') ? 'has-error' : '' }} ">
                                <label for="parent">Parent</label>
                                <select name="parent" id="parent" class="form-control">
                                    <option value="0">Select</option>
                                    @if(count($products)>0)
                                        @foreach($products as $product)
                                            <option
                                                value="{{$product->id}} {{ old('parent') == $product->id ? 'selected' : ''}}">{{$product->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <span class="help-block">{{ $errors->first('parent') }}</span>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
