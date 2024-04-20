<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Models\category;
use App\Models\post;
use Mail;
use App\Mail\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NewsController extends Controller
{
    private $category;
    public function __construct(category $category)
    {
        $this->category = $category;
    }
    public function index()
    {
         $category = $this->category::all();
        return view('user.contact', compact('category'));
    }

   public function submitForm(Request $request)
    {
        // If validation passes, you can now access the form data
        $name = $request->input('name');
        $phone = $request->input('phone');
        $email = $request->input('email');
        $content = $request->input('content');

       $msg = 'Nội dung: ' . $content . '. ' . 'Số điện thoại: ' . $phone;

        $testMailData = [
            'title' => 'Tên khách hàng: ' .$name,
            'body' => $msg
        ];


        $testMailData = [
            'title' => $name,
            'body' => $msg
        ];

        // Send email
        Mail::to($email)->send(new SendMail($testMailData));

        // Flash success message to the session
        return redirect()->back()->with('success', 'Gửi thông tin của bạn đã được gửi đển quản trị viên');
    }

}
