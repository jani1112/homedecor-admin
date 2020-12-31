@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.create') }} {{ trans('cruds.subCategory.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.sub-categories.store") }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group {{ $errors->has('subcategory_img') ? 'has-error' : '' }}">
                            <label class="required" for="subcategory_img">{{ trans('cruds.subCategory.fields.subcategory_img') }}</label>
                            <div class="needsclick dropzone" id="subcategory_img-dropzone">
                            </div>
                            @if($errors->has('subcategory_img'))
                                <span class="help-block" role="alert">{{ $errors->first('subcategory_img') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.subCategory.fields.subcategory_img_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('subcategory_code') ? 'has-error' : '' }}">
                            <label class="required" for="subcategory_code">{{ trans('cruds.subCategory.fields.subcategory_code') }}</label>
                            <input class="form-control" type="text" name="subcategory_code" id="subcategory_code" value="{{ old('subcategory_code', '') }}" required>
                            @if($errors->has('subcategory_code'))
                                <span class="help-block" role="alert">{{ $errors->first('subcategory_code') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.subCategory.fields.subcategory_code_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('subcategory_name') ? 'has-error' : '' }}">
                            <label class="required" for="subcategory_name">{{ trans('cruds.subCategory.fields.subcategory_name') }}</label>
                            <input class="form-control" type="text" name="subcategory_name" id="subcategory_name" value="{{ old('subcategory_name', '') }}" required>
                            @if($errors->has('subcategory_name'))
                                <span class="help-block" role="alert">{{ $errors->first('subcategory_name') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.subCategory.fields.subcategory_name_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('cat') ? 'has-error' : '' }}">
                            <label class="required" for="cat_id">{{ trans('cruds.subCategory.fields.cat') }}</label>
                            <select class="form-control select2" name="cat_id" id="cat_id" required>
                                @foreach($cats as $id => $cat)
                                    <option value="{{ $id }}" {{ old('cat_id') == $id ? 'selected' : '' }}>{{ $cat }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('cat'))
                                <span class="help-block" role="alert">{{ $errors->first('cat') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.subCategory.fields.cat_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('subcategory_status') ? 'has-error' : '' }}">
                            <label class="required">{{ trans('cruds.subCategory.fields.subcategory_status') }}</label>
                            <select class="form-control" name="subcategory_status" id="subcategory_status" required>
                                <option value disabled {{ old('subcategory_status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\SubCategory::SUBCATEGORY_STATUS_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('subcategory_status', '1') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('subcategory_status'))
                                <span class="help-block" role="alert">{{ $errors->first('subcategory_status') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.subCategory.fields.subcategory_status_helper') }}</span>
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
    var uploadedSubcategoryImgMap = {}
Dropzone.options.subcategoryImgDropzone = {
    url: '{{ route('admin.sub-categories.storeMedia') }}',
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
      $('form').append('<input type="hidden" name="subcategory_img[]" value="' + response.name + '">')
      uploadedSubcategoryImgMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedSubcategoryImgMap[file.name]
      }
      $('form').find('input[name="subcategory_img[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($subCategory) && $subCategory->subcategory_img)
      var files = {!! json_encode($subCategory->subcategory_img) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="subcategory_img[]" value="' + file.file_name + '">')
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