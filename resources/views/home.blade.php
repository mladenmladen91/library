@extends('layout', ["page_title" => 'Home'])

@section('content')
@endsection
<script src="/js/standard.js"></script>
<script>
    while (!localStorage.getItem("token")) {
        getToken();
    }
</script>