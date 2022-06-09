<?php

namespace VNCore\Horicon\Controllers\Cms\Sos;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use VNCore\Horicon\Controllers\HoriconController;
use VNCore\Horicon\Models\Faq;
use VNCore\Horicon\Models\FaqComment;
use VNCore\Horicon\Models\SosAskedQuestion;
use VNCore\Horicon\Services\FaqService;

class AskedQuestionController extends HoriconController
{
    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = SosAskedQuestion::query();

        $q = $request->get('q');
        if ($q) {
            $query->search($q);
        }

        $questions = $query->orderUpdated()->paginate(20);

        return view('horicon::sos.questions.index', compact('questions'));
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $question = new SosAskedQuestion();
        return view('horicon::sos.questions.create', compact('question'));
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'bail|required|max:255',
            'content' => 'required|max:3000',
        ]);

        $question = new SosAskedQuestion();
        $question->fill($validated);
        $question->save();
        return back()->with('message', 'Created successfully!');
    }

    /**
     * @param SosAskedQuestion $question
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(SosAskedQuestion $question)
    {
        return view('horicon::sos.questions.edit', compact('question'));
    }

    /**
     * @param Request $request
     * @param SosAskedQuestion $question
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, SosAskedQuestion $question)
    {
        $validated = $request->validate([
            'title' => 'bail|required|max:255',
            'content' => 'required|max:3000',
        ]);

        $question->fill($validated);
        $question->save();

        return back()->with('message', 'Updated successfully!');
    }

    /**
     * @param SosAskedQuestion $question
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(SosAskedQuestion $question)
    {
        $question->delete();
        return back()->with('message', 'Deleted successfully!');
    }
}
