@extends('layouts.app')

@section('title', 'Create New Entry')

@section('content')

	<p><button class="btn btn-default"><a href="/entries">Manage Your Diary</a></button></p>

	<div class="card">
		<div class="card-header">
			<h1>Add New Entry</h1>
		</div>
		<div class="card-body">
			{{-- Include file for messages/notifications --}}
			
			@include('includes.messages')

			<form action="/entries" method="post">
				@csrf

				<div class="form-group">
					<textarea name="body" rows="7" class="form-control" required="required" placeholder="Type your entry here">{{ old('body') }}</textarea>
				</div>

				<input type="hidden" name="status" value="1">

				<input type="submit" name="submit" value="CREATE ENTRY" class="btn btn-primary">
			</form>
		</div>
	</div>
@endsection