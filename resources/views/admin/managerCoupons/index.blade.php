@extends('layouts.admin')
@section('content')
<div class="content">
    @can('manager_coupon_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.manager-coupons.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.managerCoupon.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.managerCoupon.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-ManagerCoupon">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.managerCoupon.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.managerCoupon.fields.coupon_code') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.managerCoupon.fields.coupon_value') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.managerCoupon.fields.coupon_status') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($managerCoupons as $key => $managerCoupon)
                                    <tr data-entry-id="{{ $managerCoupon->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $managerCoupon->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $managerCoupon->coupon_code ?? '' }}
                                        </td>
                                        <td>
                                            {{ $managerCoupon->coupon_value ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\ManagerCoupon::COUPON_STATUS_SELECT[$managerCoupon->coupon_status] ?? '' }}
                                        </td>
                                        <td>
                                            @can('manager_coupon_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.manager-coupons.show', $managerCoupon->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('manager_coupon_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.manager-coupons.edit', $managerCoupon->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('manager_coupon_delete')
                                                <form action="{{ route('admin.manager-coupons.destroy', $managerCoupon->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('manager_coupon_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.manager-coupons.massDestroy') }}",
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
  let table = $('.datatable-ManagerCoupon:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection