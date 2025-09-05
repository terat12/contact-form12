<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Category;
use App\Models\Contact;

class ContactController extends Controller
{
    // 入力ページ(/)
    public function create()
    {
        $categories = Category::orderBy('id')->get();
        return view('contact.create', ['categories' => $categories]);
    }

    // 確認ページへ（/confirm, POST）
    public function confirm(ContactRequest $request)
    {
        if ($request->has('back')) {
        return redirect()->route('contact.create')->withInput();
        }

        $data = $request->validated();
        $category = Category::find($data['category_id']);
        $genderText = [1 => '男性', 2 => '女性', 3 => 'その他'][$data['gender']] ?? '';

        return view('contact.confirm', compact('data', 'category', 'genderText'));
    }

    // 保存（/ , POST）→ サンクス（/thanks） 
    public function store(ContactRequest $request)
    {
        Contact::create($request->validated());
        return redirect()->route('contact.thanks');
    }

    // サンクス（/thanks） 
    public function thanks()
    {
        return view('contact.thanks');
    }
}
