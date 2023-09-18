@extends('layouts.admin')

@section('content')
{{-- 
<div>
    <livewire:admin.category.index />
</div>  --}}

<div class="container">
    {{$dataTable->table()}}
    {{$dataTable->scripts()}}
</div> 
@endsection

