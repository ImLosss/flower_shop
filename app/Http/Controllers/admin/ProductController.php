<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['product'] = Product::with('category')->get();
        $data['category'] = Category::get();
        return view('admin.product', $data);
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
    public function store(ProductRequest $request)
    {
        try {
            if(!$request->file('image')) return redirect()->back()->with('alert', 'info')->with('message', 'The image field is required');
            // dd($request);
            Product::create([
                'category_id' => $request->categoryId,
                'name'        => $request->name,
                'src_img'     => $request->file('image')->store('product'),
                'description' => $request->description,
                'rate'        => $request->rate,
                'price'       => $request->price,
                'disc'        => $request->disc
            ]);

            return redirect()->back()->with('alert', 'success')->with('message', 'Data stored successfully');
        } catch (\Throwable $e) {
            return redirect()->back()->with('alert', 'error')->with('message', 'Failed to stored data');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return 'tess';
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
    public function update(ProductRequest $request, string $id)
    {
        try {
            $data = Product::findOrFail($id);
            
            $data->update([
                'category_id' => $request->categoryId,
                'name' => $request->name,
                'description' => $request->description,
                'rate' => $request->rate,
                'price' => $request->price,
                'disc' => $request->disc,
            ]);

            if ($request->file('image')) {
                if($request->old_img) {
                    Storage::delete($request->old_img);
                }
                $data->update([
                    'src_img' => $request->file('image')->store('product'),
                ]);
            }

            return redirect()->back()->with('alert', 'success')->with('message', 'Data updated successfully');
        } catch (\Throwable $e) {
            return redirect()->back()->with('alert', 'error')->with('message', 'Failed to update data');
        }
            
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $data = Product::findOrFail($id);
            Storage::delete($data->src_img);
            $data->delete();

            return redirect()->back()->with('alert', 'success')->with('message', 'Data deleted successfully');
        } catch (\Throwable $e) {
            return redirect()->back()->with('alert', 'error')->with('message', 'Failed to delete data');
        }
    }
}
