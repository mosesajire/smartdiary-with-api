@extends('layouts.app')

@section('title', 'Your Dashboard')

@section('content')

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5>Quick Links</h5>
                </div>
                <div class="card-body">
                    <h5 class="text-success">Total Entries: @if(isset($getCount)) {{ $getCount }} @endif</h5>
                    <hr>
                    <p>&raquo; <a href="/entries/create"> Add New Entry</a></p>
                    <p>&raquo; <a href="/profiles"> Update Profile</a></p>


                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5>Recent Entries</h5>
                </div>
                <div class="card-body">
                    <p>Check out the recent entries that you added to your digital diary</p>
                    <a href="/entries/?sort=desc" class="btn btn-block btn-primary">View Recent Entries</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5>Old Entries</h5>
                </div>
                <div class="card-body">
                    <p>View all the entries in your digital diary, starting with the oldest ones</p>
                    <a href="/entries/?sort=asc" class="btn btn-block btn-primary">View Old Entries</a>
                </div>
            </div>
        </div>
    </div>

@endsection