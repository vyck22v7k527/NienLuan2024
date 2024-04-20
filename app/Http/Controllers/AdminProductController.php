<?php

namespace App\Http\Controllers;

use App\Common\Constants;
use App\Models\category;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AdminProductController extends Controller
{
    private $category;
    private $product;
    public function __construct(category $category, product $product)
    {
        $this->category = $category;
        $this->product = $product;
    }
    public function index()
    {
        $product = $this->product->paginate(5);
        return view("admin.product.index", compact('product'));
    }

    public function create()
    {
        $category = $this->category::all();
        return view("admin.product.create", compact('category'));
    }

    public function post(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'promotional_price' => 'required|valid_promotional_price',
            'description' => 'required',
            'image' => 'required',
        ], [
            'name.required'              => Constants::txt_input_required,
            'price.required'             => Constants::txt_input_required,
            'promotional_price.required' => Constants::txt_input_required,
            'description.required'       => Constants::txt_input_required,
            'image.required'             => Constants::txt_input_required,
        ]);
        $dataProductCreate = [
            'name'              => $request->name,
            'price'             => $request->price,
            'promotional_price' => $request->promotional_price,
            'description'       => $request->description,
            'category_id'       => $request->category,
        ];
        $dataUploadImage = $this->upload($request, 'image', 'product');
        if (!empty($dataUploadImage)) {
            $dataProductCreate["image_path"] = $dataUploadImage["file_path"];
            $dataProductCreate["image_name"] = $dataUploadImage["file_name"];
        }
        $this->product->create($dataProductCreate);
        return redirect()->to(Route("admin.products.index"));
    }

    public function edit($id)
    {
        $category = $this->category::all();
        $product = $this->product->find($id);
        return view("admin.product.edit", compact('product', 'category'));
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $image_old_path = $request->image_old_path;
        $image_old_name = $request->image_old_name;
        $dataProductCreate = [
            'name'              => $request->name,
            'price'             => $request->price,
            'promotional_price' => $request->promotional_price,
            'description'       => $request->description,
            'category_id'       => $request->category,
        ];

        $dataUploadImage = $this->upload($request, 'image', 'product');
        if (!empty($dataUploadImage)) {
            $dataProductCreate["image_path"] = $dataUploadImage["file_path"];
            $dataProductCreate["image_name"] = $dataUploadImage["file_name"];
        } else {
            $dataProductCreate["image_path"] = $image_old_path;
            $dataProductCreate["image_name"] = $image_old_name;
        }
        $this->product->find($id)->update($dataProductCreate);
        return redirect()->to(Route("admin.products.index"));
    }

    public function delete($id)
    {
        try {

            $this->product->find($id)->delete();
            return response()->json([
                'code' => Constants::tc_200,
                'message' => Constants::txt_success
            ], Constants::tc_200);
        } catch (\Exception $exception) {
            Log::error("message" . $exception->getMessage() . " --- Line : " . $exception->getLine());
            return response()->json([
                'code' =>  Constants::tc_500,
                'message' => Constants::txt_failure
            ], Constants::tc_500);
        }
    }

    function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    function upload($request, $fileName, $foldername)
    {
        if ($request->hasFile($fileName)) {
            $file = $request->$fileName;
            $fileNameOriginalName = $file->getClientOriginalName();
            $fileNameHash = $this->generateRandomString(20) . '.' . $file->getClientOriginalExtension();
            $filePath = $request->file('image')->storeAs('public/' . $foldername . '/' . auth()->id(), $fileNameHash);

            $data = [
                'file_name' => $fileNameOriginalName,
                'file_path' => Storage::url($filePath)
            ];
            return $data;
        } else {
            return null;
        }
    }
}
