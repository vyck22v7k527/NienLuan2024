<?php

namespace App\Http\Controllers;

use App\Common\Constants;
use App\Models\category;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminCategoryController extends Controller
{
    //
    private $category;
    private $product;
    public function __construct(category $category, product $product)
    {
        $this->category = $category;
        $this->product  = $product;
    }
    public function index()
    {
        $category = $this->category->paginate(5);
        return view('admin.category.index', compact('category'));
    }


    public function post(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ], [
            'name.required' => Constants::txt_input_required,
        ]);



        $id = $request->id;
        $name = $request->name;
        $trimmedText = strtolower(ltrim($name));
        $slug = $this->vn_to_str($trimmedText);
        $data = [
            'name' => ucfirst($name),
            'slug' => $slug
        ];
        if (empty($id)) {
            $this->category::FirstOrCreate($data);
        } else {
            $this->category::find($id)->update($data);
        }
        return redirect()->route('categories.index');
    }

    public function delete($id)
    {
        try {
            $countProductByCategory = $this->product->where('category_id', $id)->count();
            if ($countProductByCategory == 0) {
                $this->category->find($id)->delete();
                return response()->json([
                    'code' => Constants::tc_200,
                    'message' => Constants::txt_success
                ], Constants::tc_200);
            }
            return response()->json([
                'code' => Constants::tc_500,
                'message' => Constants::txt_being_used
            ], Constants::tc_500);
        } catch (\Exception $exception) {
            Log::error("message" . $exception->getMessage() . " --- Line : " . $exception->getLine());
            return response()->json([
                'code' => Constants::tc_500,
                'message' => Constants::txt_failure
            ], Constants::tc_500);
        }
    }

    function vn_to_str($str)
    {

        $unicode = array(

            'a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',

            'd' => 'đ',

            'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',

            'i' => 'í|ì|ỉ|ĩ|ị',

            'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',

            'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',

            'y' => 'ý|ỳ|ỷ|ỹ|ỵ',

            'A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',

            'D' => 'Đ',

            'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',

            'I' => 'Í|Ì|Ỉ|Ĩ|Ị',

            'O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',

            'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',

            'Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ',

        );

        foreach ($unicode as $nonUnicode => $uni) {

            $str = preg_replace("/($uni)/i", $nonUnicode, $str);
        }
        $str = str_replace(' ', '-', $str);

        return $str;
    }
}
