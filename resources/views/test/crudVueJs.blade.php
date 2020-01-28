@extends('layouts.master')

@section('title')
    CRUD with VueJs | Funda of web IT
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <create-component></create-component>

        </div>
    </div>
@endsection

@section('scripts')

    <script src="{{ asset('js/app.js') }}" defer></script>

@endsection
