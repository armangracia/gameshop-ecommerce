@extends('layouts.admin')

@section('content')

<div class="row">
<div class ="col-md-12">
        @if (session('message'))
        <div class ="alert alert-success">{{session('message')}}</div>
        @endif
        <div class ="card">
            <div class ="card-header">
                <h3>Edit Slider
                    <a href ="{{url('admin/sliders/') }}" class ="btn btn-danger btn-sm text-white float-end">
                        Back
                    </a>
                </h3> 
            </div>
            <div class="card-body">
            <form method="POST" action="{{ url('admin/sliders/'.$slider->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT');

                    <div class ="mb-3">
                        <label>Title</label>
                        <input type ="text" name="title" value="{{ $slider->title }}"class="form-control">
                    </div>
                    <div class ="mb-3">
                        <label>Description</label>
                        <textarea name="description"class="from-control" rows="3">{{ $slider->description }}</textarea>
                    </div>

                    <div class ="mb-3">
                        <label>Image</label> </br>
                        <input type="file" name="image" class="from-control"/>
                        <img src="{{ asset("$slider->image") }}" style="width: 50px; height: 50px" alt= "Slider"/>
                    </div>
  
                        <div class ="mb-3">
                            <label>Status</label><br/>
                            <input type ="checkbox" name="status"{{ $slider->status == '1' ? 'checked':''}}style ="width:30px;height:30px"/>
                            Checked=Hidden,Unchecked=Visible
                        </div>
                    <div class ="mb-3">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection