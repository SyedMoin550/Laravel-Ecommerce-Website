<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\User;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Termwind\Components\Raw;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

            $category = Categorie::with(['subCategories' => function ($query) {
                $query->with('subCategories');
            }])->where('parent_id', 0)->get();


            $products = Product::with('product_images')->with('category')->get();

            $flashSaleProducts = Product::with('product_images')->where('discount', '>', 0)->orderBy('discount', 'desc')->take(6)->get();
            // dd($flashSale);

            return view('index', compact('category', 'flashSaleProducts', 'products'));


    }



    public function productDetails($slug, $id)
    {

        $parentCategory = Product::with('getParentParentCategory')->where('id', $id)->get();
        $product = Product::find($id);

        $images = ProductImage::where('product_id', $id)->get();
        return view('user.productDetails', compact('parentCategory', 'product', 'images'));
    }

    public function productBycategory($categorySlug, $subCategorySlug = null)
    {
        $category = Categorie::where('category_slug', $categorySlug)->first();

        if ($category) {
            if($subCategorySlug == null){
                $subCate = Categorie::with(['subCategories' => function ($query) {
                    $query->with(['products' => function ($query) {
                        $query->with('product_images')->paginate();
                    }]);
                }])->where('id', $category->id)->first();

                $parentCategory = Categorie::with('parentCategory')->where('id', $subCate->parent_id)->first();

                return view('user.productByCategory', compact('subCate', 'parentCategory'));
            }
            else
            {
                $subCategory = Categorie::where('category_slug',$subCategorySlug)->first();
                if($subCategory){
                    $productBySubCategory = Categorie::with(['products' => function($query){
                        $query->with('product_images');
                    }])->where('id',$subCategory->id)->first();
                    // dd($productBySubCategory);

                    $parentCategoryWithSubParent = Categorie::with(['parentCategory' => function($query){
                        $query->with('parentCategory');
                    }])->where('id',$productBySubCategory->id)->first();

                    return view('user.productByCategory',compact('productBySubCategory','parentCategoryWithSubParent'));

                }
                else{
                    return redirect()->back();
                }
            }
        }
        else{
            return redirect()->back();

        }
    }



    public function showAddToCartPage(){
        return view('user.addtocart');
    }


    public function showCheckoutPage()
    {
        // $userInfo = User::find(Auth::user()->id);
        // return view('user.checkout',compact('userInfo'));
        return view('user.checkout');
    }



    public function showThankYouPage(){
        return view('user.thankYou');
    }


    public function showProfilePage(){
        return view('user.profile');
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
        return view('user.change-password');
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



    // Search
    public function search(Request $req){

        if($req->search != null){
            $searchResult = Product::where('product_name','LIKE',"%$req->search%")->with('product_images')->paginate(2);

            // if($searchResult){
                return view('search')->with('products',$searchResult);
            // }
            // else{
                // return view('search')->with('products',$searchResult);
                // dd("no");
            // }

        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
