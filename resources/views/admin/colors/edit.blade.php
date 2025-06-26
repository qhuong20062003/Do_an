@extends('admin.layouts.admin')

@section('title')
<title>Chỉnh sửa màu sắc</title>
@endsection

@section('content')
<div class="content-wrapper">
    @include('admin.partials.content-header', ['name' => 'Màu sắc', 'key' => 'Chỉnh sửa'])

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h5 class="mb-4">Cập nhật màu sắc</h5>
                    <form action="{{ route('colors.update', ['id' => $color->id]) }}" method="post">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tên màu</label>
                                <input type="text" class="form-control" name="name" value="{{ $color->name }}" placeholder="Nhập tên màu">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Mã màu</label>
                                <input type="text" class="form-control" id="code" name="code" value="{{ $color->code }}" placeholder="VD: #ff0000">
                            </div>

                            <div class="col-md-2 mb-3 d-flex align-items-end">
                                <div id="color-preview" class="rounded border shadow-sm" style="width: 50px; height: 35px; background-color: {{ $color->code }}"></div>
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    const colorInput = document.getElementById('code');
    const previewBox = document.getElementById('color-preview');

    colorInput?.addEventListener('input', function() {
        previewBox.style.backgroundColor = this.value;
    });
</script>
@endsection