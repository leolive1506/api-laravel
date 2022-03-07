<?php

namespace App\Http\Controllers\Api;

use App\API\ApiMsg;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private Product $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }
    public function index() {
        // $data = ['data' => $this->product->paginate(5)];
        return response()->json($this->product->paginate(5));
        // return $this->product->all();
    }

    public function show($id)
    {
        $product = $this->product->find($id);
        if(!$product) {
            return response()->json(ApiMsg::message('Produto não encontrado'), 404);
        }
        $data = ['data' => $product];
        return response()->json($data);
    }

    public function store(Request $request)
    {
        try {
            $this->product->create([
                'name' => $request->name,
                'price' => floatval($request->price),
                'description' => $request->description
            ]);

            return response()->json(ApiMsg::message('Produto criado com sucesso'));

        } catch (\Exception $e) {
            return response()->json(ApiMsg::message('Falha ao criar o produto!' . $e ), 500);
        }

    }

    public function update(Request $request, $id)
    {
        try {
            $product = $this->product->find($id);
            $product->update([
                'name' => $request->name,
                'price' => floatval($request->price),
                'description' => $request->description
            ]);

            return response()->json(ApiMsg::message('Produto editado com sucesso'), 201);

        } catch (\Exception $e) {
            return response()->json(ApiMsg::message('Falha ao criar o produto!' . $e ), 500);
        }

    }

    public function delete($id)
    {
        try {
            $product = $this->product->find($id);

            $product->delete();
            return response()->json(ApiMsg::message('Produto ' . $product->name . ' excluído com sucesso'), 200);
        } catch (\Exception $e) {
            return response()->json(ApiMsg::message('Falha ao excluir o produto!' . $e ), 500);
        }
    }
}
