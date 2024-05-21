<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Symfony\Component\HttpFoundation\JsonResponse;

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

        return response()->json($category);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request) //:JsonResponse
    {
        $data = $request->validated();
        $category = $this->category->create($data);

        return response()->json($category);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) //:JsonResponse
    {
        $category = $this->category->findOrFail($id);

        return response()->json($category);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, string $id) //:JsonResponse
    {
        $data = $request->validated();
        $category = $this->category->findOrFail($id);
        $category->update($data);

        return response()->json($category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) //:JsonResponse
    {
        $category = $this->category->findOrFail($id);
        $category->delete();

        return response()->json(['message' => 'foi deletado com sucesso']);
    }
}
