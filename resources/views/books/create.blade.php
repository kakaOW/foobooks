@extends('layouts.master')

@section('title')
    Add a book
@stop


@section('content')
    <h1>Add a book</h1>
    <form method='POST' action='/book/create'>

        {{csrf_field() }}

        <div class='form-group'>
            <label>* Title:</label>
            <input
              type='text'
              id='title'
              name='title'
            >
        </div>

        <button type='submit' class='btn btn-primary'>Add book</button>
    </form>
@stop

@section('body')
    <script src="/js/book/show.js"></script>
@stop
