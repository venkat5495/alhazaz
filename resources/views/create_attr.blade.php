@extends('layouts.app')
@section('content')
 
    <form method="post" action="/store_attr" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group row">
            <label for="titleid" class="col-sm-3 col-form-label">Game Title</label>
            <div class="col-sm-9">
                <input name="attribute_title" type="text" class="form-control" id="titleid" placeholder="Game Title">
            </div>
        </div>
        <div class="form-group row">
            <label for="publisherid" class="col-sm-3 col-form-label">Game Publisher</label>
            <div class="col-sm-9">
                <input name="attribute_description" type="text" class="form-control" id="publisherid" placeholder="Game Publisher">
            </div>
        </div>
        <div class="form-group row">
            <div class="offset-sm-3 col-sm-9">
                <button type="submit" class="btn btn-primary">Submit Game</button>
            </div>
        </div>
    </form>
@endsection