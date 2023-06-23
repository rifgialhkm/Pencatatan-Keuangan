<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $data = Category::paginate(10);

        return view('category.index', compact('data'));
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'type' => 'required'
        ]);

        Category::create($validate);

        return redirect()->route('category.index')->with('success', 'Data berhasil disimpan!');
    }

    public function edit($id)
    {
        $data = Category::findOrFail($id);

        return view('category.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'name' => 'required',
            'type' => 'required'
        ]);

        Category::findOrFail($id)->update($validate);

        return redirect()->route('category.index')->with('success', 'Data berhasil diubah!');
    }

    public function destroy($id)
    {
        Category::findOrFail($id)->delete();

        return back()->with('success', 'Data berhasil dihapus!');
    }
}
