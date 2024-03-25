<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
class CaptchaServiceController extends Controller
{
    public function index() // loads the form template in the view with the captcha element.
    {
        return view('index');
    }
    public function capthcaFormValidate(Request $request) // Validates the entire form, including the captcha input field.
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'username' => 'required',
            'captcha' => 'required|captcha'
        ]);
    }
    public function reloadCaptcha() // refreshes the captcha code or text
    {
        return response()->json(['captcha'=> captcha_img()]);
    }
}
