<?php

namespace VNCore\Horicon\Controllers\Cms\Sos;

use Illuminate\Http\Request;
use VNCore\Horicon\Controllers\HoriconController;
use VNCore\Horicon\Models\SosContact;

class ContactController extends HoriconController
{
    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = SosContact::query();

        $q = $request->get('q');
        if ($q) {
            $query->search($q);
        }

        $contacts = $query->orderUpdated()->paginate(20);

        return view('horicon::sos.contacts.index', compact('contacts'));
    }

    /**
     * @param SosContact $contact
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(SosContact $contact)
    {
        return view('horicon::sos.contacts.edit', compact('contact'));
    }

    /**
     * @param Request    $request
     * @param SosContact $contact
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, SosContact $contact)
    {
        $validated = $request->validate([
            'title' => 'bail|required|max:255',
            'content' => 'required|max:3000',
        ]);

        $contact->fill($validated);
        $contact->save();

        return back()->with('message', 'Updated successfully!');
    }

    /**
     * @param SosContact $contact
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(SosContact $contact)
    {
        $contact->delete();
        return back()->with('message', 'Deleted successfully!');
    }
}
