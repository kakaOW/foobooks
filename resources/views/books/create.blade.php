@extends('layouts.master')

@section('title')
    Add a book
@stop


@section('content')
    <h1>Add a book</h1>
    <form method='POST' action='/book/create'>

        {{csrf_field() }}

        <div class='form-group'>
            <label>* Title: </label>
            <br>{{$errors->first('title') }}<br />
            <input
              type='text'
              id='title'
              name='title'
              value={{ old('title') }}
            >
        </div>

        <div class='form-group'>
            <label>Author: </label>
            <br>{{$errors->first('author') }}<br />
            <input type='text' id='author' name='author' value={{ old('author') }}>

        </div>

        <button type='submit' class='btn btn-primary'>Add book</button>

        <!-- <ul class='errors'>
        @foreach($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
        </ul> -->

        @if(count($errors) > 0)
            Please correct
        @endif
    </form>
@stop

@section('body')
    <script src="/js/book/show.js"></script>
@stop
