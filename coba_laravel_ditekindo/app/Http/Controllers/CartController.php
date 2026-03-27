<?php

namespace App\Http\Controllers;

use App\Models\GameProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['harga'] * $item['quantity'];
        }

        return view('cart.index', compact('cart', 'total'));
    }

    public function add(GameProduct $gameproduct)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        /** @var \App\Models\User $user */
        $user = Auth::user();

        $isOwned = $user->orders()->where('status', 'success')
            ->whereHas('items', function ($q) use ($gameproduct) {
                $q->where('game_product_id', $gameproduct->id);
            })->exists();

        if ($isOwned) {
            return redirect()->back()->with('error', 'Game ini sudah ada di koleksi Anda!');
        }

        if ($gameproduct->stok <= 0) {
            return redirect()->back()->with('error', 'Maaf, stok game ini sudah habis.');
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$gameproduct->id])) {
            return redirect()->back()->with('error', 'Game ini sudah ada di keranjang belanja kamu!');
        }


        $cart[$gameproduct->id] = [
            "name" => $gameproduct->name,
            "quantity" => 1,
            "harga" => $gameproduct->harga,
            "category" => $gameproduct->category,
            "image" => $gameproduct->image
        ];

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Game berhasil ditambah ke keranjang!');
    }

    public function remove(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            return redirect()->back()->with('success', 'Produk dihapus dari keranjang.');
        }
    }
    public function checkout(Request $request)
    {
        $user = Auth::user();;
        $cart = session()->get('cart');

        if (!Hash::check($request->pin, $user->pin)) {
            return back()->with('error', 'PIN yang Anda masukkan salah!');
        }

        if (!$cart) {
            return back()->with('error', 'Keranjang belanja kosong.');
        }

        DB::beginTransaction();
        try {
            $total = 0;
            foreach ($cart as $details) {
                $total += $details['harga'] * $details['quantity'];
            }

            $order = \App\Models\Order::create([
                'user_id' => $user->id,
                'total_price' => $total,
                'status' => 'success',
            ]);

            foreach ($cart as $id => $details) {
                $product = GameProduct::find($id);

                if ($product->stok < $details['quantity']) {
                    throw new \Exception("Stok game {$product->name} tidak mencukupi!");
                }

                \App\Models\OrderItem::create([
                    'order_id' => $order->id,
                    'game_product_id' => $id,
                    'quantity' => $details['quantity'],
                    'price' => $details['harga'],
                ]);

                $product->decrement('stok', $details['quantity']);
            }

            DB::commit();
            session()->forget('cart');

            return to_route('gameproducts.index')->with('success', 'Pembayaran Berhasil! Game telah masuk ke koleksi Anda.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', $e->getMessage());
        }
    }
}
