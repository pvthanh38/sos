<?php

namespace VNCore\Horicon\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use VNCore\Horicon\Controllers\HoriconController;
use VNCore\Horicon\Http\Resources\SosConversationCollection;
use VNCore\Horicon\Models\SosConversation;
use VNCore\Horicon\Models\SosSupport;

class ConversationController extends HoriconController
{
    public function index($id)
    {
        $support = SosSupport::findOrFail($id);
        $conversations = $support->conversations;
        return new SosConversationCollection($conversations);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'support_id' => 'required|exists:sos_supports,id',
            'content' => 'required|max:255',
            'media' => 'file|image',
        ]);

        $support = SosSupport::find($data['support_id']);

        $conversation = new SosConversation();
        $conversation->fill($data);
        $conversation->addImageFromRequest();

        $support->conversations()->save($conversation);
        $support->status = 2;
        $support->save();

        return Response::json(['status' => 0]);
    }
}