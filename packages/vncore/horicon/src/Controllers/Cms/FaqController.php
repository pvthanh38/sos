<?php

namespace VNCore\Horicon\Controllers\Cms;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use VNCore\Horicon\Controllers\HoriconController;
use VNCore\Horicon\Models\Faq;
use VNCore\Horicon\Models\FaqComment;
use VNCore\Horicon\Services\FaqService;

class FaqController extends HoriconController
{
    protected $faqService;

    public function __construct(FaqService $faqService)
    {
        $this->faqService = $faqService;
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Faq::query();

        $q = $request->get('q');
        if ($q) {
            $query->search($q);
        }

        $faqs = $query->orderUpdated()->paginate(20);

        return view('horicon::faqs.index', compact('faqs'));
    }

    /**
     * @param Faq $faq
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Faq $faq)
    {
        $comments = $faq->comments()
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        return view('horicon::faqs.show', compact('faq', 'comments'));
    }

    /**
     * @param Faq $faq
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Faq $faq)
    {
//        $this->authorize('update', $faq);

        return view('horicon::faqs.edit', compact('faq'));
    }

    /**
     * @param Request $request
     * @param Faq     $faq
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, Faq $faq)
    {
//        $this->authorize('update', $faq);

        $validated = $request->validate([
            'title' => 'bail|required|max:255',
            'content' => 'required|max:3000',
            'status' => 'sometimes|boolean',
            'replay' => 'required|max:3000',
        ]);

        $validated['status'] = $validated['status'] ?? FALSE;

        $faq->fill($validated);
        $faq->user_id = $faq->user_id ?? Auth::user()->id;
        $faq->replayed_at = Carbon::now()->toDateTimeString();
        $faq->save();

        // Send notifications
//        $this->faqService->pushNotifications($faq);

        return back()->with('message', 'Updated successfully!');
    }

    /**
     * @param Faq $faq
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Faq $faq)
    {
//        $this->authorize('update', $faq);

        $faq->delete();
        return back()->with('message', 'Deleted successfully!');
    }

    /**
     * @param Request $request
     * @param Faq     $faq
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeComment(Request $request, Faq $faq)
    {
//        $this->authorize('update', $faq);

        $validated = $request->validate([
            'content' => 'required|max:3000',
        ]);

        $comment = new FaqComment();
        $comment->fill($validated);
        $comment->user_id = Auth::user()->id;

        $faq->comments()->save($comment);

        return back()->with('message', 'Updated successfully!');
    }
}
