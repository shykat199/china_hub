@extends('backend.layouts.app')
@section('title','Orders - ')
@push('css')
    @include('backend.includes.datatable_css')
@endpush
@section('content')
    <div class="content-body">
    @include('ordermanagement::orders.order_overview')
    <!-- Tab Content Start -->
        <div class="tab-content order-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="order-list" Area-labelledby="order-list-tab">
                <div class="container">

                    <div class="content-table mt-0">
                        <table id="mDataTable" class="table p-table">
                            <thead>
                            <tr>
                                <th scope="col">{{ __('Invoice#') }}</th>
                                <th scope="col">{{ __('Name') }}</th>
                                <th scope="col">{{ __('Shipping') }}</th>
                                <th scope="col">{{ __('Discount') }}</th>
                                <th scope="col">{{ __('Total') }}</th>
                                <th scope="col">{{ __('Payment') }}</th>
                                <th scope="col">{{ __('Action') }}</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>

                    </div>
                </div>

            </div>
        </div>
        <!-- Tab Content End -->
    </div>




    <!-- edit modal -->

    <!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


@endsection

@push('js')
    @include('backend.includes.datatable_js')
    <script>

        $(function() {
            "use strict";

            $(document).ready(function(){
                // DataTable
                var table = $('#mDataTable');
                table.DataTable({
                    ajax: "@auth('admin'){{route('backend.orders.list')}}@elseauth('seller'){{route('seller.orders.list', ['order_no' => request('order')])}}@endauth",
                    columns: [
                        { data: 'order_no' },
                        { data: 'user_last_name' },
                        { data: 'shipping_address_1'},
                        { data: 'discount' },
                        { data: 'total_price' },
                        { data: 'payment_by' },
                        { data: 'action',searchable:false,sortable:false },
                    ]
                });
                let method = "<?php echo Route::getCurrentRoute()->getName(); ?>";
                if(method == 'backend.search'){
                    let searchValue = "<?php echo $searchValue; ?>";
                    table.DataTable().search(searchValue).draw();
                }
                else if(method == 'seller.search'){
                    let searchValue = "<?php echo $searchValue; ?>";
                    table.DataTable().search(searchValue).draw();
                }

            });
        });
    </script>
@endpush
