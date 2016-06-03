@extends('master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="page-header clearfix">
                <h1>Posts<a class="btn btn-primary pull-right" href="create" role="button">New</a></h1>

            </div>
        </div>

    </div>
    <div class="row">
        @forelse($posts as $post)
        <div class="col-sm-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ $post->title }} <a href="{{ "/posts/{$post->id}/comments" }}" class="badge pull-right">{{ $post->comments()->count() }} comments</a></h3>
                </div>
                <div class="panel-body">
                    {{ $post->text }}
                </div>
                <div class="panel-footer">Created at {{ $post->created_at->toDateTimeString() }} from {{ $post->user->name }}</div>
            </div>
        </div>
        @empty
            <div class="col-sm-12">
                <h2>No posts yet</h2>
            </div>
        @endforelse
    </div>
</div>
@endsection