@extends('layouts.default')
@section('title','主页')
@section('content')
    <div class="jumbotron">
        <h1>hello laravel</h1>
        <p class="lead">你现在看到的是 <a href="http://www.baidu.com">百度</a></p>
        <p>中毒从这里开始</p>
        <p><a href="{{ route('signup')}}" class="btn btn-lg btn-success" role="button">现在注册</a></p>

    </div>
@stop