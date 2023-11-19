<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class ProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $user_id = $request->user()->id;
        $user = User::find($user_id);
        return view('products.index')->with('products', $user->products);
    }
    

    public function create()
    {
        return view('products.form')->
            with('action_name', 'post')->
            with('action_route',
                'App\Http\Controllers\ProductsController@store'
            );
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Example image validation rules.
        ]);

        $product = new Product();
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->description = $request->input('description');
        $product->user_id = auth()->user()->id;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $this->storeImage($image);
            $product->image_path = $imagePath;
        }

        $product->save();

        return redirect('/products')->with('success', 'Product Created');
    }

    public function edit($id)
    {
        $product = Product::find($id);
    
        if (!$product) {
            return redirect('/products')->with('error', 'Product Not Found');
        }
    
        if (auth()->user()->id !== $product->user_id) {
            return redirect('/products')->with('error', 'Unauthorized');
        }
    
        return view('products.form')
            ->with('action_name', 'put')
            ->with('action_route', ['App\Http\Controllers\ProductsController@update', $product->id])
            ->with('product', $product); 
    }
    

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $product = Product::find($id);

        if (!$product) {
            return redirect('/products')->with('error', 'Product Not Found');
        }

        if (auth()->user()->id !== $product->user_id) {
            return redirect('/products')->with('error', 'Unauthorized');
        }

        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->description = $request->input('description');

        if ($request->hasFile('image')) {
            $newImagePath = $this->storeImage($request->file('image'));

            if ($product->image_path) {
                Storage::delete($product->image_path);
            }

            $product->image_path = $newImagePath;
        }

        $product->save();

        return redirect('/products')->with('success', 'Product Updated');
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return redirect('/products')->with('error', 'Product Not Found');
        }

        if (auth()->user()->id !== $product->user_id) {
            return redirect('/products')->with('error', 'Unauthorized');
        }

        if ($product->image_path) {
            Storage::delete($product->image_path);
        }

        $product->delete();

        return redirect('/products')->with('success', 'Product Deleted');
    }

    private function storeImage(UploadedFile $image)
    {
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $imagePath = $image->storeAs('images', $imageName, 'public');

        return $imagePath;
    }
}
