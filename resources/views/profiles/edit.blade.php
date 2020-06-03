@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
    <p><a href="/profiles/" class="btn btn-primary">Back</a></p>
    <div class="card">
        <div class="card-header">Edit Your Profile</div>
        <div class="card-body">

            <!-- Include file for messages/notifications -->
            @include('includes.messages')

            <form action="/profiles/{{$user->id}}" class="form" method="post">

            {!! csrf_field() !!}

                <div class="form-group">
                    <label for="name" class="control-label">Name</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{$user->name}}">
                </div>

                <div class="form-group">
                    <label for="email" class="control-label">Email</label>
                    <input type="text" class="form-control" name="email" id="email" value="{{$user->email}}">
                </div>

                <div class="form-group">
                    <label for="password" class="control-label">Password</label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>

                <div class="form-group">
                    <label for="password_confirmation" class="control-label">Confirm Password</label>
                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
                </div>

                <input type="hidden" name="_method" value="PUT">

                <div class="form-group">
                    <button type="submit" class="btn btn-success">UPDATE</button>
                </div>
            </form>
        </div>
    </div>

@endsection