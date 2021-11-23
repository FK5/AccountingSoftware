<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Company;
use Illuminate\Http\Request;
use Auth;
use App\Models\Permission;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny',Product::class);
        $user = Auth::user();
        $user_id = $user->id;
        $role = Auth::user()->role;
        //IF SUPER ADMIN GET ALL COMPANIES
        if($user_id == 1){
            $products = Product::all();
        }else{
            //IF WEBMASTER GET PRODUCTS OWNED BY COMPMNY THAT WEBMASTER BELONGS TO
            if($role->id == $user->isWebMaster()){
                $companies = Company::where('user_id', $user_id)->get();
                $products = Product::whereIn('company_id',$companies)->get();
            }
            //IF OFFICER GET PRODUCTS OWNED BY COMPMNY THAT OFFICER ASSIGNED TO
            elseif($role->id == $user->isOfficer()){
                $companies = $user->companies;
                $products = Product::whereIn('company_id',$companies)->get();
            }
        }
        return view('products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create',Product::class);
        $user = Auth::user();
        $user_id = $user->id;
        $role = Auth::user()->role;
        
        $categories = Category::all();
        if($user_id == 1){
            $companies = Company::all();
        }else{
            if($role->id == $user->isWebMaster()){
                $companies = Company::where('user_id', $user_id)->get();
            }
            if($role->id == $user->isOfficer()){
                $companies = $user->companies;
            }
        }
        return view('products.create',compact('categories','companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create',Product::class);
        $rules = [
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            'sku' => 'required|max:255',
            'category_id' => 'required|not in:Open this select menu',
            'company_id' => 'required|not in:Open this select menu',
            'sales_price' => 'required|numeric',
            'cost' => 'numeric|nullable',
        ];

        $this->validate($request, $rules);

        $data = $request->all();
        Product::create($data);
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $this->authorize('update',$product);
        $user = Auth::user();
        $user_id = $user->id;
        $role = Auth::user()->role;

        $categories = Category::all();
        if($user_id == 1){
            $companies = Company::all();
        }else{
            if($role->id == $user->isWebMaster()){
                $companies = Company::where('user_id', $user_id)->get();
            }
            if($role->id == $user->isOfficer()){
                $companies = $user->companies;
            }
        }
        return view('products.edit',compact('product','categories','companies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $this->authorize('update',$product);
        $rules = [
            'title' => 'max:255',
            'description' => 'max:255',
            'sku' => 'max:255',
            'category_id' => 'max:255',
            'company_id' => 'max:255',
            'sales_price' => 'numeric',
            'cost' => 'numeric',
        ];

        $this->validate($request, $rules);
        $data = $request->all();
        $product->update($data);
        $product->save();
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $this->authorize('delete',$product);
        $product->delete();
        return redirect()->route('products.index');
    }

    public function delete(Product $product)
    {
        $this->authorize('delete',$product);
        return view('products.delete', ['product'=>$product]);
    }
}
