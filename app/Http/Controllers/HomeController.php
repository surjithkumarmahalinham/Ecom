<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use Redirect;
use Auth;
use Session;

class HomeController extends Controller
{
    public function login()
    {
    	return view('login');
    }
    public function register()
    {
    	return view('register');
    }
    public function registerpost(Request $request)
    {
    	$password = Hash::make($request->password);
        $request->merge(['password'=>$password]);
        $user = User::create($request->all());

        return redirect::route('login');
    }
    public function logincheck(Request $request)
    {
    	$this->validate($request, [
        'email' => 'required|email',
        'password' => 'required',
        ]);
    if (\Auth::attempt([
        'email' => $request->email,
        'password' => $request->password])
    ){
        return redirect('/home');
    }
    return redirect('/login')->with('error', 'Invalid Email or Password');

        return redirect::route('login');
    }
    public function logout(Request $request)
{
    if(\Auth::check())
    {
        \Auth::logout();
        $request->session()->invalidate();
    }
    return  redirect('/login');
}
    public function home()
    {
        $product=Product::all();
        return view('home',compact('product'));
    }
    public function checkout(Request $request,$id)
    {
        $product=Product::where('id','=',$request->id)->get();
        return view('checkout',compact('product'));
    }
    public function cart()
    {
        return view('cart');
    }
    public function orderstore(Request $request)
    {
        $user=Auth::user();
        $cart = Session::get('cart');

        foreach ($cart as $data) {
            $OrderPro = new Order;
            $OrderPro->product_id = $data['id'];
            $OrderPro->user_id = $user->id;
            $OrderPro->total_price = $request->total_price;;
            $OrderPro->method = $request->method;
            $OrderPro->save();
        }

        Session::forget('cart');
        
    return redirect::route('home');
    }
    public function myorder(Request $request)
    {
        $user=Auth::user();
        $orders=Order::leftJoin('product','order.product_id','=','product.id')->select('product.*','order.*')->where('user_id','=',$user->id)->get();
        return view('myorders',compact('orders'));
    }
    public function addToCart($id)
    {
        $product = Product::find($id);

        if(!$product) {

            abort(404);

        }

        $cart = session()->get('cart');

        if(!$cart) {

            $cart = [
                $id => [
                    "product_name" => $product->product_name,
                    "id" => $product->id,
                    "quantity" => 1,
                    "price" => $product->price,
                    "image" => $product->image
                ]
            ];

            session()->put('cart', $cart);

            $htmlCart = view('header')->render();

            return response()->json(['msg' => 'Product added to cart successfully!', 'data' => $htmlCart]);
        }
if(isset($cart[$id])) {

            $cart[$id]['quantity']++;

            session()->put('cart', $cart);

            $htmlCart = view('header')->render();

            return response()->json(['msg' => 'Product added to cart successfully!', 'data' => $htmlCart]);

        }

        $cart[$id] = [
            "product_name" => $product->product_name,
            "id" => $product->id,
            "quantity" => 1,
            "price" => $product->price,
            "image" => $product->image
        ];

        session()->put('cart', $cart);

        $htmlCart = view('header')->render();

        return response()->json(['msg' => 'Product added to cart successfully!', 'data' => $htmlCart]);

    }
    public function update(Request $request)
    {
        if($request->id and $request->quantity)
        {
            $cart = session()->get('cart');

            $cart[$request->id]["quantity"] = $request->quantity;

            session()->put('cart', $cart);

            $subTotal = $cart[$request->id]['quantity'] * $cart[$request->id]['price'];

            $total = $this->getCartTotal();

            $htmlCart = view('header')->render();

            return response()->json(['msg' => 'Cart updated successfully', 'data' => $htmlCart, 'total' => $total, 'subTotal' => $subTotal]);

        }
    }

    public function remove(Request $request)
    {
        if($request->id) {

            $cart = session()->get('cart');

            if(isset($cart[$request->id])) {

                unset($cart[$request->id]);

                session()->put('cart', $cart);
            }

            $total = $this->getCartTotal();

            $htmlCart = view('header')->render();

            return response()->json(['msg' => 'Product removed successfully', 'data' => $htmlCart, 'total' => $total]);

        }
    }
    private function getCartTotal()
    {
        $total = 0;

        $cart = session()->get('cart');

        foreach($cart as $id => $details) {
            $total += $details['price'] * $details['quantity'];
        }

        return number_format($total, 2);
    }
}
