<?php
namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $existingProduct = Product::where('name', $row['name'])->first();

        if ($existingProduct) {
            $existingProduct->update([
                'price' => $row['price'],
            ]);

            return $existingProduct;
        }

        return new Product([
            'name' => $row['name'],
            'price' => $row['price'],
        ]);
    }
}
