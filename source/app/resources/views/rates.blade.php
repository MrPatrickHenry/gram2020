@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Rate</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

Congratulations your rate is: {{ $engagementRate }}
                    
<!-- if statement around here -->
                    <div class="container app">
            <a href="https://api.instagram.com/oauth/authorize/?client_id=16b479bb667f424fb1bcb1c8dae8cf9f&redirect_uri=https://20-twenty.online/instagram/callback/&response_type=code" class="btn btn-default">
                Authenticate Instagram
            </a>
    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
