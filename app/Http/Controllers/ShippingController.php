<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ShippingRequest;
use Cart;
use redirect;
use App\Models\Shipping;
use DB;
use Session;
class ShippingController extends Controller
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

    public function form_create(Request $request)
    {
        $content=Cart::content();
        $total = Cart::total();
        $countCart = Cart::count();
        $shipping = new Shipping;
        if ($request->session()->has('ship_id')) {
            $ship_id = $request->session()->get('ship_id');
            $shipping = Shipping::findOrFail($ship_id);
        }

        return view('site.cart.shipping', compact('content','total','countCart','shipping'));
    }

    public function store(ShippingRequest $request)
    {
        $data = $request->all();
        DB::beginTransaction();
        try {
            if ($request->session()->has('ship_id')) {
                $id = $request->session()->get('ship_id');
                $shipping = Shipping::find($id)->update($data);
                }else {
                    $shipping = Shipping::create($data);
                    $request->session()->put('ship_id', $shipping->id);
                }
             DB::commit();
        } catch(\Exception $e) {
            DB::rollback();
            Session::flash('error', 'Rất tiếc, có lỗi xảy ra, vui lòng thử lại');
            return redirect()->action('ShippingController@form_create');
        }
        Session::flash('success', 'Lưu thành công');
        return redirect()->action('ShippingController@form_create');
 
    }
}