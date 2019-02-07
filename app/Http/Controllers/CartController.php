<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Cart;
use redirect;
use App\Models\Shipping;
use App\Models\Order;
use App\Models\OrderProduct;
use DB;
use Session;
class CartController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $content=Cart::content();
        $total = Cart::total();
        $countCart = Cart::count();
        return view('site.cart.index', compact('content','total','countCart'));
    }

    public function addToCart(Request $request)
    {
        $productBy = Product::find($request->product_id);
        Cart::add(array('id'=>$productBy->id,
                         'name'=>$productBy->name,
                         'qty'=>$request->quantity,
                         'price'=>$productBy->price_sale,
                         'options'=>array('img'=>$productBy->image)
                         )
                     ); 

        $content=Cart::content();  
        return response()->json(array('success' => true)); 
        die();
    }

    public function update(Request $request)
    {
        Cart::update($request->id,$request->qty);
        return response()->json(array('success' => true)); 
        die();
    }

    public function destroy(Request $request)
    {  
        $id = $request->id;
        Cart::remove($request->id);
        return response()->json(array('success' => true,'id'=>$id)); 
        die(); 
    }

    public function checkout()
    {
        $content=Cart::content();
        $amount = 0;
        $total = Cart::total();
        $countCart = Cart::count();
        return view('site.cart.checkout', compact('content','total','countCart'));
    }

    public function checkout_store(Request $request)
    {
        $content= Cart::content();
        $amount = 0;
        foreach ($content as $value) {
            $amount += $value->price * $value->qty;
        }
        $data['amount'] = $amount;
        $data['pay_fee'] = 0;
        $data['status'] = 0;
        $data['pay_method'] = $request->pay_method;
        
        $order = Order::create($data);
        if ($order) {
            $ship_id = $request->session()->get('ship_id');
            Shipping::find($ship_id)->update(['order_id'=> $order->id]);
            
            if ($content) {
                foreach ($content as $item) {
                    OrderProduct::create(['order_id' =>$order->id,
                                        'product_id' =>$item->id,
                                        'quantity'   =>$item->qty,
                                        'price'      => $item->price,
                                        'sub_total'  =>$item->price * $item->qty,
                                        'status'     => 0
                                        ]);
                }
            }
        }
        Cart::destroy();
        $request->session()->forget('ship_id');
        Session::flash('success', 'Đặt hàng thành công');
        return redirect()->action('CartController@done');
    }

    public function done()
    {
        return view('site.cart.done');
    }


}
