<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        $product=product::oldest()->get();
        return response()->json([
            'products'=>$product
        ]);
    }


    public function store(Request $request)
    {
        $user=$this->validate($request,[
            'name'=>'required',
            'detail'=>'required',
            'price'=>'required'
        ]);
        $product=product::create($user);
        return response()->json([
            'msg'=>$product
        ]);
         }

}
