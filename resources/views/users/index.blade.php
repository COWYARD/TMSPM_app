@extends('master')

@section('content')
<div class="container">
    <div class="row">
        <div class="page-header">
            <h1>Users</h1>
        </div>
    </div>
    <div class="row">
        <div class="row">
            @foreach($users as $user)
            <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                    <img src="/img/profile.jpg" alt="Profile Picture">
                    <div class="caption">
                        <h3>{{ $user->name }}</h3>
                        <p>{{ $user->description }}</p>
                        <p><a href="{{"/posts?user={$user->id}"}}" class="btn btn-primary" role="button">View Posts</a></p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection