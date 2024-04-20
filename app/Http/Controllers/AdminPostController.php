<?php

namespace App\Http\Controllers;

use App\Common\Constants;
use App\Models\category_post;
use App\Models\post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AdminPostController extends Controller
{
    //
    private $category_post;
    private $post;
    public function __construct(category_post $category_post, post $post)
    {
        $this->category_post    = $category_post;
        $this->post             = $post;
    }
    public function index()
    {
        $posts = $this->post::all();
        return view("admin.post.index", compact('posts'));
    }

    public function create()
    {

        $category_posts = $this->category_post::all();
        return view("admin.post.create", compact('category_posts'));
    }

    public function post(Request $request)
    {
        $request->validate([
            'name'    => 'required',
            'image'   => 'required',
            'content' => 'required',
        ], [
            'name.required'    => Constants::txt_input_required,
            'image.required'   => Constants::txt_input_required,
            'content.required' => Constants::txt_input_required,
        ]);
        $dataPostCreate = [
            'name'              => $request->name,
            'content'           => $request->content,
            'category_post_id'  => $request->category_post_id,
            'user_id'           => auth()->id(),
        ];
        $dataUploadImage = $this->upload($request, 'image', 'product');
        if(!empty($dataUploadImage)) {
            $dataPostCreate["image_path"] = $dataUploadImage["file_path"];
            $dataPostCreate["image_name"] = $dataUploadImage["file_name"];
        }
        $this->post->create($dataPostCreate);
        return redirect()->to(Route("admin.posts.index"));
    }

    public function edit($id) {
        $category_posts = $this->category_post::all();
        $post = $this->post->find($id);
        return view("admin.post.edit", compact('post', 'category_posts'));
    }

    public function update(Request $request) {
        $request->validate([
            'name'    => 'required',
            'content' => 'required',
        ], [
            'name.required'    => Constants::txt_input_required,
            'content.required' => Constants::txt_input_required,
        ]);
        $id = $request->id;
        $image_old_path = $request->image_old_path;
        $image_old_name = $request->image_old_name;
        $dataPostCreate = [
            'name'              => $request->name,
            'content'           => $request->content,
            'category_post_id'  => $request->category_post_id,
            'user_id'           => auth()->id(),
        ];

        $dataUploadImage = $this->upload($request, 'image', 'product');
        if(!empty($dataUploadImage)) {
            $dataPostCreate["image_path"] = $dataUploadImage["file_path"];
            $dataPostCreate["image_name"] = $dataUploadImage["file_name"];
        }else{
            $dataPostCreate["image_path"] = $image_old_path;
            $dataPostCreate["image_name"] = $image_old_name;
        }
        $this->post->find($id)->update($dataPostCreate);
        return redirect()->to(Route("admin.posts.index"));
    }

    public function delete($id) {
        try{
            $this->post->find($id)->delete();
            return response()->json([
                'code' => Constants::tc_200,
                'message' => Constants::txt_success
            ],Constants::tc_200);
        }catch(\Exception $exception){
            Log::error("message". $exception->getMessage(). " --- Line : ". $exception->getLine());
            return response()->json([
                'code' => Constants::tc_500,
                'message' => Constants::txt_failure
            ],Constants::tc_500);
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
            $filePath = $request->file('image')->storeAs('public/' . $foldername . '/' .auth()->id(), $fileNameHash);

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
