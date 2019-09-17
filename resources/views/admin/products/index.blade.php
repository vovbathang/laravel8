@extends ('admin.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <a href="{{route('admin.product.create')}}" class="btn btn-primary">Create new Product</a>
                </div>
                <br/>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="body">Product Lists</div>
                        @if(session('message'))
                            <div class="alert alert-success">
                                {{session('message')}}
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{session('error')}}
                            </div>
                        @endif
                        <table class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Code</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Images</th>
                                    <th>User Upload</th>
                                    <th>Date Updated</th>
                                    <th>Option</th>
                                </tr>
                                </thead>

                                <tbody>
                                @forelse($products as $product)
                                    <tr>
                                        <td>{{$product->id}}</td>
                                        <td>{{$product->name}}</td>
                                        <td>{{$product->code}}</td>
                                        <td>{{$product->sale_price}}</td>
                                        <td>{{$product->quantity}}</td>
                                        <td>No images</td>
                                        <td>{{$product->user->name}}</td>
                                        <td>{{$product->updated_at}}</td>
                                        <td>
                                            <a href="{{ route('admin.product.show', ['id' => $product->id]) }}"
                                               class="btn btn-primary">Edit</a>
                                            <a href="{{ route('admin.product.delete', ['id' => $product->id]) }}"
                                               class="btn btn-danger"
                                               onclick="event.preventDefault();
                                                   window.confirm('Are you sure to delete?') ?
                                                   document.getElementById('product-delete-{{$product->id}}').submit():0;">Delete</a>
                                            <form action="{{ route('admin.product.delete', ['id' => $product->id]) }}"
                                                  method="post" id="product-delete-{{$product->id}}">
                                                {{csrf_field()}}
                                                {{method_field('delete')}}
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8">No data</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </table>
                        <div class="text-center">
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
