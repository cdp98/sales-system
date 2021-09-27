<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Sale;

class SalesController extends Controller
{
    
    private $product;
    private $sale;

    public function __construct(
        Product $product,
        Sale $sale
    )
    {
        $this->product = $product;
        $this->sale = $sale;
    }

    public function index()
    {
        $sales = $this->sale->all();
        
        return view('sales');
    }   

    public function products()
    {
        $products = $this->product->all();
        
        return view('new-sale', ['products' => $products]);
    }

    public function newSale()
    {

    }
}
