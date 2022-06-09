<?php

namespace VNCore\Horicon\Controllers\Cms\Sos;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use VNCore\Horicon\Controllers\HoriconController;
use VNCore\Horicon\Exports\SosSupportsExport;
use VNCore\Horicon\Models\SosConversation;
use VNCore\Horicon\Models\SosConversationAdmin;
use VNCore\Horicon\Models\SosSupport;
use VNCore\Horicon\Services\FcmService;

class SupportController extends HoriconController
{
    protected $fcmService;

    public function __construct(FcmService $fcmService)
    {
        $this->fcmService = $fcmService;
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = SosSupport::query();

        $q = $request->get('q');
        if ($q) {
            $query->search($q);
        }

        $supports = $query->orderUpdated()->paginate(20);

        return view('horicon::sos.supports.index', compact('supports'));
    }

    /**
     * @param SosSupport $support
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(SosSupport $support)
    {
        return view('horicon::sos.supports.edit', compact('support'));
    }

    /**
     * @param Request    $request
     * @param SosSupport $support
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, SosSupport $support)
    {
        $validated = $request->validate([
//            'location' => 'required|max:255',
//            'content' => 'required|max:3000',
            'status' => 'required',
//            'lat' => 'required|string',
//            'lng' => 'required|string',
            'replay' => 'max:3000',
        ]);

        $validated['status'] = $validated['status'] ?? 0;
        $support->fill($validated);
        $support->replayed_at = Carbon::now()->toDateTimeString();
        $support->save();

        return back()->with('message', 'Updated successfully!');
    }

    /**
     * @param SosSupport $support
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function close(SosSupport $support)
    {
        $support->status = 1;
        $support->save();

        return back()->with('message', 'Đóng hỗ trợ thành công!');
    }

    /**
     * @param SosSupport $support
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(SosSupport $support)
    {
        $support->delete();
        return back()->with('message', 'Deleted successfully!');
    }

    /**
     * @param SosSupport $support
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(SosSupport $support)
    {
        $conversations = $support->conversations()
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        $conversationsAdmin = $support->conversationsAdmin()
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('horicon::sos.supports.show', compact('support', 'conversations', 'conversationsAdmin'));
    }

    /**
     * @param Request    $request
     * @param SosSupport $support
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeComment(Request $request, SosSupport $support)
    {
        $validated = $request->validate([
            'content' => 'required|max:3000',
            'media' => 'file|image',
        ]);

        $conversation = new SosConversation();
        $conversation->fill($validated);
        $conversation->admin_id = Auth::user()->id;
        $conversation->addImageFromRequest();

        $support->conversations()->save($conversation);
        $support->status = 2;
        $support->save();

        $fcmService = new FcmService();
        $fcmService->sendTo($support->title ? $support->title : 'Admin trả lời hỗ trợ #' . $support->id, $conversation->content, $conversation, $support->user->fcm_token);

        return back()->with('message', 'Updated successfully!');
    }

    /**
     * @param Request    $request
     * @param SosSupport $support
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeAdminComment(Request $request, SosSupport $support)
    {
        $validated = $request->validate([
            'content' => 'required|max:3000',
            'media' => 'file|image',
        ]);

        $conversation = new SosConversationAdmin();
        $conversation->fill($validated);
        $conversation->admin_id = Auth::user()->id;
        $conversation->addImageFromRequest();

        $support->conversations()->save($conversation);
        $support->status = 2;
        $support->save();

        $fcmService = new FcmService();
        $fcmService->sendTo($support->title ? $support->title : 'Admin trả lời hỗ trợ #' . $support->id, $conversation->content, $conversation, $support->user->fcm_token);

        return back()->with('message', 'Updated successfully!');
    }

    /**
     * @param SosSupport $support
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show2(SosSupport $support)
    {
        return view('horicon::sos.supports.show2', compact('support'));
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function download(Request $request)
    {
        $now = Carbon::now();
        $startDate = $now->firstOfMonth()->toDateString();
        $now = Carbon::now();
        $endDate = $now->toDateString();

        $start = $request->get('start', $startDate);
        $end = $request->get('end', $endDate);
        $urgent = boolval($request->get('urgent', 1));

        return (new SosSupportsExport($start, $end, $urgent))->download('supports.xlsx');
    }
}
