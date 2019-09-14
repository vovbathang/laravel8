@extends ('admin.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <a href="{{route('admin.category.create')}}" class="btn btn-primary">Create new Category</a>
                </div>
                <br/>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="body">Lists</div>
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
                                    <th>Slug</th>
                                    <th>Order</th>
                                    <th>Parent</th>
                                    <th>Date Created</th>
                                    <th>Date Updated</th>
                                    <th>Option</th>
                                </tr>
                                </thead>

                                <tbody>
                                @forelse($categories as $category)
                                    <tr>
                                        <td>{{$category->id}}</td>
                                        <td>{{$category->name}}</td>
                                        <td>{{$category->slug}}</td>
                                        <td>{{$category->order}}</td>
                                        <td>{{$category->parent}}</td>
                                        <td>{{$category->created_at}}</td>
                                        <td>{{$category->updated_at}}</td>
                                        <td>
                                            <a href="{{ route('admin.category.show', ['id' => $category->id]) }}"
                                               class="btn btn-primary">Edit</a>
                                            <a href="{{ route('admin.category.delete', ['id' => $category->id]) }}"
                                               class="btn btn-danger"
                                               onclick="event.preventDefault();
                                                   window.confirm('Are you sure to delete?') ?
                                                   document.getElementById('category-delete-{{$category->id}}').submit():0;">Delete</a>
                                            <form action="{{ route('admin.category.delete', ['id' => $category->id]) }}"
                                                  method="post" id="category-delete-{{$category->id}}">
                                                {{csrf_field()}}
                                                {{method_field('delete')}}
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">No data</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </table>
                        <div class="text-center">
                            {{ $categories->links() }}
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
