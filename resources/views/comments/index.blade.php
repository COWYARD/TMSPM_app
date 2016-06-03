@extends('master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="page-header clearfix">
                <h1>Comments<a class="btn btn-primary pull-right" href="create" role="button">New</a></h1>

            </div>
        </div>

    </div>
    <div class="row">
        @forelse($comments as $comment)
        <div class="col-sm-12">
            <div class="panel panel-primary">
                <div class="panel-body">
                    {{ $comment->text }}
                </div>
                <div class="panel-footer">Created at {{ $comment->created_at->toDateTimeString() }} from {{ $comment->user->name }}</div>
            </div>
        </div>
        @empty
            <div class="col-sm-12">
                <h2>No comments yet</h2>
            </div>
        @endforelse
    </div>
</div>
@endsection