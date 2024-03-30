<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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

    public function getProduct() {
        $data = Product::with('category');
        return DataTables::of($data)
        ->addColumn('select_box', function ($data) {
            $html = '<div class="form-check">
                        <input class="form-check-input document-checkbox" type="checkbox" name="documentSelect[]" value="'. $data->id .'" id="flexCheckDefault">
                    </div>';
            return $html;
        })->addColumn('gambar', function($data) {
            return '<img src="'. asset('storage/' . $data->src_img) .'" width="50%">';
         })->addColumn('category', function($data) {
            return $data->category->name;
         })->addColumn('desc', function($data) {
            return $data->description;
         })->addColumn('tanggal', function($data) {
            return $data->updated_at;
         })->addColumn('action', function($data) {
            return '<div class="card bg-success border-radius-md" style="display: inline-block;" onclick="getdata(this)" data-toggle="modal" data-target="#myModal" data-id="'. $data->id .'" data-oldimg="'. $data->src_img .'" data-categoryid="'. $data->category->id .'" data-name="'. $data->name .'" data-description="'. $data->description .'" data-rate="'. $data->rate .'" data-price="'. $data->price .'" data-disc="'. $data->disc .'"><i class="fa fa-edit mx-1 text-white"></i></div>
            <div class="card bg-danger border-radius-md" style="display: inline-block;" onclick="submit('. $data->id .')"><i class="fa fa-trash mx-1 text-white"></i></div>
            <!-- form untuk delete -->
            <form id="form_'. $data->id .'" action="'. route('admin.product.destroy', $data->id) .'" method="post">
            ' . csrf_field() . '
            ' . method_field('DELETE') . '
            </form>';
         })
         ->rawColumns(['gambar', 'action', 'select_box'])
         ->toJson();
    }
}
