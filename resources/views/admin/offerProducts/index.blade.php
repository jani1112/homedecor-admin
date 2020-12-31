@extends('layouts.admin')
@section('content')
<div class="content">
    @can('offer_product_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.offer-products.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.offerProduct.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.offerProduct.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-OfferProduct">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.offerProduct.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.offerProduct.fields.offer_product') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.product.fields.hsn_code') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.offerProduct.fields.offer_product_status') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($offerProducts as $key => $offerProduct)
                                    <tr data-entry-id="{{ $offerProduct->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $offerProduct->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $offerProduct->offer_product->product_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $offerProduct->offer_product->hsn_code ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\OfferProduct::OFFER_PRODUCT_STATUS_SELECT[$offerProduct->offer_product_status] ?? '' }}
                                        </td>
                                        <td>
                                            @can('offer_product_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.offer-products.show', $offerProduct->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('offer_product_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.offer-products.edit', $offerProduct->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('offer_product_delete')
                                                <form action="{{ route('admin.offer-products.destroy', $offerProduct->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                                </form>
                                            @endcan

                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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
@can('offer_product_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.offer-products.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
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

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'asc' ]],
    pageLength: 50,
  });
  let table = $('.datatable-OfferProduct:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection