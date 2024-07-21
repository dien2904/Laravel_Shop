<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    // public function productview(Request $request)
    // {
    //     $products = DB::table('products')->select('id', 'name', 'image', 'price');
    //     $results  = ($products->get());
    //     return view('product', ['products' => $results]);
    // }

    // public function productdetail(Request $request)
    // {
    //     $id = $request->id;
    //     $products = DB::table('products')->select('id', 'name', 'image', 'price')->where('id', '=', $id);
    //     $results  = ($products->get());
    //     return view('product', ['products' => $results]);
    // }
    // public function productSearch(Request $request)
    // {
    //     $validated = $request->validate([
    //         'keyword' => 'required|string|max:255',
    //     ]);

    //     // Perform the query using Eloquent
    //     $products = DB::table('products')->select('id', 'name', 'image', 'price')
    //         ->where('name', 'like', '%' . $validated['keyword'] . '%')
    //         ->get();

    //     // Pass the products to the view
    //     return view('product', ['products' => $products]);
    // }

    public function index()
    {
        $products = Product::orderBy('id', 'DESC')->paginate(12);
        // $results  = ($categories->get());
        // var_dump($products);
        $template = 'product.list';

        return view('dashboard.layout',compact(
            'template' ,
            'products'
        ));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        $categories = Category::all();
        $template = 'product.create';

        return view('dashboard.layout',compact(
            'template' ,
            'categories'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|integer|min:0',
            'categories' => 'nullable|array|exists:category',
            'image' => [
                'required',
                'image',
                'mimes:jpeg,png,jpg,gif',
                'max:2048',
            ],
        ]);

        // if ($request->hasFile('image')) {
        //     $imageName = time() . '.' . $request->image->extension();
        //     $request->image->move(public_path('images'), $imageName);
        // } else {
        //     return back()->withErrors(['image' => 'Image upload failed. Please try again.']);
        // }

        // $product = new Product();
        // $product->name = $request->input('name');
        // $product->description = $request->input('description');
        // $product->price = $request->input('price');
        // $product->category_id = (int)$request->input('category_id');
        // $product->image = $imageName;
        // $product->save();

        $input = $request->all();
        
        if ($request->hasFile('image')) {
            $image = $request->file('image'); // Get the uploaded file
            $imageName = time() . '_' . $image->getClientOriginalName(); // Create a unique name for the image
            $image->move(public_path('uploads/products'), $imageName); // Move the image to the uploads/products directory
            $input['image'] = 'uploads/products/' . $imageName; // Set the image path in the input array
        }

        $product = Product::create($input);

        return back()->with('success', 'Create product successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        echo "index show call ";
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // var_dump($id);
        
        $result = Product::where('id', $id)->first();
        $template = 'product.edit';
        // var_dump($results[0]->name);
        return view('dashboard.layout',compact(
            'template' ,
            'result'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated =  $request->validate([
            'name' => 'required|max:255',
            'price' => 'required' ,
            'image' => 'max:100' ,
            'description' => 'required',
        ]);
        var_dump($request->all());

        $updated = [
            'name' => $request->get('name'),
            'price' => $request->get('price'),
            'image' => $request->get('image'),
            'description' => $request->get('description')
        ];
        $blog = Product::where('id', $id)->update($updated);
        return redirect()->route('product.index')->with('success', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table('products')->where('id', $id)->delete();
        return redirect()->route('products.index')->with('success', 'delete successfully');
    }
}
