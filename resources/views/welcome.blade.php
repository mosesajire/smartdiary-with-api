@extends('layouts.app')

@section('title', 'Welcome')

@section('content')

    <div class="jumbotron text-center">
        <h1>SmartDiary ...your digital diary</h1>
        <hr>
        <h2>Take your diary with you everywhere you go. Access your digital diary anytime, anywhere.</h2>
        <p>&nbsp;</p>
        <a href="/register" class="btn btn-success btn-lg">GET STARTED</a>
        <a href="/login" class="btn btn-primary btn-lg">LOGIN</a>
    </div>

@endsection
