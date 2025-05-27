@extends('layouts.admin')
 
 @section('title')
  <title>Trang chu</title>
@endsection

 @section(section: 'content')
 <div class="content-wrapper">
    @include('partials.content-header',['name' => 'category','key'=> 'Add'])

    <div class="content">
      <div class="container-fluid">
        <div class="row">
        <div class="col-md-6">
        <form action="{{ route('categories.store') }}" method="post">
          @csrf
        <div class="form-group">
            <label>Tên danh mục</label>
            <input type="text" 
                  class="form-control" 
                  name="name"
                  placeholder="Nhập tên danh mục">

            <div class="form-group">
                <label>Example select</label>
                <select class="form-control" name="parent_id" >
                <option value="0">Chọn danh mục cha</option>
                {!! $htmlOption !!}
                </select>
            </div>
        </div>
        
        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        </div>
        




          
        </div>
      </div>
    </div>
  </div>
 @endsection
 
 


