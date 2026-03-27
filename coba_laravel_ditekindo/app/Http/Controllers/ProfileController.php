<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Order;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $orders = Order::with('items.gameProduct')
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        $myGames = $orders->flatMap(function ($order) {
            return $order->items->map(function ($item) {
                return $item->gameProduct;
            });
        })->unique('id');

        return view('profile.index', compact('user', 'orders', 'myGames'));
    }

    public function update(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6|confirmed',
            'pin' => 'nullable|digits:6',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        if ($request->filled('pin')) {
            $user->pin = Hash::make($request->pin);
        }

        $user->save();

        return back()->with('success', 'Profil dan keamanan berhasil diperbarui!');
    }
}
