<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Food;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $foods = Food::all();
        return view('admin.food.index', compact('foods'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.food.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'ten' => 'required|string|max:255',
            'mota' => 'nullable|string',
            'image' => 'nullable|url|max:255',
            'gia' => 'nullable|numeric'
        ]);

        \App\Models\Food::create([
            'ten' => $request->ten,
            'mota' => $request->mota,
            'image' => $request->image,
            'gia' => $request->gia
        ]);

        return redirect('/admin/food')->with('success', 'Thêm món ăn thành công!');
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
    public function edit($id)
    {
        $food = Food::findOrFail($id);
        return view('admin.food.edit', compact('food'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'ten' => 'required|string|max:255',
            'mota' => 'required|string',
            'image' => 'required|url|max:255',
        ]);

        $food = Food::findOrFail($id);
        $food->update([
            'ten' => $request->ten,
            'mota' => $request->mota,
            'image' => $request->image,
        ]);

        return redirect('/admin/food')->with('success', 'Cập nhật món ăn thành công!');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
