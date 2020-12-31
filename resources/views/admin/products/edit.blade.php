@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.product.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.products.update", [$product->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group {{ $errors->has('product_img') ? 'has-error' : '' }}">
                            <label class="required" for="product_img">{{ trans('cruds.product.fields.product_img') }}</label>
                            <div class="needsclick dropzone" id="product_img-dropzone">
                            </div>
                            @if($errors->has('product_img'))
                                <span class="help-block" role="alert">{{ $errors->first('product_img') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.product.fields.product_img_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('catid') ? 'has-error' : '' }}">
                            <label class="required" for="catid_id">{{ trans('cruds.product.fields.catid') }}</label>
                            <select class="form-control select2" name="catid_id" id="catid_id" required>
                                @foreach($catids as $id => $catid)
                                    <option value="{{ $id }}" {{ (old('catid_id') ? old('catid_id') : $product->catid->id ?? '') == $id ? 'selected' : '' }}>{{ $catid }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('catid'))
                                <span class="help-block" role="alert">{{ $errors->first('catid') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.product.fields.catid_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('subcatid') ? 'has-error' : '' }}">
                            <label class="required" for="subcatid_id">{{ trans('cruds.product.fields.subcatid') }}</label>
                            <select class="form-control select2" name="subcatid_id" id="subcatid_id" required>
                                @foreach($subcatids as $id => $subcatid)
                                    <option value="{{ $id }}" {{ (old('subcatid_id') ? old('subcatid_id') : $product->subcatid->id ?? '') == $id ? 'selected' : '' }}>{{ $subcatid }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('subcatid'))
                                <span class="help-block" role="alert">{{ $errors->first('subcatid') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.product.fields.subcatid_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('product_name') ? 'has-error' : '' }}">
                            <label class="required" for="product_name">{{ trans('cruds.product.fields.product_name') }}</label>
                            <input class="form-control" type="text" name="product_name" id="product_name" value="{{ old('product_name', $product->product_name) }}" required>
                            @if($errors->has('product_name'))
                                <span class="help-block" role="alert">{{ $errors->first('product_name') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.product.fields.product_name_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('stock') ? 'has-error' : '' }}">
                            <label class="required" for="stock">{{ trans('cruds.product.fields.stock') }}</label>
                            <input class="form-control" type="number" name="stock" id="stock" value="{{ old('stock', $product->stock) }}" step="1" required>
                            @if($errors->has('stock'))
                                <span class="help-block" role="alert">{{ $errors->first('stock') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.product.fields.stock_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                            <label for="description">{{ trans('cruds.product.fields.description') }}</label>
                            <textarea class="form-control" name="description" id="description">{{ old('description', $product->description) }}</textarea>
                            @if($errors->has('description'))
                                <span class="help-block" role="alert">{{ $errors->first('description') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.product.fields.description_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
                            <label class="required" for="price">{{ trans('cruds.product.fields.price') }}</label>
                            <input class="form-control" type="number" name="price" id="price" value="{{ old('price', $product->price) }}" step="0.01" required>
                            @if($errors->has('price'))
                                <span class="help-block" role="alert">{{ $errors->first('price') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.product.fields.price_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('gst') ? 'has-error' : '' }}">
                            <label for="gst">{{ trans('cruds.product.fields.gst') }}</label>
                            <input class="form-control" type="number" name="gst" id="gst" value="{{ old('gst', $product->gst) }}" step="0.01">
                            @if($errors->has('gst'))
                                <span class="help-block" role="alert">{{ $errors->first('gst') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.product.fields.gst_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('final_price') ? 'has-error' : '' }}">
                            <label class="required" for="final_price">{{ trans('cruds.product.fields.final_price') }}</label>
                            <input class="form-control" type="number" name="final_price" id="final_price" value="{{ old('final_price', $product->final_price) }}" step="0.01" required>
                            @if($errors->has('final_price'))
                                <span class="help-block" role="alert">{{ $errors->first('final_price') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.product.fields.final_price_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('hsn_code') ? 'has-error' : '' }}">
                            <label for="hsn_code">{{ trans('cruds.product.fields.hsn_code') }}</label>
                            <input class="form-control" type="text" name="hsn_code" id="hsn_code" value="{{ old('hsn_code', $product->hsn_code) }}">
                            @if($errors->has('hsn_code'))
                                <span class="help-block" role="alert">{{ $errors->first('hsn_code') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.product.fields.hsn_code_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('offer_price') ? 'has-error' : '' }}">
                            <label for="offer_price">{{ trans('cruds.product.fields.offer_price') }}</label>
                            <input class="form-control" type="number" name="offer_price" id="offer_price" value="{{ old('offer_price', $product->offer_price) }}" step="0.01">
                            @if($errors->has('offer_price'))
                                <span class="help-block" role="alert">{{ $errors->first('offer_price') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.product.fields.offer_price_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('product_status') ? 'has-error' : '' }}">
                            <label class="required">{{ trans('cruds.product.fields.product_status') }}</label>
                            <select class="form-control" name="product_status" id="product_status" required>
                                <option value disabled {{ old('product_status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Product::PRODUCT_STATUS_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('product_status', $product->product_status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('product_status'))
                                <span class="help-block" role="alert">{{ $errors->first('product_status') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.product.fields.product_status_helper') }}</span>
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
    var uploadedProductImgMap = {}
Dropzone.options.productImgDropzone = {
    url: '{{ route('admin.products.storeMedia') }}',
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
      $('form').append('<input type="hidden" name="product_img[]" value="' + response.name + '">')
      uploadedProductImgMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedProductImgMap[file.name]
      }
      $('form').find('input[name="product_img[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($product) && $product->product_img)
      var files = {!! json_encode($product->product_img) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="product_img[]" value="' + file.file_name + '">')
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