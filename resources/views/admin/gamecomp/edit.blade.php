@extends('layouts.admin')

@section('content')

<div class="container">
<div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Game Company
                            <a href="{{ url('admin/gamecomp') }}" class="btn btn-primary text-white float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('admin/gamecomp/'.$gamecomp->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf 
                        @method('PUT')
                        <div class="row">                      

        <div class="col-md-6 mb-3"> 
            <label>Game Company</label>
            <input type="text" name="name" value="{{ $gamecomp->name }}"class="form-control"  />
            @error('name') <small class="text-danger">{{$message}}</small> @enderror
              </div>
        <div class="col-md-6 mb-3"> 
            <label>Slug</label>
            <input type="text" name="slug" value="{{ $gamecomp->slug }}" class="form-control"  />
               </div>
       <button type="submit" class="btn btn-primary float-end">Update</button>
               </div>
</form>
</div>
</div>
</div>
@endsection