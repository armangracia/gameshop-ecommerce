@extends('layouts.app')
@section('title', 'Thank you!')
@section('content')

<div class="py-3 pyt-md-4">
    <div class="container">
        <div class ="row">
            <div class="col-md-12 text-center">
                <h3>NEXUS GAME SHOP</h3>
                <h4>Thank you for shopping</h4>
                <a href = "{{url('collections')}}" class ="btn btn-primary">Shop Again</a>
</div>
</div>
<div>
</div>

@endsection