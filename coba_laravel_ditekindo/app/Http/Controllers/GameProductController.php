<?php

namespace App\Http\Controllers;

use App\Http\Requests\GameProductRequest;
use App\Models\GameProduct;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GameProductController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $gameProducts = GameProduct::query()
            ->when($search, function ($query) use ($search) {
                return $query->where('name', 'LIKE', "%{$search}%");
            })
            ->paginate(12)
            ->withQueryString();

        $ownedGameIds = [];
        if (Auth::check()) {
            /** @var \App\Models\User $user */
            $user = Auth::user();
            $ownedGameIds = $user->orders()
                ->where('status', 'success')
                ->with('items')
                ->get()
                ->pluck('items.*.game_product_id')
                ->flatten()
                ->unique()
                ->toArray();
        }

        return view('gameproducts.index', compact('gameProducts', 'ownedGameIds'));
    }

    public function create()
    {
        return view('gameproducts.create');
    }

    public function store(GameProductRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }
        GameProduct::create($data);
        return to_route('gameproducts.index')->with('success', 'Game Product berhasil ditambahkan!');
    }

    public function edit(GameProduct $gameproduct)
    {

        return view('gameproducts.edit', ['gameProduct' => $gameproduct]);
    }

        public function update(GameProductRequest $request, GameProduct $gameproduct)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            if($gameproduct->image) {
                Storage::disk('public')->delete($gameproduct->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }
        $gameproduct->update($data);
        return to_route('gameproducts.index')->with('success', 'Game Product berhasil diperbarui!');
    }
    public function destroy(GameProduct $gameproduct)
    {
        if($gameproduct->image) {
            Storage::disk('public')->delete($gameproduct->image);
        }
        $gameproduct->delete();
        return to_route('gameproducts.index')->with('success', 'Game Product berhasil dihapus!');
    }
}
