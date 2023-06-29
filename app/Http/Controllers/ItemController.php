<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class ItemController extends Controller
{
    public function  index()
    {
        return inertia('Items/Index', [
            'items' => Item::orderBy('name')->get()
        ]);
    }

    public function search($searchKey)
    {
        return inertia('Items/Index', [
            'items' => Item::where('name', 'like', "%$searchKey%")->get()
        ]);
    }

    public function create()
    {
        return inertia('Items/Create');
    }

    public function store(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'qty' => 'required|numeric',
            'price' => 'required|numeric',
        ]);

        $fileName = null;

        //process image
        if ($request->pic) {
            $fileName = time() . '.' . $request->pic->extension();
            $request->pic->move(public_path('images/product_pics'), $fileName);
            $fields['pic'] = $fileName;
        }

        Item::create($fields);

        return redirect('/items')->with('message', 'Item was added successfully');
    }

    public function show(Item $item)
    {

        $user = auth()->user();
        return inertia('Items/Show', [
            'item' => $item,
            'user' => $user
        ]);
    }

    public function toggle(Item $item)
    {
        $item->enabled = !$item->enabled;
        $item->save();
        return back();
    }

    public function destroy(Item $item)
    {
        $item->delete();
        return redirect('/items')->with('message', 'Item deleted successfully');
    }
}
