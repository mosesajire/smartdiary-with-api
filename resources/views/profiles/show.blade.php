@extends('layouts.app')

@section('title', 'Your Profile')

@section('content')

	<div class="card">
		<div class="card-header">Manage Your Profile</div>
		<div class="card-body">
			<!-- Include file for messages/notifications -->
			@include('includes.messages')

			<p><b>Name: </b> {{$user->name}}</p>
			<p><b>Email: </b> {{$user->email}}</p>
			<p><b>Password: </b> ****** </p>
			<p><b>Date Registered: </b> {{$user->created_at->format('d-m-Y')}}</p>
			<p><a href="/profiles/{{$user->id}}/edit" class="btn btn-primary">Update Profile</a></p>
		</div>
	</div>

@endsection