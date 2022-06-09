<?php

namespace VNCore\Horicon\Controllers\Api;

use VNCore\Horicon\Controllers\HoriconController;
use VNCore\Horicon\Http\Resources\SosAskedQuestionCollection;
use VNCore\Horicon\Http\Resources\SosQuestionCollection;
use VNCore\Horicon\Models\SosAskedQuestion;
use VNCore\Horicon\Models\SosQuestion;

class QuestionController extends HoriconController
{
    public function index()
    {
        $questions = SosQuestion::orderBy('created_at', 'desc')->get();
        return new SosQuestionCollection($questions);
    }

    public function questions()
    {
        $questions = SosAskedQuestion::orderBy('created_at', 'desc')->get();
        return new SosAskedQuestionCollection($questions);
    }
}