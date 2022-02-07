@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(Auth::user()->status == 0)
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        
                        <img width="200" src="/uploads/avatar/{{Auth::user()->avatar}}">
                        {{ __('You are logged in Manager and Your Account is Padding!') }}

                    </div>
                    <form enctype="multipart/form-data" action="/profilechanges" method="post">
                        @csrf
                        <input type="file" name="avatar">
                        <input type="submit" name="submit">
                    </form>
                </div>
            @else
             <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        
                        <img width="200" src="/uploads/avatar/{{Auth::user()->avatar}}">
                        {{ __('You are logged in Manager and Your Account is Active!') }}

                    </div>
                    <form enctype="multipart/form-data" action="/profilechanges" method="post">
                        @csrf
                        <input type="file" name="avatar">
                        <input type="submit" name="submit">
                    </form>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection


