@extends('layouts.new')

@section('content')

    <table border="1">
    <thead>
    <td>ID</td><td>Name</td><td>Age</td><td>是否在线</td>
    </thead>
    <tbody>
    @foreach($res as $v)
        <tr>
            <td>{{$v->id}}</td><td>{{$v->u_name}}</td><td>{{$v->age}}</td><td>@if($v->is_login==0)
            未登录
                 @else

                    在线
                    @endif
            </td>
        </tr>
    @endforeach
    </tbody>
        @endsection
</table>