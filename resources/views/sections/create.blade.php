@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">@lang('sections.create')</h1>
            <div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div><br />
                @endif
                <form method="post" enctype="multipart/form-data" action="{{ route('sections.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="name">@lang('sections.name'):</label>
                        <input type="text" class="form-control" name="name"/>
                    </div>
                    <div class="form-group">
                        <label for="description">@lang('sections.description'):</label>
                        <input type="text" class="form-control" name="description"/>
                    </div>
                    <div class="form-group">
                        <label for="users">@lang('sections.users'):</label><br>
                        @foreach($users as $user)
                            <input type="checkbox" class="form-control" name="users[]" value="{{$user->id}}"/>
                            <label for="users{{$user->id}}">{{$user->name}}</label>
                        @endforeach
                    </div>
                    <div class="form-group">
                        <label for="logo">@lang('sections.logo'):</label>
                        <input type="file" class="form-control" name="logo"/>
                    </div>
                    <button type="submit" class="btn btn-primary">@lang('app.add')</button>
                </form>
            </div>
        </div>
    </div>
@endsection
