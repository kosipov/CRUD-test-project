@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">@lang('sections.edit')</h1>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <br />
            @endif
            <form method="post" enctype="multipart/form-data" action="{{ route('sections.update', $section->id) }}">
                @method('PATCH')
                @csrf
                <div class="form-group">

                    <label for="name">@lang('sections.name'):</label>
                    <input type="text" class="form-control" name="name" value="{{ $section->name }}" />
                </div>

                <div class="form-group">
                    <label for="email">@lang('sections.description'):</label>
                    <textarea class="form-control" name="description"> {{ $section->description }} </textarea>
                </div>
                <div class="form-group">
                    <label for="users">@lang('sections.users'):</label><br>
                    @foreach($users as $user)
                        <input type="checkbox" class="form-control" name="users[]" value="{{$user->id}}"
                            {{ $section->users->contains($user->id) ? 'checked="checked" ' : '' }}/>
                        <label for="users{{$user->id}}">{{$user->name}}</label>
                    @endforeach
                </div>
                <div class="form-group">
                    <label for="logo">Logo:</label>
                    <input type="file" class="form-control" name="logo"/>
                </div>
                <button type="submit" class="btn btn-primary">@lang('app.edit')</button>
            </form>
        </div>
    </div>
@endsection
