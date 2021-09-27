<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\SaleProduct;
use App\Models\Sale;
use DateTime;
use Carbon\Carbon;

class SalesController extends Controller
{
    
    private $product;
    private $saleProduct;
    private $sale;

    public function __construct(
        Product $product,
        SaleProduct $saleProduct,
        Sale $sale
    )
    {
        $this->product = $product;
        $this->sale = $sale;
        $this->saleProduct = $saleProduct;
    }

    public function index()
    {
        $sales = $this->sale->all();
        
        return view('sales', ['sales' => $sales]);
    }   

    public function products()
    {
        $products = $this->product->all();
        
        return view('new-sale', ['products' => $products]);
    }

    public function newSale(Request $request)
    {
        $products = json_decode($request->products);
        $address = $request->address_delivery;

        $date = Carbon::createFromFormat('d/m/Y', $request->sale_date)->format('Y-m-d');

        $sale = $this->sale->create([
            'address_delivery' => $address,
            'total_price' => $request->total,
            'sale_date' => $date
        ]);

        foreach ($products as $key => $product) {
            $saleProduct = $this->saleProduct->create([
                'sale_id' => $sale->id,
                'product_id' => $product
            ]);
        }

        return redirect()->route('index');
    }

    public function getCep(Request $request)
    {
        $cep = $request->cep;
        $url = "https://viacep.com.br/ws/".$cep."/json/";
        $cepJson = file_get_contents($url);
        $ender = json_decode($cepJson);

        return $ender;
    }
}
