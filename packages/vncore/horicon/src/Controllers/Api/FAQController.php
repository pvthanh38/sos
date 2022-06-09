<?php

namespace VNCore\Horicon\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use VNCore\Horicon\Controllers\HoriconController;
use VNCore\Horicon\Http\Resources\SosFaq2;
use VNCore\Horicon\Http\Resources\SosFaqCollection;
use VNCore\Horicon\Http\Resources\SosFaqCommentCollection;
use VNCore\Horicon\Models\Faq;
use VNCore\Horicon\Models\FaqComment;

class FAQController extends HoriconController
{
    public function sendQA(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $data = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required|max:5000',
        ]);

        $faq = new Faq();
        $faq->fill($data);
        $faq->user_id = $user->id;
        $faq->save();

        return Response::json(['status' => 0]);
    }

    public function commentQA(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $data = $request->validate([
            'faq_id' => 'required|exists:faqs,id',
            'content' => 'required|max:5000',
        ]);

        $comment = new FaqComment();
        $comment->fill($data);
        $comment->user_id = $user->id;
        $comment->faq_id = $data['faq_id'];
        $comment->save();

        return Response::json(['status' => 0]);
    }

    public function listQA(Request $request)
    {
        $perPage = $request->get('number', 20);
        $faqs = Faq::orderBy('created_at', 'desc')->paginate($perPage);
        return new SosFaqCollection($faqs);
    }

    public function QAContent($id)
    {
        $faq = Faq::findOrFail($id);
        return new SosFaq2($faq);
    }
}