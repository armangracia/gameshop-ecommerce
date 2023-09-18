 @extends('layouts.admin')

@section('content')

<div class="container" style="overflow-x: auto; height: 700px;">
    {{$dataTable->table()}}
</div> 
{{$dataTable->scripts()}}

@endsection
