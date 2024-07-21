<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Cart as ShoppingcartCart;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $carts = Cart::content();
        return view('cart.list', compact('carts'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $product = $request->all();
        Cart::add($product['id'], $product['name'], 1, $product['price']);
        $carts = Cart::content();
        return view('cart.list', compact('carts'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $rowId)
    {
       
        Cart::remove($rowId);
        return redirect('cart',)->with('success', 'Successfully deleted');
    }
}