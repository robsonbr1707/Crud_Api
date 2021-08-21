<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::all();
            return response(['products'=> ProductResource::collection($product),
                'message' => 'Produtos'
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data,
        [
            'name_product' => ['required', 'min:3'],
            'description' => ['required'],
            'price' => ['required']
        ]);

            if($validator->fails()):
                return response(['error' => $validator->errors(),
                    'message' => 'Confira Se Os Campos Estão Corretos'
            ], 400);
            endif;

            $product = Product::create($data);
                return response(['product' => new ProductResource($product),
                    'message' => 'Produto Criado Com Sucesso!'
        ], 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return response(['product' => new ProductResource($product), 
            'message' => 'Produto' 
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $user = auth()->user();

        if($user->id != $product->id):
            return response(['message'=> 'Você Não Pode Alterar Produto De Outro Usuario'], 400);
        endif;

        $product->update($request->all());
            return response(['product'=> new ProductResource($product),
            'message' => 'Produto Atualizado Com Sucesso!'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $user = auth()->user();

        if($user->id != $product->id):
            return response(['message'=> 'Você Não Pode Excluir Produto De Outro Usuario'], 400);
        endif;

        $product->delete();
            return response(['message' => 'Produto Excluido Com Sucesso']);
    }
}
