<?php

namespace App\Modules\Backend\OrderManagement\Http\Controllers;

use Throwable;
use Carbon\Carbon;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\Seller\Product;
use App\Models\Seller\Category;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Traits\ResponseMessage;
use Illuminate\Support\Facades\Auth;
use App\Models\Backend\WebAppearance;
use Illuminate\Contracts\Support\Renderable;
use App\Modules\Backend\OrderManagement\Entities\Order;
use App\Modules\Backend\SellerManagement\Entities\Seller;
use App\Modules\Backend\OrderManagement\Entities\OrderDetail;

class OrderController extends Controller
{
    use ResponseMessage;

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function search(Request $request)
    {
        $searchValue = $request->input('navbar_search');
        $order_overview = $this->orderOverview();
        return view('ordermanagement::orders.index', compact('order_overview', 'searchValue'));
    }

    public function index()
    {
        $searchValue = '';
        $order_overview = $this->orderOverview();
        return view('ordermanagement::orders.index', compact('order_overview', 'searchValue'));
    }

    /* Process ajax request */
    public function orderList(Request $request)
    {
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // total number of rows per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        $query = Order::query()
            ->when($request->order != '', function ($q) use ($request) {
                $q->where('id', '>=', $request->order);
            })
            ->latest();

        // specific seller
        if (auth('seller')->user() && auth('seller')->user()->getRoleNames()->first() == 'Seller') {
            $query
                ->whereHas('details', function ($query) {
                    $query->where('seller_id', 'like', '%' . auth()->id() . '%');
                });
        }
        // Total records
        $totalRecords = $query->count();
        $totalRecordswithFilter = $totalRecords;
        // Get records, also we have included search filter as well
        if (!empty($searchValue)) {
            $query
                ->where('order_no', 'like', '%' . $searchValue . '%')
                ->orWhere('user_first_name', 'like', '%' . $searchValue . '%')
                ->orWhere('user_last_name', 'like', '%' . $searchValue . '%')
                ->orWhere('shipping_address_1', 'like', '%' . $searchValue . '%')
                ->orWhere('total_price', 'like', '%' . $searchValue . '%')
                ->orWhere('discount', 'like', '%' . $searchValue . '%')
                ->orWhere('payment_by', 'like', '%' . $searchValue . '%');
            $totalRecordswithFilter = $query->count();
        }
        $records = $query
            ->with('orderStatus')
            ->orderBy($columnName, $columnSortOrder)
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();

        foreach ($records as $record) {

            $show_route = auth('seller')->user() ? route('seller.orders.show', $record->id) : route('backend.orders.show', $record->id);
            $delete_route = auth('seller')->user() ? route('seller.orders.show', $record->id) : route('backend.orders.destroy', $record->id);
            $edit_route = route('backend.order.edit.show', $record->order_no);
            $action = '';
            if (auth()->user()->can('delete_orders') || auth()->user()->hasRole('super-admin'))
                $action =   '<ul>
                                <li>
                                     <form user="deleteForm" method="POST"
                                              action="' . $delete_route . '">
                                            ' . csrf_field() . method_field("DELETE") . '
                                            <a class="p-0 action" href="javascript:void(0);"
                                               onclick="deleteWithSweetAlert(event,parentNode);">
                                                <button title="Delete">
                                                    <svg viewBox="0 0 10 11" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M8.65184 10.2545C8.63809 10.5288 8.36791 10.7452 8.03934 10.7452H2.31625C1.98768 10.7452 1.7175 10.5288 1.70375 10.2545L1.29504 3.04834H9.06055L8.65184 10.2545ZM3.88317 4.83823C3.88317 4.7234 3.77169 4.63027 3.63416 4.63027H3.23589C3.09844 4.63027 2.98688 4.72338 2.98688 4.83823V8.95529C2.98688 9.07014 3.09835 9.16324 3.23589 9.16324H3.63416C3.77163 9.16324 3.88317 9.07019 3.88317 8.95529V4.83823ZM5.62591 4.83823C5.62591 4.7234 5.51444 4.63027 5.37693 4.63027H4.97866C4.84121 4.63027 4.72968 4.72338 4.72968 4.83823V8.95529C4.72968 9.07014 4.84112 9.16324 4.97866 9.16324H5.37693C5.51441 9.16324 5.62591 9.07019 5.62591 8.95529V4.83823ZM7.36871 4.83823C7.36871 4.7234 7.25724 4.63027 7.11973 4.63027H6.72143C6.58396 4.63027 6.47245 4.72338 6.47245 4.83823V8.95529C6.47245 9.07014 6.58393 9.16324 6.72143 9.16324H7.11973C7.25721 9.16324 7.36871 9.07019 7.36871 8.95529V4.83823Z"/>
                                                        <path d="M1.0213 1.09395H3.66155V0.677051C3.66155 0.617846 3.71902 0.569824 3.78994 0.569824H6.56248C6.63337 0.569824 6.69083 0.617846 6.69083 0.677051V1.09393H9.33112C9.5436 1.09393 9.71582 1.23779 9.71582 1.41526V2.42468H0.636597V1.41528C0.636597 1.23782 0.808817 1.09395 1.0213 1.09395Z"/>
                                                    </svg>
                                                </button>
                                            </a>
                                     </form>
                                </li>

                                <li>
                                    <a class="p-0 action" href="' . $edit_route . '">
                                        <button title="Edit">
                                            <svg viewBox="0 0 11 11" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M8.72031 5.31576C8.48521 5.31576 8.29519 5.50625 8.29519 5.74089V9.1421C8.29519 9.37634 8.1047 9.56722 7.87007 9.56722H1.91801C1.68331 9.56722 1.49289 9.37634 1.49289 9.1421V3.19C1.49289 2.95575 1.68331 2.76487 1.91801 2.76487H5.3192C5.5543 2.76487 5.74432 2.57438 5.74432 2.33975C5.74432 2.10504 5.5543 1.91455 5.3192 1.91455H1.91801C1.21483 1.91455 0.642578 2.4868 0.642578 3.19V9.1421C0.642578 9.84529 1.21483 10.4175 1.91801 10.4175H7.87007C8.57326 10.4175 9.14551 9.84529 9.14551 9.1421V5.74089C9.14551 5.50579 8.95541 5.31576 8.72031 5.31576Z"/>
                                                <path d="M4.62759 4.9274C4.59785 4.95714 4.57785 4.99497 4.56936 5.03577L4.26879 6.53916C4.25477 6.60884 4.27688 6.68069 4.32702 6.73129C4.36742 6.77169 4.42184 6.79333 4.47758 6.79333C4.49112 6.79333 4.50521 6.79209 4.51923 6.78913L6.02218 6.48856C6.06383 6.48 6.10167 6.46007 6.13101 6.43025L9.49487 3.06645L7.99192 1.5636L4.62759 4.9274Z"/>
                                                <path d="M10.5329 0.525254C10.1184 0.110723 9.444 0.110723 9.02982 0.525254L8.44141 1.11362L9.94444 2.61652L10.5329 2.02808C10.7336 1.82786 10.8441 1.56084 10.8441 1.27686C10.8441 0.992876 10.7336 0.725864 10.5329 0.525254Z"/>
                                            </svg>
                                        </button>
                                    </a>
                                </li>
                            </ul>';

            $data_arr[] = array(
                "order_no" => '<a title="' . $record->cancel_note . '" href="' . $show_route . '"><span class="text-primary">' . $record->order_no . '</span>' .
                    date("d M Y", strtotime($record->created_at)) .
                    ' at ' . date("h:i A", strtotime($record->created_at)) . ($request->order_no == $record->id ? ' <i class="fa fa-bell text-danger" Area-hidden="true"></i> ' : ' ') . '</a>',

                "user_last_name" => $record->full_name() ?? '',
                "shipping_address_1" => $record->shipping_address_1 ?? '',
                "discount" => $record->discount ?? 0,
                "total_price" => $record->total_price ?? '',
                "payment_by" => $record->payment_by ?? '',
                "action" => $action
            );
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr,
        );

        return json_encode($response);
    }

    /* for pending orders */

    public function pendingOrder()
    {
        $order_overview = $this->orderOverview();
        return view('ordermanagement::orders.pending_orders', compact('order_overview'));
    }

    /* Process ajax request */
    public function pendingOrderList(Request $request)
    {
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // total number of rows per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        $query = Order::query();
        $query
            ->whereHas('details', function ($query) {
                $query->where('order_stat', 1);
            });
        // specific seller
        if (auth('seller')->user() && auth('seller')->user()->getRoleNames()->first() == 'Seller') {
            $query
                ->whereHas('details', function ($query) {
                    $query->where('seller_id', auth()->id());
                });
        }
        // Total records
        $query
            ->with('orderStatus', 'country')
            ->withSum('details', 'qty');
        $totalRecords = $query->count();
        $totalRecordswithFilter = $totalRecords;
        // Get records, also we have included search filter as well
        if (!empty($searchValue)) {
            $query
                ->where(function ($qry) use ($searchValue) {
                    $qry->orWhere('order_no', 'like', '%' . $searchValue . '%');
                    $qry->orWhere('user_first_name', 'like', '%' . $searchValue . '%');
                    $qry->orWhere('user_last_name', 'like', '%' . $searchValue . '%');
                    $qry->orWhere('created_at', 'like', '%' . $searchValue . '%');
                    $qry->orWhere('id', 'like', '%' . $searchValue . '%');
                });
            $totalRecordswithFilter = $query->count();
        }
        $records = $query
            ->orderBy($columnName, $columnSortOrder)
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();

        foreach ($records as $record) {
            $show_route = auth('seller')->user() ? route('seller.orders.show', $record->id) : route('backend.orders.show', $record->id);
            $action = '';
            if (auth()->user()->can('delete_orders') || auth()->user()->hasRole('super-admin'))
                $action =      '<div class="btn-group rounded-1">
                                    <a class="text-light bg-success px-1 order-action" data-id="' . $record->id . '" data-status="2" data-content="You want to confirm this, Are you sure?" href="' . route('backend.change-order-status', $record->id) . '">
                                        <i class="fa-solid fa-circle-check"></i> Confirmed
                                    </a>
                                    </form>
                                    <a class="text-light bg-danger px-1 order-action" data-id="' . $record->id . '" data-status="7" data-content="You want to confirm this, Are you sure?" href="' . route('backend.change-order-status', $record->id) . '">
                                        <i class="fa-solid fa-circle-xmark"></i> Cancle
                                    </a>
                                </div>';

            $data_arr[] = array(
                "order_no" => '<a href="' . $show_route . '"><span class="text-primary">' . $record->order_no . '</span>' .
                    date("d M Y", strtotime($record->created_at)) .
                    ' at ' . date("h:i A", strtotime($record->created_at)) . '</a>',

                "user_last_name" => $record->full_name(),
                "user_country" => $record->country->name,
                "details_sum_qty" => $record->details_sum_qty,
                "created_at" => $record->created_at ? date("d.m.Y", strtotime($record->created_at)) : '',
                "action" => $action
            );
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr,
        );

        return json_encode($response);
    }

    /* for confirmed orders */

    public function confirmedOrder()
    {
        $order_overview = $this->orderOverview();
        return view('ordermanagement::orders.confirmed_orders', compact('order_overview'));
    }

    /* Process ajax request */
    public function confirmedOrderList(Request $request)
    {
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // total number of rows per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        $query = Order::query();
        $query
            ->whereHas('details', function ($query) {
                $query->where('order_stat', 2);
            });

        // specific seller
        if (auth('seller')->user() && auth('seller')->user()->getRoleNames()->first() == 'Seller') {
            $query
                ->whereHas('details', function ($query) {
                    $query->where('seller_id', 'like', '%' . auth()->id() . '%');
                });
        }
        // Total records
        $totalRecords = $query->count();
        $totalRecordswithFilter = $totalRecords;
        // Get records, also we have included search filter as well
        if (!empty($searchValue)) {
            $query
                ->where(function ($qry) use ($searchValue) {
                    $qry->orWhere('order_no', 'like', '%' . $searchValue . '%');
                    $qry->orWhere('user_first_name', 'like', '%' . $searchValue . '%');
                    $qry->orWhere('user_last_name', 'like', '%' . $searchValue . '%');
                    $qry->orWhere('payment_by', 'like', '%' . $searchValue . '%');
                    $qry->orWhere('id', 'like', '%' . $searchValue . '%');
                });
            $totalRecordswithFilter = $query->count();
        }
        $records = $query
            ->with('orderStatus', 'customer')
            ->withSum('details', 'qty')
            ->orderBy($columnName, $columnSortOrder)
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();

        foreach ($records as $record) {
            $show_route = auth('seller')->user() ? route('seller.orders.show', $record->id) : route('backend.orders.show', $record->id);
            $delete_route = auth('seller')->user() ? route('seller.orders.show', $record->id) : route('backend.orders.destroy', $record->id);
            $action = '';
            if (auth()->user()->can('delete_orders') || auth()->user()->hasRole('super-admin'))
                $action =      '<ul>
                                <li>
                                     <form user="deleteForm" method="POST"
                                              action="' . $delete_route . '">
                                            ' . csrf_field() . method_field("DELETE") . '
                                            <a class="p-0 action" href="javascript:void(0);"
                                               onclick="deleteWithSweetAlert(event,parentNode);">
                                                <button title="Delete">
                                                    <svg viewBox="0 0 10 11" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M8.65184 10.2545C8.63809 10.5288 8.36791 10.7452 8.03934 10.7452H2.31625C1.98768 10.7452 1.7175 10.5288 1.70375 10.2545L1.29504 3.04834H9.06055L8.65184 10.2545ZM3.88317 4.83823C3.88317 4.7234 3.77169 4.63027 3.63416 4.63027H3.23589C3.09844 4.63027 2.98688 4.72338 2.98688 4.83823V8.95529C2.98688 9.07014 3.09835 9.16324 3.23589 9.16324H3.63416C3.77163 9.16324 3.88317 9.07019 3.88317 8.95529V4.83823ZM5.62591 4.83823C5.62591 4.7234 5.51444 4.63027 5.37693 4.63027H4.97866C4.84121 4.63027 4.72968 4.72338 4.72968 4.83823V8.95529C4.72968 9.07014 4.84112 9.16324 4.97866 9.16324H5.37693C5.51441 9.16324 5.62591 9.07019 5.62591 8.95529V4.83823ZM7.36871 4.83823C7.36871 4.7234 7.25724 4.63027 7.11973 4.63027H6.72143C6.58396 4.63027 6.47245 4.72338 6.47245 4.83823V8.95529C6.47245 9.07014 6.58393 9.16324 6.72143 9.16324H7.11973C7.25721 9.16324 7.36871 9.07019 7.36871 8.95529V4.83823Z"/>
                                                        <path d="M1.0213 1.09395H3.66155V0.677051C3.66155 0.617846 3.71902 0.569824 3.78994 0.569824H6.56248C6.63337 0.569824 6.69083 0.617846 6.69083 0.677051V1.09393H9.33112C9.5436 1.09393 9.71582 1.23779 9.71582 1.41526V2.42468H0.636597V1.41528C0.636597 1.23782 0.808817 1.09395 1.0213 1.09395Z"/>
                                                    </svg>
                                                </button>
                                            </a>
                                     </form>
                                </li>
                             </ul>';
            $data_arr[] = array(
                "order_no" => '<a href="' . $show_route . '"><span class="text-primary">' . $record->order_no . '</span>' .
                    date("d M Y", strtotime($record->created_at)) .
                    ' at ' . date("h:i A", strtotime($record->created_at)) . '</a>',

                "created_by" => $record->full_name(),
                "details_sum_qty" => $record->details_sum_qty,
                "payment_by" => $record->payment_by,
                "action" => $action
            );
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr,
        );

        return json_encode($response);
    }

    /* for processing orders */

    public function processingOrder()
    {
        $order_overview = $this->orderOverview();
        return view('ordermanagement::orders.processing_orders', compact('order_overview'));
    }

    /* Process ajax request */
    public function processingOrderList(Request $request)
    {
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // total number of rows per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        $query = Order::query();
        $query
            ->whereHas('details', function ($query) {
                $query->where('order_stat', 3);
            });
        // specific seller
        if (auth('seller')->user() && auth('seller')->user()->getRoleNames()->first() == 'Seller') {
            $query
                ->whereHas('details', function ($query) {
                    $query->where('seller_id', 'like', '%' . auth()->id() . '%');
                });
        }
        // Total records
        $totalRecords = $query->count();
        $totalRecordswithFilter = $totalRecords;
        // Get records, also we have included search filter as well
        if (!empty($searchValue)) {
            $query
                ->where(function ($qry) use ($searchValue) {
                    $qry->orWhere('order_no', 'like', '%' . $searchValue . '%');
                    $qry->orWhere('user_first_name', 'like', '%' . $searchValue . '%');
                    $qry->orWhere('user_last_name', 'like', '%' . $searchValue . '%');
                    $qry->orWhere('created_at', 'like', '%' . $searchValue . '%');
                    $qry->orWhere('id', 'like', '%' . $searchValue . '%');
                });
            $totalRecordswithFilter = $query->count();
        }
        $records = $query
            ->with('orderStatus', 'country')
            ->withSum('details', 'qty')
            ->orderBy($columnName, $columnSortOrder)
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();

        foreach ($records as $record) {
            $show_route = auth('seller')->user() ? route('seller.orders.show', $record->id) : route('backend.orders.show', $record->id);
            $delete_route = auth('seller')->user() ? route('seller.orders.show', $record->id) : route('backend.orders.destroy', $record->id);
            $action = '';
            if (auth()->user()->can('delete_orders') || auth()->user()->hasRole('super-admin'))
                $action =      '<ul>
                                <li>
                                     <form user="deleteForm" method="POST"
                                              action="' . $delete_route . '">
                                            ' . csrf_field() . method_field("DELETE") . '
                                            <a class="p-0 action" href="javascript:void(0);"
                                               onclick="deleteWithSweetAlert(event,parentNode);">
                                                <button title="Delete">
                                                    <svg viewBox="0 0 10 11" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M8.65184 10.2545C8.63809 10.5288 8.36791 10.7452 8.03934 10.7452H2.31625C1.98768 10.7452 1.7175 10.5288 1.70375 10.2545L1.29504 3.04834H9.06055L8.65184 10.2545ZM3.88317 4.83823C3.88317 4.7234 3.77169 4.63027 3.63416 4.63027H3.23589C3.09844 4.63027 2.98688 4.72338 2.98688 4.83823V8.95529C2.98688 9.07014 3.09835 9.16324 3.23589 9.16324H3.63416C3.77163 9.16324 3.88317 9.07019 3.88317 8.95529V4.83823ZM5.62591 4.83823C5.62591 4.7234 5.51444 4.63027 5.37693 4.63027H4.97866C4.84121 4.63027 4.72968 4.72338 4.72968 4.83823V8.95529C4.72968 9.07014 4.84112 9.16324 4.97866 9.16324H5.37693C5.51441 9.16324 5.62591 9.07019 5.62591 8.95529V4.83823ZM7.36871 4.83823C7.36871 4.7234 7.25724 4.63027 7.11973 4.63027H6.72143C6.58396 4.63027 6.47245 4.72338 6.47245 4.83823V8.95529C6.47245 9.07014 6.58393 9.16324 6.72143 9.16324H7.11973C7.25721 9.16324 7.36871 9.07019 7.36871 8.95529V4.83823Z"/>
                                                        <path d="M1.0213 1.09395H3.66155V0.677051C3.66155 0.617846 3.71902 0.569824 3.78994 0.569824H6.56248C6.63337 0.569824 6.69083 0.617846 6.69083 0.677051V1.09393H9.33112C9.5436 1.09393 9.71582 1.23779 9.71582 1.41526V2.42468H0.636597V1.41528C0.636597 1.23782 0.808817 1.09395 1.0213 1.09395Z"/>
                                                    </svg>
                                                </button>
                                            </a>
                                     </form>
                                </li>
                             </ul>';
            $data_arr[] = array(
                "order_no" => '<a href="' . $show_route . '"><span class="text-primary">' . $record->order_no . '</span>' .
                    date("d M Y", strtotime($record->created_at)) .
                    ' at ' . date("h:i A", strtotime($record->created_at)) . '</a>',

                "user_last_name" => $record->full_name(),
                "user_country" => $record->country->name,
                "details_sum_qty" => $record->details_sum_qty,
                "created_at" => $record->created_at ? date("d.m.Y", strtotime($record->created_at)) : '',
                "action" => $action
            );
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr,
        );

        return json_encode($response);
    }

    /* for picked orders */

    public function pickedOrder()
    {
        $order_overview = $this->orderOverview();
        return view('ordermanagement::orders.picked_orders', compact('order_overview'));
    }

    /* Process ajax request */
    public function pickedOrderList(Request $request)
    {
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // total number of rows per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        $query = Order::query();
        $query
            ->whereHas('details', function ($query) {
                $query->where('order_stat', 4);
            });

        // specific seller
        if (auth('seller')->user() && auth('seller')->user()->getRoleNames()->first() == 'Seller') {
            $query
                ->whereHas('details', function ($query) {
                    $query->where('seller_id', 'like', '%' . auth()->id() . '%');
                });
        }
        // Total records
        $totalRecords = $query->count();
        $totalRecordswithFilter = $totalRecords;
        // Get records, also we have included search filter as well
        if (!empty($searchValue)) {
            $query
                ->where(function ($qry) use ($searchValue) {
                    $qry->orWhere('order_no', 'like', '%' . $searchValue . '%');
                    $qry->orWhere('user_first_name', 'like', '%' . $searchValue . '%');
                    $qry->orWhere('user_last_name', 'like', '%' . $searchValue . '%');
                    $qry->orWhere('id', 'like', '%' . $searchValue . '%');
                });
            $totalRecordswithFilter = $query->count();
        }
        $records = $query
            ->with('orderStatus', 'country')
            ->withSum('details', 'qty')
            ->orderBy($columnName, $columnSortOrder)
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();

        foreach ($records as $record) {
            $show_route = auth('seller')->user() ? route('seller.orders.show', $record->id) : route('backend.orders.show', $record->id);
            $delete_route = auth('seller')->user() ? route('seller.orders.show', $record->id) : route('backend.orders.destroy', $record->id);
            $action = '';
            if (auth()->user()->can('delete_orders') || auth()->user()->hasRole('super-admin'))
                $action =      '<ul>
                                <li>
                                     <form user="deleteForm" method="POST"
                                              action="' . $delete_route . '">
                                            ' . csrf_field() . method_field("DELETE") . '
                                            <a class="p-0 action" href="javascript:void(0);"
                                               onclick="deleteWithSweetAlert(event,parentNode);">
                                                <button title="Delete">
                                                    <svg viewBox="0 0 10 11" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M8.65184 10.2545C8.63809 10.5288 8.36791 10.7452 8.03934 10.7452H2.31625C1.98768 10.7452 1.7175 10.5288 1.70375 10.2545L1.29504 3.04834H9.06055L8.65184 10.2545ZM3.88317 4.83823C3.88317 4.7234 3.77169 4.63027 3.63416 4.63027H3.23589C3.09844 4.63027 2.98688 4.72338 2.98688 4.83823V8.95529C2.98688 9.07014 3.09835 9.16324 3.23589 9.16324H3.63416C3.77163 9.16324 3.88317 9.07019 3.88317 8.95529V4.83823ZM5.62591 4.83823C5.62591 4.7234 5.51444 4.63027 5.37693 4.63027H4.97866C4.84121 4.63027 4.72968 4.72338 4.72968 4.83823V8.95529C4.72968 9.07014 4.84112 9.16324 4.97866 9.16324H5.37693C5.51441 9.16324 5.62591 9.07019 5.62591 8.95529V4.83823ZM7.36871 4.83823C7.36871 4.7234 7.25724 4.63027 7.11973 4.63027H6.72143C6.58396 4.63027 6.47245 4.72338 6.47245 4.83823V8.95529C6.47245 9.07014 6.58393 9.16324 6.72143 9.16324H7.11973C7.25721 9.16324 7.36871 9.07019 7.36871 8.95529V4.83823Z"/>
                                                        <path d="M1.0213 1.09395H3.66155V0.677051C3.66155 0.617846 3.71902 0.569824 3.78994 0.569824H6.56248C6.63337 0.569824 6.69083 0.617846 6.69083 0.677051V1.09393H9.33112C9.5436 1.09393 9.71582 1.23779 9.71582 1.41526V2.42468H0.636597V1.41528C0.636597 1.23782 0.808817 1.09395 1.0213 1.09395Z"/>
                                                    </svg>
                                                </button>
                                            </a>
                                     </form>
                                </li>
                             </ul>';
            $data_arr[] = array(
                "order_no" => '<a href="' . $show_route . '"><span class="text-primary">' . $record->order_no . '</span>' .
                    date("d M Y", strtotime($record->created_at)) .
                    ' at ' . date("h:i A", strtotime($record->created_at)) . '</a>',

                "user_last_name" => $record->full_name(),
                "user_country" => $record->country->name,
                "details_sum_qty" => $record->details_sum_qty,
                "action" => $action
            );
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr,
        );

        return json_encode($response);
    }

    /* for shipped orders */

    public function shippedOrder()
    {
        $order_overview = $this->orderOverview();
        return view('ordermanagement::orders.shipped_orders', compact('order_overview'));
    }

    /* Process ajax request */
    public function shippedOrderList(Request $request)
    {
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // total number of rows per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        $query = Order::query();
        $query
            ->whereHas('details', function ($query) {
                $query->where('order_stat', 5);
            });
        // specific seller
        if (auth('seller')->user() && auth('seller')->user()->getRoleNames()->first() == 'Seller') {
            $query
                ->whereHas('details', function ($query) {
                    $query->where('seller_id', 'like', '%' . auth()->id() . '%');
                });
        }
        $query
            ->with('orderStatus')
            ->withSum('details', 'qty');

        // Total records
        $totalRecords = $query->count();
        $totalRecordswithFilter = $totalRecords;
        // Get records, also we have included search filter as well
        if (!empty($searchValue)) {
            $query
                ->where(function ($qry) use ($searchValue) {
                    $qry->orWhere('order_no', 'like', '%' . $searchValue . '%');
                    $qry->orWhere('user_first_name', 'like', '%' . $searchValue . '%');
                    $qry->orWhere('user_last_name', 'like', '%' . $searchValue . '%');
                    $qry->orWhere('payment_by', 'like', '%' . $searchValue . '%');
                    $qry->orWhere('user_address_1', 'like', '%' . $searchValue . '%');
                    $qry->orWhere('total_price', 'like', '%' . $searchValue . '%');
                    $qry->orWhere('id', 'like', '%' . $searchValue . '%');
                });
            $totalRecordswithFilter = $query->count();
        }
        $records = $query
            ->orderBy($columnName, $columnSortOrder)
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();

        foreach ($records as $record) {
            $show_route = auth('seller')->user() ? route('seller.orders.show', $record->id) : route('backend.orders.show', $record->id);
            $delete_route = auth('seller')->user() ? route('seller.orders.show', $record->id) : route('backend.orders.destroy', $record->id);
            $action = '';
            if (auth()->user()->can('delete_orders') || auth()->user()->hasRole('super-admin'))
                $action =      '<ul>
                                <li>
                                     <form user="deleteForm" method="POST"
                                              action="' . $delete_route . '">
                                            ' . csrf_field() . method_field("DELETE") . '
                                            <a class="p-0 action" href="javascript:void(0);"
                                               onclick="deleteWithSweetAlert(event,parentNode);">
                                                <button title="Delete">
                                                    <svg viewBox="0 0 10 11" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M8.65184 10.2545C8.63809 10.5288 8.36791 10.7452 8.03934 10.7452H2.31625C1.98768 10.7452 1.7175 10.5288 1.70375 10.2545L1.29504 3.04834H9.06055L8.65184 10.2545ZM3.88317 4.83823C3.88317 4.7234 3.77169 4.63027 3.63416 4.63027H3.23589C3.09844 4.63027 2.98688 4.72338 2.98688 4.83823V8.95529C2.98688 9.07014 3.09835 9.16324 3.23589 9.16324H3.63416C3.77163 9.16324 3.88317 9.07019 3.88317 8.95529V4.83823ZM5.62591 4.83823C5.62591 4.7234 5.51444 4.63027 5.37693 4.63027H4.97866C4.84121 4.63027 4.72968 4.72338 4.72968 4.83823V8.95529C4.72968 9.07014 4.84112 9.16324 4.97866 9.16324H5.37693C5.51441 9.16324 5.62591 9.07019 5.62591 8.95529V4.83823ZM7.36871 4.83823C7.36871 4.7234 7.25724 4.63027 7.11973 4.63027H6.72143C6.58396 4.63027 6.47245 4.72338 6.47245 4.83823V8.95529C6.47245 9.07014 6.58393 9.16324 6.72143 9.16324H7.11973C7.25721 9.16324 7.36871 9.07019 7.36871 8.95529V4.83823Z"/>
                                                        <path d="M1.0213 1.09395H3.66155V0.677051C3.66155 0.617846 3.71902 0.569824 3.78994 0.569824H6.56248C6.63337 0.569824 6.69083 0.617846 6.69083 0.677051V1.09393H9.33112C9.5436 1.09393 9.71582 1.23779 9.71582 1.41526V2.42468H0.636597V1.41528C0.636597 1.23782 0.808817 1.09395 1.0213 1.09395Z"/>
                                                    </svg>
                                                </button>
                                            </a>
                                     </form>
                                </li>
                             </ul>';
            $data_arr[] = array(
                "order_no" => '<a href="' . $show_route . '"><span class="text-primary">' . $record->order_no . '</span>' .
                    date("d M Y", strtotime($record->created_at)) .
                    ' at ' . date("h:i A", strtotime($record->created_at)) . '</a>',

                "user_last_name" => $record->full_name(),
                "details_sum_qty" => $record->details_sum_qty,
                "payment_by" => $record->payment_by,
                "user_address_1" => $record->user_address_1,
                "total_price" => $record->total_price,
                "action" => $action
            );
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr,
        );

        return json_encode($response);
    }

    /* for delivered orders */

    public function deliveredOrder()
    {
        $order_overview = $this->orderOverview();
        return view('ordermanagement::orders.delivered_orders', compact('order_overview'));
    }

    /* Process ajax request */
    public function deliveredOrderList(Request $request)
    {
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // total number of rows per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        $query = Order::query();
        $query
            ->whereHas('details', function ($query) {
                $query->where('order_stat', 6);
            });
        // specific seller
        if (auth('seller')->user() && auth('seller')->user()->getRoleNames()->first() == 'Seller') {
            $query
                ->whereHas('details', function ($query) {
                    $query->where('seller_id', 'like', '%' . auth()->id() . '%');
                });
        }
        // Total records
        $totalRecords = $query->count();
        $totalRecordswithFilter = $totalRecords;
        // Get records, also we have included search filter as well
        if (!empty($searchValue)) {
            $query
                ->where(function ($qry) use ($searchValue) {
                    $qry->orWhere('order_no', 'like', '%' . $searchValue . '%');
                    $qry->orWhere('user_first_name', 'like', '%' . $searchValue . '%');
                    $qry->orWhere('user_last_name', 'like', '%' . $searchValue . '%');
                    $qry->orWhere('id', 'like', '%' . $searchValue . '%');
                });
            $totalRecordswithFilter = $query->count();
        }
        $records = $query
            ->with('orderStatus', 'country')
            ->withSum('details', 'qty')
            ->orderBy($columnName, $columnSortOrder)
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();

        foreach ($records as $record) {
            $show_route = auth('seller')->user() ? route('seller.orders.show', $record->id) : route('backend.orders.show', $record->id);
            $delete_route = auth('seller')->user() ? route('seller.orders.show', $record->id) : route('backend.orders.destroy', $record->id);
            $action = '';
            if (auth()->user()->can('delete_orders') || auth()->user()->hasRole('super-admin'))
                $action =      '<ul>
                                <li>
                                     <form user="deleteForm" method="POST"
                                              action="' . $delete_route . '">
                                            ' . csrf_field() . method_field("DELETE") . '
                                            <a class="p-0 action" href="javascript:void(0);"
                                               onclick="deleteWithSweetAlert(event,parentNode);">
                                                <button title="Delete">
                                                    <svg viewBox="0 0 10 11" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M8.65184 10.2545C8.63809 10.5288 8.36791 10.7452 8.03934 10.7452H2.31625C1.98768 10.7452 1.7175 10.5288 1.70375 10.2545L1.29504 3.04834H9.06055L8.65184 10.2545ZM3.88317 4.83823C3.88317 4.7234 3.77169 4.63027 3.63416 4.63027H3.23589C3.09844 4.63027 2.98688 4.72338 2.98688 4.83823V8.95529C2.98688 9.07014 3.09835 9.16324 3.23589 9.16324H3.63416C3.77163 9.16324 3.88317 9.07019 3.88317 8.95529V4.83823ZM5.62591 4.83823C5.62591 4.7234 5.51444 4.63027 5.37693 4.63027H4.97866C4.84121 4.63027 4.72968 4.72338 4.72968 4.83823V8.95529C4.72968 9.07014 4.84112 9.16324 4.97866 9.16324H5.37693C5.51441 9.16324 5.62591 9.07019 5.62591 8.95529V4.83823ZM7.36871 4.83823C7.36871 4.7234 7.25724 4.63027 7.11973 4.63027H6.72143C6.58396 4.63027 6.47245 4.72338 6.47245 4.83823V8.95529C6.47245 9.07014 6.58393 9.16324 6.72143 9.16324H7.11973C7.25721 9.16324 7.36871 9.07019 7.36871 8.95529V4.83823Z"/>
                                                        <path d="M1.0213 1.09395H3.66155V0.677051C3.66155 0.617846 3.71902 0.569824 3.78994 0.569824H6.56248C6.63337 0.569824 6.69083 0.617846 6.69083 0.677051V1.09393H9.33112C9.5436 1.09393 9.71582 1.23779 9.71582 1.41526V2.42468H0.636597V1.41528C0.636597 1.23782 0.808817 1.09395 1.0213 1.09395Z"/>
                                                    </svg>
                                                </button>
                                            </a>
                                     </form>
                                </li>
                             </ul>';
            $data_arr[] = array(
                "order_no" => '<a href="' . $show_route . '"><span class="text-primary">' . $record->order_no . '</span>' .
                    date("d M Y", strtotime($record->created_at)) .
                    ' at ' . date("h:i A", strtotime($record->created_at)) . '</a>',

                "user_last_name" => $record->full_name(),
                "user_country" => $record->country->name,
                "details_sum_qty" => $record->details_sum_qty,
                "action" => $action
            );
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr,
        );

        return json_encode($response);
    }

    /* for cancelled orders */

    public function cancelledOrder()
    {
        $order_overview = $this->orderOverview();
        return view('ordermanagement::orders.cancelled_orders', compact('order_overview'));
    }

    /* Process ajax request */
    public function cancelledOrderList(Request $request)
    {
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // total number of rows per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        $query = Order::query();
        $query
            ->whereHas('details', function ($query) {
                $query->where('order_stat', 7);
            });

        // specific seller
        if (auth('seller')->user() && auth('seller')->user()->getRoleNames()->first() == 'Seller') {
            $query
                ->whereHas('details', function ($query) {
                    $query->where('seller_id', 'like', '%' . auth()->id() . '%');
                });
        }
        // Total records
        $totalRecords = $query->count();
        $totalRecordswithFilter = $totalRecords;
        // Get records, also we have included search filter as well
        if (!empty($searchValue)) {
            $query
                ->where(function ($qry) use ($searchValue) {
                    $qry->orWhere('order_no', 'like', '%' . $searchValue . '%');
                    $qry->orWhere('user_first_name', 'like', '%' . $searchValue . '%');
                    $qry->orWhere('user_last_name', 'like', '%' . $searchValue . '%');
                    $qry->orWhere('user_address_1', 'like', '%' . $searchValue . '%');
                    $qry->orWhere('id', 'like', '%' . $searchValue . '%');
                });
            $totalRecordswithFilter = $query->count();
        }
        $records = $query
            ->with('orderStatus')
            ->withSum('details', 'qty')
            ->orderBy($columnName, $columnSortOrder)
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();

        foreach ($records as $record) {
            $show_route = auth('seller')->user() ? route('seller.orders.show', $record->id) : route('backend.orders.show', $record->id);
            $delete_route = auth('seller')->user() ? route('seller.orders.show', $record->id) : route('backend.orders.destroy', $record->id);

            $data_arr[] = array(
                "order_no" => '<a title="' . $record->cancel_note . '" href="' . $show_route . '"><span class="text-primary">' . $record->order_no . '</span>' .
                    date("d M Y", strtotime($record->created_at)) .
                    ' at ' . date("h:i A", strtotime($record->created_at)) . '</a>',

                "user_last_name" => $record->full_name(),
                "details_sum_qty" => $record->details_sum_qty,
                "user_address_1" => $record->user_address_1,

            );
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr,
        );

        return json_encode($response);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $order = Order::with('details.seller', 'orderStatus', 'customer', 'country')->findOrFail($id);
        $website = WebAppearance::findOrFail(1);
        return view('ordermanagement::orders.show', compact('order', 'website'));
    }

    public function cancelOrder(Request $request)
    {
        $order = Order::findOrFail($request->id);
        if ($order) {
            $order->update([
                'cancel_stat' => 1,
                'order_stat' => 7,
                'cancel_datetime' => now(),
                'cancel_note' => $request->note,
                'cancel_by_user' => Auth::id()
            ]);

            return response()->json($this->update_success_message);
        } else {
            return response()->json($this->not_found_message);
        }
    }

    /* update order status */
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        if ($order) {
            $data = $request->only(['order_stat']);
            if ($data['order_stat'] == 2)
                $data['confirmed_stat'] = 1;
            $data['confirmed_datetime'] = now();
            if ($data['order_stat'] == 3) {
                $data['processing_stat'] = 1;
                $data['processing_datetime'] = now();
            }
            if ($data['order_stat'] == 4) {
                $data['picked_stat'] = 1;
                $data['picked_datetime'] = now();
            }
            if ($data['order_stat'] == 5) {
                $data['shipped_stat'] = 1;
                $data['shipped_datetime'] = now();
            }
            if ($data['order_stat'] == 6) {
                $data['delivered_stat'] = 1;
                $data['delivered_datetime'] = now();
            }

            $order->update($data);
            return redirect()->back()->with($this->update_success_message);
        } else {
            return redirect()->back()->with($this->update_fail_message);
        }
    }

    /* update order status */
    public function updateOrderDetails(Request $request)
    {
        $request->validate([
            'order_stat' => 'required|integer|max:10',
            'order_stat_desc' => 'nullable|string|max:1000',
            'order_id' => 'required|integer|exists:orders,id',
            'product_id' => 'required|integer|exists:products,id',
            'orders_details_id' => 'required|integer|exists:order_details,id',
        ]);

        $order = Order::findOrFail($request->order_id);
        $order_details = OrderDetail::findOrFail($request->orders_details_id);

        if ($order->payment_status === 'unpaid' && $request->order_stat == 6) {
            $commission = $order_details->sale_price;
            $seller = Seller::find($order_details->seller_id);
            $product = Product::findOrFail($order_details->product_id);
            $cateogry = Category::findOrFail($product->category_id);

            if ($seller) {
                $commission = ($order_details->sale_price / 100) * $cateogry->commission_rate;

                Transaction::create([
                    'user_id' => $seller->id,
                    'amount' => ($order_details->sale_price - $commission),
                    'reason' => 'Sale',
                    'profit_for' => 'seller',
                ]);

                $seller->update([
                    'wallet' => $seller->wallet + ($order_details->sale_price - $commission)
                ]);
            }

            Transaction::create([
                'amount' => $commission,
                'reason' => 'Sale',
                'profit_for' => 'admin',
            ]);

            $order->payment_status = 'paid';
            $order->save();
        }

        $order_details->timelines()->create([
            'user_id' => $order_details->user_id,
            'order_stat' => $request->order_stat,
            'product_id' => $request->product_id,
            'order_stat_desc' => $request->order_stat_desc,
            'order_detail_id' => $request->order_detail_id,
            'order_stat_datetime' => $request->order_stat_datetime,
        ]);

        $order_details->order_stat = $request->order_stat;
        $order_details->save();

        return response()->json([
            'redirect' => url()->previous(),
            'message' => __('Status has been changed successfully.'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        try {
            $order = Order::with('details')->find($id);
            if ($order) {
                if ($order->details()->exists())
                    $order->details()->delete();

                $order->delete();
                if (auth('seller')->user())
                    return redirect()->route('seller.orders.index')->with($this->delete_success_message);
                else
                    return redirect()->route('backend.orders.index')->with($this->delete_success_message);
            } else {
                return back()->with($this->not_found_message);
            }
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
            return back()->with([
                'alert-type' => 'error',
                'message' => $ex->getMessage()
            ]);
        }
    }

    /* order overview collection */

    public function orderOverview()
    {
        $query = OrderDetail::query();

        // specific seller
        if (auth('seller')->user()) {
            $query->where('seller_id', 'like', '%' . auth()->id() . '%');
        }
        $orders = $query
            ->selectRaw('order_stat, count(*) as total')
            ->groupBy('order_stat')
            ->get();
        $order_overview = [];
        foreach ($orders as $key => $order) {
            $order_overview[$order->order_stat] = $order->total;
        }
        $order_overview['total_order'] = array_sum($order_overview);
        return $order_overview;
    }

    public function changeOrderStatus(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:orders,id',
            'status' => 'required|integer',
        ]);

        $order = Order::findOrFail($request->id);
        $order->details()->update([
            'order_stat' => $request->status,
        ]);

        return response()->json([
            'message' => 'Status updated successfully.',
            'redirect' => url()->previous()
        ]);
    }

    public function orderDetailsSeller($order_id = null, $seller_id = null)
    {
        //$orderDetails = OrderDetail::with('details.seller', 'orderStatus', 'customer', 'country')->findOrFail($id);
        $orderDetails = OrderDetail::with('order')->where('order_id', $order_id)->where('seller_id', $seller_id)->get();
        $website = WebAppearance::findOrFail(1);
        return view('ordermanagement::orders.seller_invoice', compact('orderDetails', 'website'));
    }



    // edit order
    public function edit(string $order_no)
    {
        $order = Order::where('order_no', $order_no)->get()->first();
        $countries = DB::table('countries')->get();

        // foreach($order->details as $key => $product){
        //     dump($product->product->images);
        // }
        // exit;
        return view('ordermanagement::orders.edit_order', compact('order', 'countries'));
    }


    // update order
    public function update_order(Request $request)
    {
        // dd($request->all());
        $validated_data = $request->validate([
            'discount' => 'integer',
            'shipping_cost' => 'integer',
            'total_price' => 'integer',
            'exchange_rate' => 'nullable|numeric',
            'paid_amount' => 'numeric',
            'payment_status' => 'string',
            'shipping_name' => 'string',
            'shipping_address_1' => 'string',
            'shipping_address_2' => 'string',
            'shipping_mobile' => 'string',
            'shipping_email' => 'nullable|email',
            'shipping_post' => 'nullable|string',
            'shipping_town' => 'nullable|string',
            'shipping_note' => 'nullable|string',
            'payment_by' => 'required',
            'vat' => 'numeric',
            'paid_amount' => 'required',
            'total_price' => 'required',
            'shipping_address_1' => 'required',
        ]);
        try {
            Order::where('id', $request->order_id)->update($request->except('order_id', '_token', '_method'));

            return redirect()->back()->with('message', 'Order updated successfully');
        } catch (\Throwable $th) {
            // dd($th->getMessage());
            Log::error($th->getMessage());
            return back()->with([
                'alert-type' => 'error',
                'message' => $th->getMessage()
            ]);
        }
    }


    // delete product from order
    public function order_product_delete(string $id)
    {
        try {
            $order_details = OrderDetail::where('id', $id)->first();
            // OrderDetail::where('id', $id)->delete();
            $order_details->delete();
            $this->UpdateTotal($order_details->order_id);

            return back()->with('message', 'Product from order successfully');
            
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return back()->with([
                'alert-type' => 'error',
                'message' => $th->getMessage()
            ]);
        }
    }


    // update product from order
    public function order_product_qtyUpdate(Request $request, string $id)
    {
        // dd($request->all());
        try {

            OrderDetail::where('id', $id)->update(['qty'=> $request->qty]);
            $order_id = OrderDetail::where('id', $id)->first(); 
            
            $this->UpdateTotal($order_id->order_id);

            return back()->with('message', 'Product quantity updated successfully');
          
        } catch (\Throwable $th) {
            // dd($th->getMessage());
            Log::error($th->getMessage());
            return back()->with([
                'alert-type' => 'error',
                'message' => $th->getMessage()
            ]);
        }
    }


    // search product to add
    public function order_product_add(Request $request)
    {
        $keyword = $request->name;
        $products = DB::table('products')->where('name', 'like', '%' . $keyword . '%')->get()->toArray();

        return response()->json($products);
    }



    // add product to order

    public function order_add_product(string $order_id, string $product_id)
    {
    
        try {
            $order_details = OrderDetail::where('order_id', $order_id)->get()->first()->toArray();
            $product = DB::table('products')->find($product_id);
            $order_details["product_id"] = $product->id;
            $order_details["sale_price"] = $product->sale_price;
            $order_details["qty"] = 1;
            $order_details["total_shipping_cost"] = $order_details["qty"] * $order_details["shipping_cost"];
            $order_details["total_price"] = $order_details["qty"] * $order_details["sale_price"];
            $order_details["grand_total"] = $order_details["total_price"] + $order_details["total_shipping_cost"];
    
            // dd($order_details, $product->sale_price);
    
            OrderDetail::create($order_details);
            $this->UpdateTotal($order_id);

            return back()->with('message', 'Product added successfully');
        } catch (\Throwable $th) {
            // dd($th->getMessage());
            Log::error($th->getMessage());
            return back()->with([
                'alert-type' => 'error',
                'message' => $th->getMessage()
            ]);
        }

    }


    private function UpdateTotal($order_id)
    {
        $getDetails = OrderDetail::where('order_id', $order_id)->get(); 
            $total = 0;
        foreach ($getDetails as  $v) {
            $total += $v->sale_price * $v->qty;
        }
        Order::where('id', $order_id)->update(['total_price' => $total]);
    }


    
}
