@extends('layouts.admin')
@section('content')
<div class="content">
    @can('product_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.products.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.product.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.product.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">
                    <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Product">
                        <thead>
                            <tr>
                                <th width="10">

                                </th>
                                <th>
                                    {{ trans('cruds.product.fields.id') }}
                                </th>
                                <th>
                                    {{ trans('cruds.product.fields.product_img') }}
                                </th>
                                <th>
                                    {{ trans('cruds.product.fields.catid') }}
                                </th>
                                <th>
                                    {{ trans('cruds.productCategory.fields.category_code') }}
                                </th>
                                <th>
                                    {{ trans('cruds.product.fields.subcatid') }}
                                </th>
                                <th>
                                    {{ trans('cruds.subCategory.fields.subcategory_code') }}
                                </th>
                                <th>
                                    {{ trans('cruds.product.fields.product_name') }}
                                </th>
                                <th>
                                    {{ trans('cruds.product.fields.stock') }}
                                </th>
                                <th>
                                    {{ trans('cruds.product.fields.description') }}
                                </th>
                                <th>
                                    {{ trans('cruds.product.fields.price') }}
                                </th>
                                <th>
                                    {{ trans('cruds.product.fields.gst') }}
                                </th>
                                <th>
                                    {{ trans('cruds.product.fields.final_price') }}
                                </th>
                                <th>
                                    {{ trans('cruds.product.fields.hsn_code') }}
                                </th>
                                <th>
                                    {{ trans('cruds.product.fields.offer_price') }}
                                </th>
                                <th>
                                    {{ trans('cruds.product.fields.product_status') }}
                                </th>
                                <th>
                                    &nbsp;
                                </th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>



        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('product_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.products.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.products.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'product_img', name: 'product_img', sortable: false, searchable: false },
{ data: 'catid_category_name', name: 'catid.category_name' },
{ data: 'catid.category_code', name: 'catid.category_code' },
{ data: 'subcatid_subcategory_name', name: 'subcatid.subcategory_name' },
{ data: 'subcatid.subcategory_code', name: 'subcatid.subcategory_code' },
{ data: 'product_name', name: 'product_name' },
{ data: 'stock', name: 'stock' },
{ data: 'description', name: 'description' },
{ data: 'price', name: 'price' },
{ data: 'gst', name: 'gst' },
{ data: 'final_price', name: 'final_price' },
{ data: 'hsn_code', name: 'hsn_code' },
{ data: 'offer_price', name: 'offer_price' },
{ data: 'product_status', name: 'product_status' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'asc' ]],
    pageLength: 50,
  };
  let table = $('.datatable-Product').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection