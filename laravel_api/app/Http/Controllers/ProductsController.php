<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Model\Products;
use Validator;
class ProductsController extends Controller
{

    public function index()
    {
        $products = Products::select("products.*")->get()->toArray();
        return response()->json($products);
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required|unique:products|max:60',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'ok' => false,
                'error' => $validator->messages(),
            ]);
        }

        try {

            Products::create($input);
            return response()->json([
                "ok" => true,
                "message" => "Registrado com sucesso",
            ]);

        } catch (\Exception $ex) {

            return response()->json([
                "ok" => false,
                "error" => $ex->getMessage(),
            ]);
        }
    }

    public function show($id)
    {
        $products = Products::select("products.*")
            ->where("products.id", $id)
            ->first();
        return response()->json([
            "ok" => true,
           "data" => $products,
        ]);
    }

    public function update(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required|max:60',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'ok' => false,
                'error' => $validator->messages(),
            ]);
        }

        try {

            $products = Products::find($request->id);

            if ($products == false) {
                return response()->json([
                    "ok" => false,
                    "error" => "Não foi encontrado",
                ]);
            }

            $products->update($input);
            return response()->json([
                "ok" => true,
                "message" => "Alterado com Sucesso",
            ]);

        } catch (\Exception $ex) {
            
            return response()->json([
                "ok" => false,
                "error" => $ex->getMessage(),
            ]);
        }
    }

    public function destroy($id)
    {
        try {
            $products = Products::find($id);
            if ($products == false) {
                return response()->json([
                    "ok" => false,
                    "error" => "Não foi encontrado",
                ]);
            }
            $products->delete([
            ]);
            return response()->json([
                "ok" => true,
                "message" => "Foi removido com sucesso",
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                "ok" => false,
                "error" => $ex->getMessage(),
            ]);
        }
    }
}
