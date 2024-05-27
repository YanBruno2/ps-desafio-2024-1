<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class ProductController extends Controller
{
    private Product $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = $this->product->with('category')->get();

        return response()->json($product, Response::HTTP_OK);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $data['image'] = url('storage/'.$path);
        }

        $product = $this->product->create($data);
        $id = $product->id;
        //nova variavel
        $product_category = $product->with('category')->findOrFail($id);

        return response()->json($product_category, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = $this->product->with('category')->findOrFail($id);

        return response()->json($product, Response::HTTP_OK);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, string $id)
    {
        $data = $request->validated();
        $product = $this->product->findOrFail($id);
        if ($request->hasFile('image')) {
            try {
                $image_name = explode('product/', $product->image);
                Storage::disk('public')->delete('produto/'.$image_name[1]);
            } catch (Throwable) {
            } finally {
                $path = $request->file('image')->store('produto', 'public');
                $data['image'] = url('storage/'.$path);
            }
        }
        $product->update($data);
        $product_category = $product->with('category')->findOrFail($id);

        return response()->json($product_category, Response::HTTP_OK);

    }

    // app/Http/Controllers/ProdutoController.php

    public function getProdutosPorCategoria(Request $request)
    {
        $categoria = $request->query('categoria');
        if ($categoria) {
            $produtos = Product::whereHas('categoria', function ($query) use ($categoria) {
                $query->where('nome', $categoria);
            })->get();
        } else {
            $produtos = Product::all();
        }

        return response()->json($produtos);
    }

    public function destroy($id)
    {
        $product = $this->product->findOrFail($id);
        $product->delete();

        return response()->json([], Response::HTTP_NO_CONTENT);
    }

    //função para atualizar a quantidade de produto
    /*

        namespace App\Http\Controllers;

        use App\Models\Product;
        use Illuminate\Http\Request;
        use Symfony\Component\HttpFoundation\Response;

        public function decreaseQuantity(Request $request, $id)
    {
        $product = $this->product->findOrFail($id);
        $quantityToDecrease = $request->input('quantity');

        if ($quantityToDecrease <= 0) {
            return response()->json(['error' => "Quantidade a ser decrementada deve ser maior que zero"], Response::HTTP_BAD_REQUEST);
        }
        if ($product->quantity < $quantityToDecrease) {
            return response()->json(['error' => "Não há produto suficiente no estoque"], Response::HTTP_BAD_REQUEST);
        }

        $product->quantity -= $quantityToDecrease;
        $product->save();

        return response()->json($product, Response::HTTP_OK);
    }
}

    */

}
