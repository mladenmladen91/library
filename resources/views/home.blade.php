@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script>
    fetch('/admin/token', {
        method: "GET"
        /*headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer '+window.Flex.User.accessToken
        },
        credentials: 'include',
        body: data */
    }).then(function(response) {
        response.json().then(function(json) {
            /* if(json.success === false) {
                 reject(json.errors);
                 return;
             }
             return resolve({data: json, response: response}); */
            console.log(json.accessToken);
        });
    }).catch(function(r) {
        return reject(r)
    });
</script>