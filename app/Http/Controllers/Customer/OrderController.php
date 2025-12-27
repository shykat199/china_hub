<?php

namespace App\Http\Controllers\Customer;

use App\Models\Contact;
use App\Models\Customer;
use App\Models\GeneralSetting;
use App\Models\OrderDetails;
use App\Models\Payment;
use App\Models\Productstock;
use App\Models\Shipping;
use App\Models\ShippingCharge;
use App\Models\SmsGateway;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Helpers\NotifyHelper;
use App\Models\Frontend\Page;
use App\Models\Frontend\Size;
use App\Models\Frontend\Color;
use App\Models\Frontend\Order;
use App\Models\Seller\Product;
use App\Models\Frontend\Seller;
use App\Models\Seller\Category;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Models\Frontend\OrderDetail;
use Illuminate\Support\Facades\Gate;
use App\Models\Frontend\OrderTimeline;
use App\Models\Frontend\User;
use Illuminate\Support\Facades\Session;
use shurjopayv2\ShurjopayLaravelPackage8\Http\Controllers\ShurjopayController;
use WpOrg\Requests\Auth;

class OrderController extends Controller
{
    use NotifyHelper;

    public function __construct()
    {
        //$this->middleware('auth:customer');
    }

    /**
     * Display order list
     *
     * @return View
     */
    public function index(): View
    {
        $orders = OrderDetail::query()
            ->where('user_id',auth()->id())
            ->paginate(10);

        $stat = 0;

        return view('customer.pages.order',compact('orders','stat'));
    }
    public function gustOrder($mobile=null) : View
    {
        $user_id= session('user_id') ?? User::query()->where('mobile',$mobile)->first()->id;
        $orders = OrderDetail::query()
            ->where('user_id',$user_id)
            ->paginate(10);

        $stat = 0;
        //return $orders;

        return view('customer.pages.order',compact('orders','stat'));
    }

    public function invoice($id)
    {
        $order = Order::query()->findOrFail($id);

        if(Gate::denies('access',$order)){
            abort(401);
        }

        $customer = $order->customer;

        return view('customer.pages.invoice',compact('order','customer'));
    }

    /**
     * Display an ordered item details
     *
     * @param $id
     * @return View
     */
    public function details($id) : View
    {

        $order = OrderDetail::query()->with('seller:id,company_name')->findOrFail($id);
        /* if(Gate::denies('access',$order)){
            abort(401);
        } */

        return view('customer.pages.order-details',compact('order'));
    }

    /**
     * Display the order cancel page
     *
     * @param $id
     * @return View
     */
    public function orderStatusChange(Request $request)
    {
        $request->validate([
            'status' => 'required|integer',
            'order_id' => 'required|integer',
        ]);

        if ($request->status == 7 || $request->status == 8)
        {
            $status = $request->status;
            $order = OrderDetail::query()->findOrFail($request->order_id);

            if ($order->color) {
                $color = Color::where('name', $order->color)->first()->id;
                Session::put('color_id', $color);
            }

            if ($order->size) {
                $size = Size::where('name', $order->size)->first()->id;
                Session::put('size_id', $size);
            }

            // Notification to seller
            $message = $request->status == 7 ? __('Order has been cancled.') : __('Order has been returned.');
            $this->SellerNotification($order->seller_id, $order->order_id, route('seller.orders.index', ['order' => $order->order_id]), $message);

            if(Gate::denies('access',$order)){
                abort(401);
            }
            $cancellationPolicy = Page::query()->where('menu_id',17)->first();
            return view('customer.pages.order-cancel', compact('order','cancellationPolicy', 'status'));
        } else {
            return back()->with('error', __('Unknown status.'));
        }
    }

    /**
     * Display an order list in customer dashboard
     *
     * @param Request $request
     * @return View
     */
    public function list(Request $request): View
    {
        $user_id= session('user_id') ?? User::query()->where('mobile',request('mobile'))->first()->id;
       // $order = OrderDetail::query()->where('user_id',auth('customer')->id());
        $order = OrderDetail::query()->where('user_id', $user_id);

        if($request->has('stat')){
            $stat = $request->get('stat');
            if($stat > 0){
                $order->where('order_stat',$stat);
            }
        }else{
            $stat = 0;
        }

        if($request->has('search')){
            $search = $request->get('search');
            $order->where('order_no','like','%'.$search.'%');
        }

        $orders = $order->latest()->paginate(10);

        return view('customer.pages._order_list',compact('orders','stat'));
    }

    public function cancel(Request $request, $id)
    {
        $is_confirm = $request->get('confirm');

        if(!$is_confirm){
            return redirect()->back();
        }

        $details = OrderDetail::query()->findOrFail($id);
        $order = Order::query()->findOrFail($details->order_id);

        $product = Product::find($details->product_id);
        if ($product->is_manage_stock) {
            $product->quantity = $product->quantity + $details->qty;
            $product->save();
        }

        if ($details->color || $details->size) {
            $stock = Productstock::where('product_id', $product->id)->where('color_id', session('color_id'))->where('size_id', session('size_id'))->first();
            $stock->quantities = $stock->quantities + $details->qty;
            $stock->save();
        }

        if(Gate::denies('access',$order)){
            abort(401);
        }

        if ($order->payment_status === 'paid')
        {
            $product = Product::findOrFail($request->product_id);
            $cateogry = Category::findOrFail($product->category_id);
            $seller = Seller::findOrFail($product->seller_id);

            $commission = ($details->sale_price / 100) * $cateogry->commission_rate;
            $seller->update([
                'wallet' => $seller->wallet - ($details->sale_price - $commission)
            ]);
        }

        $data = [
            'order_detail_id' => $id,
            'user_id' => auth('customer')->id(),
            'product_id' => $request->product_id,
            'order_stat' => $request->order_stat,
            'order_stat_desc' => $request->order_stat_desc,
            'order_stat_datetime' => now(),
            'remarks' => $request->remarks,
        ];

        OrderTimeline::query()->create($data);

        $details->update(['order_stat' => $request->order_stat]);

        return redirect('order');
    }

    public function order_save(Request $request){
        dd($request->all());
//        $this->validate($request,[
//            'name'=>'required',
//            'phone'=>'required',
//            'address'=>'required',
//            'area'=>'required',
//        ]);
//        if(Cart::instance('shopping')->count() <= 0) {
//            Toastr::error('Your shopping empty', 'Failed!');
//            return redirect()->back();
//        }

//        $subtotal = Cart::instance('shopping')->subtotal();
//        $subtotal = str_replace(',','',$subtotal);
//        $subtotal = str_replace('.00', '',$subtotal);
//        $discount = Session::get('discount');
//
//        $shippingfee  = Session::get('shipping');
//        $shipping_area  = ShippingCharge::where('id', $request->area)->first();
//        if(\Illuminate\Support\Facades\Auth::guard('customer')->user()){
//            $customer_id = \Illuminate\Support\Facades\Auth::guard('customer')->user()->id;
//        }else{
//            $exits_customer = Customer::where('phone',$request->phone)->select('phone','id')->first();
//            if($exits_customer){
//                $customer_id = $exits_customer->id;
//            }else{
//                $password = rand(111111,999999);
//                $store              = new Customer();
//                $store->name        = $request->name;
//                $store->slug        = $request->name;
//                $store->phone       = $request->phone;
//                $store->password    = bcrypt($password);
//                $store->verify      = 1;
//                $store->status      = 'active';
//                $store->save();
//                $customer_id = $store->id;
//            }
//
//        }

        // order data save
//        $order                   = new \App\Models\Order();
//        $order->invoice_id       = rand(11111,99999);
//        $order->amount           = ($subtotal + $shippingfee) - $discount;
//        $order->discount         = $discount ? $discount : 0;
//        $order->shipping_charge  = $shippingfee;
//        $order->customer_id      =  $customer_id;
//        $order->order_status     = 1;
//        $order->note             = $request->note;
//        $order->save();
//
//        // shipping data save
//        $shipping              =   new Shipping();
//        $shipping->order_id    =   $order->id;
//        $shipping->customer_id =   $customer_id;
//        $shipping->name        =   $request->name;
//        $shipping->phone       =   $request->phone;
//        $shipping->address     =   $request->address;
//        $shipping->area        =   $shipping_area->name;
//        $shipping->save();
//
//        // payment data save
//        $payment                 = new Payment();
//        $payment->order_id       = $order->id;
//        $payment->customer_id    = $customer_id;
//        $payment->payment_method = $request->payment_method;
//        $payment->amount         = $order->amount;
//        $payment->payment_status = 'pending';
//        $payment->save();

        // order details data save
//        foreach(Cart::instance('shopping')->content() as $cart){
//            $order_details                  =   new OrderDetails();
//            $order_details->order_id        =   $order->id;
//            $order_details->product_id      =   $cart->id;
//            $order_details->product_name    =   $cart->name;
//            $order_details->purchase_price  =   $cart->options->purchase_price;
//            $order_details->product_color   =   $cart->options->product_color;
//            $order_details->product_size    =   $cart->options->product_size;
//            $order_details->sale_price      =   $cart->price;
//            $order_details->qty             =   $cart->qty;
//            $order_details->save();
//        }

//        Cart::instance('shopping')->destroy();
//
//        Toastr::success('Thanks, Your order place successfully', 'Success!');
//        $site_setting = GeneralSetting::where('status', 1)->first();
//        $sms_gateway = SmsGateway::where(['status'=> 1, 'order'=>'1'])->first();
//
//        $contact = Contact::where('status',1)->first();


//        if($sms_gateway) {
//            $url = "$sms_gateway->url";
//            $data = [
//                "api_key" => "$sms_gateway->api_key",
//                "number" => $request->phone,
//                "type" => 'text',
//                "senderid" => "$sms_gateway->serderid",
//                "message" => "Dear $request->name!\r\nYour order#".$order->invoice_id." has been successfully placed. Thank you for using $site_setting->name"
//            ];
//            $ch = curl_init();
//            curl_setopt($ch, CURLOPT_URL, $url);
//            curl_setopt($ch, CURLOPT_POST, 1);
//            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
//            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//            $response = curl_exec($ch);
//            curl_close($ch);
//        }



//        if($request->payment_method=='bkash'){
//            return redirect('/bkash/checkout-url/create?order_id='.$order->id);
//        }elseif($request->payment_method=='shurjopay'){
//            $info = array(
//                'currency' => "BDT",
//                'amount' => $order->amount,
//                'order_id' => uniqid(),
//                'discsount_amount' =>0 ,
//                'disc_percent' =>0 ,
//                'client_ip' => $request->ip(),
//                'customer_name' =>  $request->name,
//                'customer_phone' => $request->phone,
//                'email' => "customer@gmail.com",
//                'customer_address' => $request->address,
//                'customer_city' => $request->area,
//                'customer_state' => $request->area,
//                'customer_postcode' => "1212",
//                'customer_country' => "BD",
//                'value1' => $order->id
//            );
//            $shurjopay_service = new ShurjopayController();
//            return $shurjopay_service->checkout($info);
//        }else{
//            return redirect('customer/order-success/'.$order->id);
//        }

    }
}
