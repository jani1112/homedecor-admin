<div class="content">
    @can('featured_product_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.featured-products.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.featuredProduct.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.featuredProduct.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">

                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-featuredProductFeaturedProducts">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.featuredProduct.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.featuredProduct.fields.featured_product') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.product.fields.hsn_code') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.featuredProduct.fields.featured_product_status') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($featuredProducts as $key => $featuredProduct)
                                    <tr data-entry-id="{{ $featuredProduct->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $featuredProduct->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $featuredProduct->featured_product->product_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $featuredProduct->featured_product->hsn_code ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\FeaturedProduct::FEATURED_PRODUCT_STATUS_SELECT[$featuredProduct->featured_product_status] ?? '' }}
                                        </td>
                                        <td>
                                            @can('featured_product_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.featured-products.show', $featuredProduct->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('featured_product_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.featured-products.edit', $featuredProduct->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('featured_product_delete')
                                                <form action="{{ route('admin.featured-products.destroy', $featuredProduct->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('featured_product_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.featured-products.massDestroy') }}",
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
  let table = $('.datatable-featuredProductFeaturedProducts:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection