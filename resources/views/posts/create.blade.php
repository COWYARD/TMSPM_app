@extends('master')

@section('content')
<div class="container">
    <div class="row">
        <div class="page-header clearfix">
            <h1>Create new Post</h1>

        </div>

    </div>
    <div class="row">
        <div class="col-sm-6">
            <form>
                <div class="form-group">
                    <label for="exampleInputEmail1">Title</label>
                    <input type="text" class="form-control" id="title" placeholder="Title">
                </div>
                <div class="form-group">
                    <label for="text">Text</label>
                    <textarea class="form-control" id="text" placeholder="Text"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection