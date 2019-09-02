@extends('layouts.app')

@section('content')
    <div class="container app">
            <a href="https://api.instagram.com/oauth/authorize/?client_id=16b479bb667f424fb1bcb1c8dae8cf9f&redirect_uri=https://20-twenty.online/instagram/callback/&response_type=code" class="btn btn-default">
                Authenticate Instagram
            </a>
        @endif
    </div>
@endsection
