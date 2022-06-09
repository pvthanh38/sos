<?php

namespace VNCore\Horicon\Controllers\Cms\Sos;

use Illuminate\Http\Request;
use VNCore\Horicon\Controllers\HoriconController;
use VNCore\Horicon\Models\SosNotification;
use VNCore\Horicon\Services\FcmService;

class NotificationController extends HoriconController
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
        $query = SosNotification::query();

        $q = $request->get('q');
        if ($q) {
            $query->search($q);
        }

        $notifications = $query->orderUpdated()->paginate(20);

        return view('horicon::sos.notifications.index', compact('notifications'));
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $notification = new SosNotification();
        return view('horicon::sos.notifications.create', compact('notification'));
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
            'link' => 'nullable',
            'text' => 'required|max:3000',
            'document' => 'required|image',
        ]);

        $notification = new SosNotification();
        $notification->fill($validated);
        $notification->save();
        $notification->addFileFromRequest();

        $this->fcmService->sendToTopic($notification->title, $notification->text, $notification, FcmService::TOPIC_NOTIFICATION);

        return back()->with('message', 'Created successfully!');
    }

    /**
     * @param SosNotification $notification
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(SosNotification $notification)
    {
        return view('horicon::sos.notifications.edit', compact('notification'));
    }

    /**
     * @param Request         $request
     * @param SosNotification $notification
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, SosNotification $notification)
    {
        $validated = $request->validate([
            'title' => 'bail|required|max:255',
            'link' => 'nullable',
            'text' => 'required|max:3000',
            'document' => 'sometimes|required|image',
        ]);

        $notification->fill($validated);
        $notification->save();
        $notification->addFileFromRequest();

        return back()->with('message', 'Updated successfully!');
    }

    /**
     * @param SosNotification $notification
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(SosNotification $notification)
    {
        $notification->delete();
        return back()->with('message', 'Deleted successfully!');
    }
}
