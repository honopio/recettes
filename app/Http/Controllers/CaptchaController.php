<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CaptchaController extends Controller
{
    public function showForm(){
    $captchaQuestion = $this->generateCaptchaQuestion();
    session(['captcha_answer' => $captchaQuestion['answer']]);
    return view('/recipes/single', ['captchaQuestion' => $captchaQuestion['question']]);
    }

    protected function generateCaptchaQuestion()
    {
        $num1 = rand(1, 10);
        $num2 = rand(1, 10);
        $answer = $num1 + $num2;

        return ['question' => "What is $num1 + $num2?", 'answer' => $answer];
    }

    public function handleSubmit(Request $request)
    {
        $request->validate([
            'captcha' => 'required',
            'answer' => 'required',
        ]);

        if ($request->input('answer') != session('captcha_answer')) {
            return back()->withErrors(['captcha' => 'The CAPTCHA answer is incorrect.']);
        }
    }
}

