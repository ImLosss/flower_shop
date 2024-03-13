<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Category::with('product')->get();
        // dd($data);
        return view('admin.category', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return ('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Simpan data yang dikirimkan melalui form ke dalam database
            Category::create([
                'name' => $request->categoryName,
                // Tambahkan kolom lainnya sesuai kebutuhan
            ]);

            return redirect()->back()->with('alert', 'success')->with('message', 'Data stored succesfully');
        } catch (\Throwable $e) {
            return redirect()->back()->with('alert', 'error')->with('message', 'Failed to store data');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return ('show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return ('edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return ('update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $data = Category::findOrFail($id);
            $data->delete();
            return redirect()->back()->with('alert', 'success')->with('message', 'Data deleted successfully');
        } catch (\Throwable $e) {
            return redirect()->back()->with('alert', 'error')->with('message', 'Failed to delete data');
        }
    }
}
