@extends('layouts.app')

@section('title', 'View Entry')

@section('content')
	<p><a href="/entries/create" class="btn btn-primary">Add New Entry</a> <a href="/entries" class="btn btn-warning">View All Entries</a></p>

	<div class="card">
		<div class="card-header">
			<h1>Your Entry</h1>
		</div>
		<div class="card-body">
			<!-- Include file for messages/notifications -->
			@include('includes.messages')

			@if(isset($entry))

			<p><b>Created At:</b> {{$entry->created_at->format('d/m/Y h:i A')}}</p>
			<p><b>Entry:</b><br> {{$entry->body}}</p>

			<table>
				<tr>
					<td>
						<a href="/entries/{{$entry->id}}/edit" class="btn btn-success">Update</a>
					</td>
					<td>
					{{-- Add a delete form --}}
						<form action="/entries/{{$entry->id}}" method="post">
							<input type="hidden" name="_method" value="DELETE">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input type="submit" name="submit" value="Delete" class="btn btn-danger" onclick="return confirm('You are about to delete an entry. Click OK to continue')">
						</form>
					</td>
				</tr>
			</table>

			@else
				<p>You have not created any entry yet. <a href="/entries/create">Create New Entry</a></p>

			@endif

		</div>
	</div>
@endsection