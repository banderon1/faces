@extends('app')

@section('content')
    <div class="container">
        <div class="content">
            <div class="title">{{ Lang::get('copy.title') }}</div>
        </div>
    </div>
    <div
            class="fb-like"
            data-share="true"
            data-width="450"
            data-show-faces="true">
    </div>
@endsection
