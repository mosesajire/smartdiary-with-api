@extends('layouts.app')

@section('title', 'Edit Your Entry')

@section('content')

	<div class="card">
		<div class="card-header">
			<h1>Edit Entry</h1>
		</div>
		<div class="card-body">
			{{-- Include file for messages/notifications --}}
			@include('includes.messages')

			@if(isset($entry))

				<form action="/entries/{{$entry->id}}" method="post">
					<div class="form-group">
						<textarea name="body" rows="7" class="form-control" required="required">{{ $entry->body }}</textarea>
					</div>

					<input type="hidden" name="_method" value="PUT">

					<input type="hidden" name="_token" value="{{ csrf_token() }}">

					<input type="submit" name="submit" value="UPDATE ENTRY" class="btn btn-success">
				</form>
			@else
				<p>Sorry, something went wrong. Please try again.</p>
			@endif
		</div>
	</div>
@endsection