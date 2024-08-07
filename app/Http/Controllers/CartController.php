<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function list()
    {
        $cart= session('cart');

        $totalAmount=0;
        if(is_array('cart')){
            foreach ($cart as $item) {
                $totalAmount+=$item['quantity']* ($item['price_sale'] ?: $item['price_regular'] );
            }
        }
       
        return view('cart-list', compact('totalAmount'));
    }
    public function add()
    {
        $product = Product::query()->findOrFail(\request('product_id'));
        $productVariant = ProductVariant::query()
            ->with(['product_color', 'product_size'])
            ->where([
                'product_id' => \request('product_id'),
                'product_size_id' => \request('product_size_id'),
                'product_color_id' => \request('product_color_id'),
            ])
            ->firstOrFail();
        //    dd($productVariant);


        if (!isset(session('cart')[$productVariant->id])) {
            $data = $product->toArray()
                + $productVariant->toArray()
                + ['quantity' => \request('quantity')];
            session()->put('cart.' . $productVariant->id, $data);
        } else {


            $data = session('cart.')[$productVariant->id];
            $data['quantity'] = \request('quantity');

            session()->put('cart.' . $productVariant->id, $data);
        }
        // bất kì thao tác nào cảu giỏ hàng phải lưu vào database

        //mua hàng thành côgn rồi cần phải xoá dữ liệu của giỏ hàng đó  trong data base
        return redirect()->route('cart.list');
    }
}
