@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <nav class="navbar navbar-light bg-light justify-content-between">
                <a class="navbar-brand">@lang('sections.title')</a>
                <a href="{{ route('sections.create')}}" class="btn btn-primary my-2 my-sm-0">@lang('app.add')</a>
            </nav>
            <table class="table table-striped">
                <tbody>
                @foreach($sections as $section)
                    <tr>
                        <td>
                            <img src = {{$section->logo ? asset('/logo/'.$section->logo) : asset('/logo/no-logo.jpg')}}
                                width="100" height="100">
                        </td>
                        <td>
                            <b>{{$section->name}}</b><br>
                            {{$section->description}}
                        </td>
                        <td>
                            @lang('sections.users'):
                            @foreach($section->users as $user)
                                {{$user->name}}<br>
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('sections.edit',$section->id)}}" class="btn btn-primary">@lang('app.edit')</a>
                        </td>
                        <td>
                            <form action="{{ route('sections.destroy', $section->id)}}" method="post">
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
    {{ $sections->links() }}
@endsection
