<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Product;

class ProductController extends Controller
{
    /**
     * productController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data['products'] = Product::with('user')->orderBy('id', 'desc')->paginate(20);
        return view('admin.products.index', $data);
    }

    public function create()
    {
        $data['categories'] = Product::orderBy('name', 'asc')->get();
        return view('admin.products.create', $data);
    }

    public function store(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'name' => 'required',
            'code' => 'required|unique:products,code',
            'content' => 'required',
            'regular_price' => 'required|numeric|min:0',
            'sale_price' => 'required|numeric|min:0',
            'original_price' => 'required|numeric|min:0',
            'quantity' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        } else {
            $order = 0;
            if ($request->input('order')) {
                $order = $request->input('order');
            }
            $product = Product::create([
                'name' => $request->input('name'),
                'slug' => str_slug($request->input('name')),
                'parent' => $request->input('parent'),
                'order' => $order
            ]);
            return redirect()->route('admin.product.index')->with('message', " Add $product->name successful.");
        }
    }

    public function show($id)
    {
        $data['product'] = Product::find($id);
        dd($data['product']->tags);
        $data['products'] = Product::where([
            ['parent', '=', 0],
            ['id', '<>', 1],
        ])->get();
        if ($data['product'] !== null) {
            return view('admin.products.show', $data);
        }
        return redirect()->route('admin.product.index')->with('error', 'Can not find this product.');
    }

    public function update(Request $request, $id)
    {
        $valid = Validator::make($request->all(), [
            'name' => 'required|unique:products,name,' . $id,
            'parent' => 'required'
        ]);
        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        } else {
            $product = Product::find($id);
            if ($product !== null) {
                $order = 0;
                if ($request->input('order')) {
                    $order = $request->input('order');
                }
                $product->name = $request->input('name');
                $product->parent = $request->input('parent');
                $product->order = $order;
                $product->save();
                return redirect()->route('admin.product.index')->with('message', "Edit $product->name successful.");
            }

            return redirect()->route('admin.product.index')->with('error', "Can not find this product.");
        }
    }

    public function delete($id)
    {
        $product = Product::find($id);
        if ($product !== null) {
            $product->delete();
            return redirect()->route('admin.product.index')->with('message', "Delete $product->name successful.");
        }
        return redirect()->route('admin.product.index')->with('error', 'Can not find this product.');
    }
}
