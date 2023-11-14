<?php

namespace App\Http\Controllers;

use App\Imports\ProductImport;
use App\Models\Product;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{

    public function uploadForm()
    {
        return view('products.uploadForm');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        $file = $request->file('file');

        Excel::import(new ProductImport, $file);

        return redirect()->route('products.uploadForm')->with('success', 'Products imported successfully.');
    }

    public function getProductTable()
    {
        $products = Product::all();
        return view('products.productTable', compact('products'));
    }

    public function deleteSelected(Request $request)
    {
        $selectedProductIds = $request->input('ids');
        
        Product::whereIn('id', $selectedProductIds)->delete();

        return response()->json(['message' => 'Selected products deleted successfully.']);
    }
}

