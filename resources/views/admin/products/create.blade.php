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

                        <form action="{{route('admin.product.store')}}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            {{--Name--}}
                            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }} ">
                                <label>Product Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                       placeholder="Product Name"
                                       value="{{old('name')}}">
                                <span class="help-block">{{ $errors->first('name') }}</span>
                            </div>
                            {{--code--}}
                            <div class="form-group {{ $errors->has('code') ? 'has-error' : '' }} ">
                                <label>Product Code</label>
                                <input type="text" class="form-control" id="code" name="code"
                                       placeholder="Product code"
                                       value="{{old('code')}}">
                                <span class="help-block">{{ $errors->first('code') }}</span>
                            </div>

                            {{--content--}}
                            <div class="form-group {{ $errors->has('content') ? 'has-error' : '' }} ">
                                <label>Product Content</label>
                                <textarea name="content" id="content" rows="5" class="form-control"
                                          placeholder="Content" value="{{old('content')}}"></textarea>
                                <span class="help-block">{{ $errors->first('content') }}</span>
                            </div>

                            {{--Regular Price--}}
                            <div class="form-group {{ $errors->has('regular_price') ? 'has-error' : '' }} ">
                                <label>Regular Price</label>
                                <input type="number" min="1" name="regular_price" id="regular_price"
                                       class="form-control" placeholder="Regular Price"
                                       value="{{old('regular_price')}}"/>
                                <span class="help-block">{{ $errors->first('regular_price') }}</span>
                            </div>

                            {{--Sale Price--}}
                            <div class="form-group {{ $errors->has('sale_price') ? 'has-error' : '' }} ">
                                <label>Sale Price</label>
                                <input type="number" min="1" name="sale_price" id="sale_price"
                                       class="form-control" placeholder="Sale Price" value="{{old('sale_price')}}"/>
                                <span class="help-block">{{ $errors->first('sale_price') }}</span>
                            </div>

                            {{--Original Price--}}
                            <div class="form-group {{ $errors->has('original_price') ? 'has-error' : '' }} ">
                                <label>Original Price</label>
                                <input type="number" min="1" name="original_price" id="original_price"
                                       class="form-control" placeholder="Original Price"
                                       value="{{old('original_price')}}"/>
                                <span class="help-block">{{ $errors->first('original_price') }}</span>
                            </div>

                            {{--Quantity--}}
                            <div class="form-group {{ $errors->has('quantity') ? 'has-error' : '' }} ">
                                <label>Quantity</label>
                                <input type="number" min="1" name="quantity" id="quantity"
                                       class="form-control" placeholder="Quantity" value="{{old('quantity')}}"/>
                                <span class="help-block">{{ $errors->first('quantity') }}</span>
                            </div>

                            {{--Images--}}
                            <div class="form-group {{ $errors->has('image') ? 'has-error' : '' }} ">
                                <label>Images</label>
                                <input type="file" min="1" name="image" id="image"
                                       class="form-control" value="{{old('image')}}"/>
                                <span class="help-block">{{ $errors->first('image') }}</span>
                            </div>

                            {{--parent--}}
                            <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }} ">
                                <label for="category_id">Category</label>
                                <select name="category_id" id="category_id" class="form-control">
                                    @if(count($categories)>0)
                                        @foreach($categories as $category)
                                            <option
                                                value="{{$category->id}} {{ old('category_id') == $category->id ? 'selected' : ''}}">{{$category->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <span class="help-block">{{ $errors->first('category_id') }}</span>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
