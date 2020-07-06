<?php
namespace App\Services;
use Illuminate\Support\Str as Str;
use App\Product;

class ProductService {

    public function getAllProducts() {
        $products = Product::orderBy('id', 'DESC')->paginate(10);
        return response()->json($products, 200);
    }

    public function getProduct($id) {
        $product = Product::where('id', $id)->get();
        return response()->json($product, 200);
    }

    public function store($request)
    {
        $request['slug'] = $this->generateSlug($request['name']);

        Product::create($request);

        return response()->json('Product saved successfully', 200);
    }

    public function update($request, $id)
    {
        $request['slug'] = $this->generateSlug($request['name']);


        $product = Product::find($id);
        $product->update($request);

        return response()->json('Product updated successfully', 200);
    }

    public function destroy($id)
    {
        if ($product = Product::find($id)) {
            $product->delete();
            return response()->json('Product deleted successfully', 200);
        }
        return response()->json('Product not found', 404);
    }

    private function generateSlug($name)
    {
        $slug = Str::slug($name);
        $newSlug = $slug;
        $next = 2;

        //if there is already an equal slug, we add a number at the end
         while (Product::where('slug', '=', $newSlug)->first()) {
             $newSlug = $slug . "-". $next;
             $next++;
         }

         return $newSlug;
    }

}
