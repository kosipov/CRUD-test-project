@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <nav class="navbar navbar-light bg-light justify-content-between">
                <a class="navbar-brand">@lang('users.title')</a>
                <a href="{{ route('users.create')}}" class="btn btn-primary my-2 my-sm-0">@lang('app.add')</a>
            </nav>
            <table class="table table-striped">
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->created_at}}</td>
                        <td>
                            <a href="{{ route('users.edit',$user->id)}}" class="btn btn-primary">@lang('app.edit')</a>
                        </td>
                        <td>
                            <form action="{{ route('users.destroy', $user->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">@lang('app.delete')</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{ $users->links() }}
@endsection
