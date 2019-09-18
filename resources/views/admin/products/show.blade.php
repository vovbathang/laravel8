@extends ('admin.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <a href="{{route('admin.product.index')}}" class="btn btn-primary">Back to Lists</a>
                </div>
                <br/>
                <div class="panel panel-default"> Edit a product
                    <div class="panel-heading">

                        <form action="{{ route('admin.product.update',['id'=>$product->id]) }}" method="POST">
                            {{csrf_field()}}
                            {{method_field('put')}}
                            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }} ">
                                <label>Product Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                       placeholder="product Name"
                                       value="{{$product->name}}">
                                <span class="help-block">{{ $errors->first('name') }}</span>
                            </div>
                            {{--slug--}}

                            {{--order--}}
                            <div class="form-group {{ $errors->has('order') ? 'has-error' : '' }} ">
                                <label for="order">Order</label>
                                <input type="text" class="form-control" id="order" name="order" placeholder="Order"
                                       value="{{$product->order}}">
                                <span class="help-block">{{ $errors->first('order') }}</span>
                            </div>

                            {{--parent--}}
                            <div class="form-group {{ $errors->has('parent') ? 'has-error' : '' }} ">
                                <label for="parent">Parent</label>
                                <select name="parent" id="parent" class="form-control">
                                    <option value="0">Select</option>
                                    @if(count($products)>0)
                                        @foreach($products as $selectProduct)
                                            <option
                                                value="{{$selectProduct->id}}" {{ $product->parent == $selectProduct->id ? 'selected' : ''}}>
                                                {{ $selectProduct->name }}
                                            </option>
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
