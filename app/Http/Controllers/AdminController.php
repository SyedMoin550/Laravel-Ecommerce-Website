<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Product;
use Carbon\Carbon;
use App\Models\ProductImage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\VarDumper\Caster\RedisCaster;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function showAddCategoryPage()
    {

        $category = Categorie::with(['subCategories' => function ($query) {
            $query->with('subCategories');
        }])->where('parent_id', 0)->get();

        return view('admin.addCategory', compact('category'));
    }

    public function addCategory(Request $request)
    {

        $request->validate([
            'allCate' => 'required',
            'categoryName' => 'required',
            'categorySlug' => 'required'
        ], [
            'allCate.required' => "Please Select Category",
            'categoryName.required' => 'Please Enter Category Name',
            'categorySlug.required' => 'Please Enter Category Slug'
        ]);

        $category = new Categorie;
        $category->parent_id = $request->allCate;
        $category->category_name = $request->categoryName;
        $category->category_slug = Str::slug($request->categorySlug);

        if ($category->save()) {
            session()->flash('message', [
                'type' => 'success',
                'msg' => 'Category Added Successfully!'
            ]);
        } else {
            session()->flash('message', [
                'type' => 'success',
                'msg' => 'Category Added Successfully!'
            ]);
        }

        return redirect()->back();
    }

    public function allCategory()
    {
        $parentCategory = Categorie::with('parentCategory')->paginate(25);
        // dd($parentCategory);
        return view('admin.allCategory', compact('parentCategory'));
    }

    public function deleteCategory($id)
    {
        $category = Categorie::find($id);

        if ($category->delete()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }



    // Products
    public function showAddProductPage()
    {
        $category = Categorie::with(['subCategories' => function ($query) {
            $query->with('subCategories');
        }])->where('parent_id', 0)->get();

        return view('admin.addProduct', compact('category'));
    }

    // Add Product
    public function addProduct(Request $req)
    {
        $req->validate([
            'allCate' => 'required',
            'name' => 'required',
            'images' => 'required',
            'images.*' => 'image|mimes:png,jpg,jpeg,gif,webp,svg|max:5196',
            'slug' => 'required',
            'product_color' => 'required',
            'desc' => 'required',
            'or_price' => 'required|numeric',
            'sl_price' => 'required|numeric',
            'quantity' => 'required|integer',
            'details' => 'required',

        ], [
            'allCate.required' => 'Please Select Category',
            'name.required' => 'Product name required',
            // 'images.required' => 'Product image is required',
            'images.*.image' => 'The file must be an image',
            'images.*.mimes' => 'The image must be a file of type: png, jpg, jpeg, gif, svg.',
            'images.*.max' => 'The image must not be greater than 5MB.',
            'slug.required' => 'Product slug required',
            'desc.required' => 'Product description is required',
            'or_price.required' => 'Original price is required',
            'or_price.numeric' => 'Original price must be numeric value',
            'sl_price.numeric' => 'Salling price must be numeric value',
            'quantity.required' => 'Quantity is required',
            'details.required' => 'Product detail is required',
        ]);

        $product_id = rand(9999, 0000);
        $product = new Product();
        $product->id = $product_id;
        $product->category_id = $req->allCate;
        $product->product_name = $req->name;
        $product->slug = Str::slug($req->slug);
        $product->desc = $req->desc;
        $product->product_color = $req->product_color;
        $product->brand = $req->brand;
        $product->details = $req->details;
        $product->original_price = $req->or_price;
        $product->salling_price = $req->sl_price;
        $product->discount = $req->discount;
        $product->quantity = $req->quantity;
        $product->date = date('d/m/Y');

        $product->save();

        $imageNames = [];
        foreach ($req->file('images') as $key => $value) {

            $imageName = time() . '.' . $value->getClientOriginalName();
            $value->move('images/product_images', $imageName);

            $product_image = new ProductImage();
            $product_image->product_id = $product_id;
            $product_image->image = "images/product_images/" . $imageName;
            $product_image->save();

            $imageNames[] = "images/product_images/" . $imageName;
        }

        session()->flash('message', 'Product Added Successfully');
        return redirect()->back()->with('images', $imageNames);
    }

    // All Product
    public function allProduct()
    {

        $products = Product::with('category')->paginate(25);

        return view('admin.allProducts', compact('products'));
    }


    // Edit Product Page
    public function showEditProduct($id)
    {
        $category = Categorie::with(['subCategories' => function ($query) {
            $query->with('subCategories');
        }])->where('parent_id', 0)->get();

        $product = Product::find($id);

        $images = ProductImage::where('product_id', $id)->get();
        return view('admin.editProduct', compact('category', 'product', 'images'));
    }

    // Edit Product
    public function editProduct(Request $req, $id)
    {
        // dd($id);
        $req->validate([
            'allCate' => 'required',
            'name' => 'required',
            'slug' => 'required',
            'product_color' => 'required',
            'desc' => 'required',
            'or_price' => 'required|numeric',
            'sl_price' => 'required|numeric',
            'quantity' => 'required|integer',
            'details' => 'required',

        ], [
            'allCate.required' => 'Please Select Category',
            'name.required' => 'Product name required',
            'slug.required' => 'Product slug required',
            'desc.required' => 'Product description is required',
            'or_price.required' => 'Original price is required',
            'or_price.numeric' => 'Original price must be numeric value',
            'sl_price.numeric' => 'Salling price must be numeric value',
            'quantity.required' => 'Quantity is required',
            'details.required' => 'Product detail is required',
        ]);
        $product = Product::find($id);

        if ($req->hasFile('images')) {
            $req->validate([
                'images' => 'required',
                'images.*' => 'image|mimes:png,jpg,jpeg,gif,webp,svg|max:5196',
            ], [
                'images.*.image' => 'The file must be an image',
                'images.*.mimes' => 'The image must be a file of type: png, jpg, jpeg,webp, gif, svg.',
                'images.*.max' => 'The image must not be greater than 5MB.',
            ]);

            $product_images = ProductImage::where('product_id', $id)->get();
            foreach ($product_images as $product_image) {
                if (file_exists($product_image['image'])) {
                    unlink($product_image['image']);
                }
                // Delete the image record from the database
                $product_image->delete();
            }

            // Add Updated Images Path
            foreach ($req->file('images') as $key => $value) {
                $imageName = time().'.'.$value->getClientOriginalName();
                $value->move('images/product_images/',$imageName);

                $product_images = new ProductImage();
                $product_images->product_id = $id;
                $product_images->image = "images/product_images/".$imageName;
                $product_images->save();
            }

        }

        // Update Other Fields
        $product->id = $id;
        $product->category_id = $req->allCate;
        $product->product_name = $req->name;
        $product->slug = Str::slug($req->slug);
        $product->desc = $req->desc;
        $product->product_color = $req->product_color;
        $product->brand = $req->brand;
        $product->details = $req->details;
        $product->original_price = $req->or_price;
        $product->salling_price = $req->sl_price;
        $product->discount = $req->discount;
        $product->quantity = $req->quantity;
        $product->date = date('d/m/Y');
        if($product->save()){
            return redirect()->back()->with('message','Product Details Updated');
        }
        else{
            return redirect()->back()->with('message','Product Details Not Updated');
        }

    }

    // Delete Product
    public function deleteProduct($id)
    {
        $product = Product::find($id);

        if ($product) {
            $images = ProductImage::where('product_id', $id)->get();

            foreach ($images as $value) {
                if (file_exists($value['image'])) {
                    unlink($value['image']);
                }
            }
            if ($product->delete()) {
                return response()->json(['success' => true]);
            } else {
                return response()->json(['success' => false]);
            }
        } else {
            return redirect('/admin/product/all');
        }
    }


    // Profile
    public function showProfilePage(){
        return view('admin.profile');
    }


    public function profileUpdate(Request $req){
        $req->validate([
            'name' => 'required',
            'email' => 'required|email',
            'number' => 'required'
        ]);

        $user = User::find(Auth::user()->id);

        $user->name = $req->name;
        $user->email = $req->email;
        $user->user_number = $req->number;

        $user->save();

        return redirect()->back()->with('response','Profile Updated');
    }



    public function showChangePassPage(){
        return view('admin.change-password');
    }


    public function changePassPage(Request $req){

        $req->validate([
            'oldPass' => 'required',
            'pass' => 'required',
            'cpass' => 'required|same:pass'
        ],[
            'oldPass.required' => 'Old password is required',
            'pass.required' => 'New password is required',
            'cpass.required' => 'Confirm password is required',
            'cpass.same' => 'Both password must match',
        ]);


        if(Hash::check($req->oldPass, Auth::user()->password)){
            $user = User::find(Auth::user()->id);

            $user->password = Hash::make($req->pass);
            $user->save();
            return redirect()->back()->with('response','Password Changed Successfully!');
        }
        
        else
        {
            return redirect()->back()->with('response','Old password does not match');
        }

    }
}
