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
            'image' => 'image|max:2048',
            'category_id' => 'required|exists:categories,id',
        ], [
            'category_id' => 'Please input Category exactly.',
            //image
            'image.image' => 'Format is not correct',
            //size
            'image.max' => 'Exceed capacity :max KB'
        ]);

        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        } else {
            $imageName = '';
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                if (file_exists(public_path('uploads'))) {
                    $folderName = date('Y-m');
                    $fileName = md5($image->getClientOriginalName() . time()) . '.' . $image->getClientOriginalExtension();
                    if (!file_exists(public_path('uploads/' . $folderName))) {
                        mkdir(public_path('uploads/' . $folderName), 0777);
                    }
                    $imageName = "$folderName/$fileName";
                    $image->move(public_path('uploads/' . $folderName), $fileName);
                }
            }
            $product = Product::create([
                'name' => $request->input('name'),
                'code' => mb_strtoupper($request->input('code'), 'UTF-8'),
                'content' => $request->input('content'),
                'regular_price' => $request->input('regular_price'),
                'sale_price' => $request->input('sale_price'),
                'original_price' => $request->input('original_price'),
                'quantity' => $request->input('quantity'),
                'image' => $imageName,
                'user_id' => auth()->id(),
                'category_id' => $request->input('category_id'),
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
