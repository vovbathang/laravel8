@extends ('admin.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <a href="{{route('admin.user.index')}}" class="btn btn-primary">Back to Lists</a>
                </div>
                <br/>
                <div class="panel panel-default"> Add a new user
                    <div class="panel-heading">

                        <form action="{{route('admin.user.store')}}" method="post">
                            {{csrf_field()}}
                            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }} ">
                                <label>Your name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Name"
                                       value="{{old('name')}}">
                                <span class="help-block">{{ $errors->first('name') }}</span>
                            </div>

                            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }} ">
                                <label>Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                                value="{{old('email')}}">
                                <small id="emailHelp" class="form-text text-muted">We'll never share your email with
                                    anyone else.</small>
                                <span class="help-block">{{ $errors->first('email') }}</span>
                            </div>

                            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }} ">
                                <label>Password</label>
                                <input type="password" class="form-control" id="password" name="password"
                                       placeholder="Password">
                                <span class="help-block">{{ $errors->first('password') }}</span>
                            </div>

                            <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }} ">
                                <label>Confirm password</label>
                                <input type="password" class="form-control" id="password" name="password_confirmation"
                                       placeholder="Password">
                                <span class="help-block">{{ $errors->first('password_confirmation') }}</span>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
