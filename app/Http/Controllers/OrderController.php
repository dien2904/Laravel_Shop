<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;

class OrderController extends Controller
{
    // public function productview(Request $request)
    // {
    //     $orders = DB::table('orders')->select('id', 'name', 'image', 'price');
    //     $results  = ($orders->get());
    //     return view('product', ['orders' => $results]);
    // }

    // public function productdetail(Request $request)
    // {
    //     $id = $request->id;
    //     $orders = DB::table('orders')->select('id', 'name', 'image', 'price')->where('id', '=', $id);
    //     $results  = ($orders->get());
    //     return view('product', ['orders' => $results]);
    // }
    // public function ordersearch(Request $request)
    // {
    //     $validated = $request->validate([
    //         'keyword' => 'required|string|max:255',
    //     ]);

    //     // Perform the query using Eloquent
    //     $orders = DB::table('orders')->select('id', 'name', 'image', 'price')
    //         ->where('name', 'like', '%' . $validated['keyword'] . '%')
    //         ->get();

    //     // Pass the orders to the view
    //     return view('product', ['orders' => $orders]);
    // }

    public function index()
    {
        $orders = Order::orderBy('id', 'DESC')->paginate(12);
        // $results  = ($categories->get());
        
        $template = 'Order.list';

        return view('dashboard.layout', compact(
            'template',
            'orders'
        ));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $categories = Category::all();
        $template = 'product.create';

        return view('dashboard.layout', compact(
            'template',
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
            $image->move(public_path('uploads/orders'), $imageName); // Move the image to the uploads/orders directory
            $input['image'] = 'uploads/orders/' . $imageName; // Set the image path in the input array
        }

        $product = Product::create($input);

        return back()->with('success', 'Create product successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Lấy đơn hàng cùng với các chi tiết đơn hàng từ bảng order_items
        $order = Order::with('orderItems')->findOrFail($id);

        // Kiểm tra nếu orderItems không tồn tại thì khởi tạo một mảng trống
        if (!$order->relationLoaded('orderItems') || is_null($order->orderItems)) {
            $order->setRelation('orderItems', collect());
        }

        $template = 'order.detail';
        return view('dashboard.layout', compact('template','order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        

        $result = Order::where('id', $id)->first();
        $template = 'order.edit';
       
        return view('dashboard.layout', compact(
            'template',
            'result'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the request
        $validated = $request->validate([
            'user_id' => 'nullable',
            'created_at' => 'nullable|date',
            'order_status' => 'nullable|string',
        ]);

        // Prepare the data for update using validated input with default values if keys are not set
        $updated = [
            'user_id' => $validated['user_id'] ?? null,
            'created_at' => $validated['created_at'] ?? null,
            'order_status' => $validated['order_status'] ?? null,
        ];

        // Filter out null values to avoid updating columns with null where not allowed
        $updated = array_filter($updated, function ($value) {
            return !is_null($value);
        });

        // Update the order with the validated data
        Order::where('id', $id)->update($updated);

        // Redirect back with success message
        return redirect()->route('order.index')->with('success', 'Cập nhật thành công');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table('orders')->where('id', $id)->delete();
        return redirect()->route('order.index')->with('success', 'delete successfully');
    }
}
