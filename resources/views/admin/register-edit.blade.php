@extends('layouts.master')

@section('title')
    Edit Registered | Funda of web IT
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Edit Role for Registered User </h3>
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <form action="/role-register-update/{{$user->id}}" method="POST">
                                    {{csrf_field()}}
                                    {{method_field('PUT')}}
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control" value="{{$user->name}}" name="username">
                                    </div>

                                    <div class="form-group">
                                        <label>Given Role</label>
                                        <select name="usertype" class="form-control" >
                                            @foreach ($roles as $role)
                                                <option value='{{$role->id}}' {{$role->id == $user->role->id ? 'selected' : ''}} >{{$role->role}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-success">Update</button>
                                    <a href="/role-register" class="btn btn-danger">Cancel</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

@endsection
