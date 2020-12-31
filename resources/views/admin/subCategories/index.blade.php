@extends('layouts.admin')
@section('content')
<div class="content">
    @can('sub_category_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.sub-categories.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.subCategory.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.subCategory.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">
                    <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-SubCategory">
                        <thead>
                            <tr>
                                <th width="10">

                                </th>
                                <th>
                                    {{ trans('cruds.subCategory.fields.id') }}
                                </th>
                                <th>
                                    {{ trans('cruds.subCategory.fields.subcategory_img') }}
                                </th>
                                <th>
                                    {{ trans('cruds.subCategory.fields.subcategory_code') }}
                                </th>
                                <th>
                                    {{ trans('cruds.subCategory.fields.subcategory_name') }}
                                </th>
                                <th>
                                    {{ trans('cruds.subCategory.fields.cat') }}
                                </th>
                                <th>
                                    {{ trans('cruds.productCategory.fields.category_code') }}
                                </th>
                                <th>
                                    {{ trans('cruds.subCategory.fields.subcategory_status') }}
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
@can('sub_category_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.sub-categories.massDestroy') }}",
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
    ajax: "{{ route('admin.sub-categories.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'subcategory_img', name: 'subcategory_img', sortable: false, searchable: false },
{ data: 'subcategory_code', name: 'subcategory_code' },
{ data: 'subcategory_name', name: 'subcategory_name' },
{ data: 'cat_category_name', name: 'cat.category_name' },
{ data: 'cat.category_code', name: 'cat.category_code' },
{ data: 'subcategory_status', name: 'subcategory_status' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'asc' ]],
    pageLength: 50,
  };
  let table = $('.datatable-SubCategory').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection