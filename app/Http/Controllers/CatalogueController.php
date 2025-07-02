<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;

class CatalogueController extends Controller
{
    public function generatePdf(Request $request)
    {
        $request->validate([
            'product_ids' => 'required|string',
        ]);

        $backgroundUrl = url('assets/images/background.jpg');
        $products = collect();

        if ($request->product_ids === 'all') {
            $products = Product::all();
        } else {
            $ids = array_filter(explode(',', $request->product_ids));
            $products = Product::whereIn('id', $ids)->get();
        }

        $products->each(function ($product) {
            $product->name = Str::limit($product->name, 35, '...');
        });

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.catalogue', [
            'products' => $products,
            'backgroundUrl' => $backgroundUrl
        ])
            ->setPaper('a3')
            ->setOptions([
                'isRemoteEnabled' => true,
                'chroot' => public_path()
            ]);

        return $pdf->stream('catalogue.pdf');
    }
}
