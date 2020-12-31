@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.create') }} {{ trans('cruds.productCategory.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.product-categories.store") }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group {{ $errors->has('category_img') ? 'has-error' : '' }}">
                            <label class="required" for="category_img">{{ trans('cruds.productCategory.fields.category_img') }}</label>
                            <div class="needsclick dropzone" id="category_img-dropzone">
                            </div>
                            @if($errors->has('category_img'))
                                <span class="help-block" role="alert">{{ $errors->first('category_img') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.productCategory.fields.category_img_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('category_code') ? 'has-error' : '' }}">
                            <label class="required" for="category_code">{{ trans('cruds.productCategory.fields.category_code') }}</label>
                            <input class="form-control" type="text" name="category_code" id="category_code" value="{{ old('category_code', '') }}" required>
                            @if($errors->has('category_code'))
                                <span class="help-block" role="alert">{{ $errors->first('category_code') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.productCategory.fields.category_code_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('category_name') ? 'has-error' : '' }}">
                            <label class="required" for="category_name">{{ trans('cruds.productCategory.fields.category_name') }}</label>
                            <input class="form-control" type="text" name="category_name" id="category_name" value="{{ old('category_name', '') }}" required>
                            @if($errors->has('category_name'))
                                <span class="help-block" role="alert">{{ $errors->first('category_name') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.productCategory.fields.category_name_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('category_status') ? 'has-error' : '' }}">
                            <label class="required">{{ trans('cruds.productCategory.fields.category_status') }}</label>
                            <select class="form-control" name="category_status" id="category_status" required>
                                <option value disabled {{ old('category_status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\ProductCategory::CATEGORY_STATUS_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('category_status', '1') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('category_status'))
                                <span class="help-block" role="alert">{{ $errors->first('category_status') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.productCategory.fields.category_status_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>



        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    var uploadedCategoryImgMap = {}
Dropzone.options.categoryImgDropzone = {
    url: '{{ route('admin.product-categories.storeMedia') }}',
    maxFilesize: 10, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 10,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="category_img[]" value="' + response.name + '">')
      uploadedCategoryImgMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedCategoryImgMap[file.name]
      }
      $('form').find('input[name="category_img[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($productCategory) && $productCategory->category_img)
      var files = {!! json_encode($productCategory->category_img) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="category_img[]" value="' + file.file_name + '">')
        }
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
@endsection