<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Models\Product;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private Category $category;

    public function __construct(Category $category)
    {
        $this->category = $category;

    }

    public function index() //:JsonResponse
    {
        $category = $this->category->all();

        return response()->json($category, Response::HTTP_OK);

    }

    //controller de para requisitar produto por categoria
    public function getProductsByCategory($id)
    {
        $products = Product::where('categorias_id', $id)->get();

        return response()->json($products, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request) //:JsonResponse
    {
        $data = $request->validated();
        $category = $this->category->create($data);

        return response()->json($category, Response::HTTP_CREATED);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) //:JsonResponse
    {
        $category = $this->category->findOrFail($id);

        return response()->json($category, Response::HTTP_OK);

    }

    public function update(UpdateCategoryRequest $request, string $id) //:JsonResponse
    {
        $data = $request->validated();
        $category = $this->category->findOrFail($id);
        $category->update($data);

        return response()->json($category, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) //:JsonResponse
    {
        $category = $this->category->findOrFail($id);
        $category->delete();

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
