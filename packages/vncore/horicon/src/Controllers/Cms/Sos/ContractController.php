<?php

namespace VNCore\Horicon\Controllers\Cms\Sos;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use VNCore\Horicon\Controllers\HoriconController;
use VNCore\Horicon\Models\SosCompany;
use VNCore\Horicon\Models\SosContract;
use VNCore\Horicon\Models\SosContractLocation;

class ContractController extends HoriconController
{
    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = SosContract::query();

        $q = $request->get('q');
        if ($q) {
            $query->search($q);
        }

        $contracts = $query->orderUpdated()->paginate(20);
        return view('horicon::sos.contracts.index', compact('contracts'));
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $contract = new SosContract();
        $companies = SosCompany::orderBy('id')->pluck('name', 'id');
        return view('horicon::sos.contracts.create', compact('contract', 'companies'));
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_id' => 'required|exists:sos_companies,id',
            'code' => 'required|string|max:100|unique:sos_contracts',
            'file' => 'required|file|mimes:pdf',
            'location.*.lat' => ['required', 'regex:/^(\+|-)?(?:90(?:(?:\.0{1,6})?)|(?:[0-9]|[1-8][0-9])(?:(?:\.[0-9]{1,6})?))$/'],
            'location.*.lng' => ['required', 'regex:/^(\+|-)?(?:180(?:(?:\.0{1,6})?)|(?:[0-9]|[1-9][0-9]|1[0-7][0-9])(?:(?:\.[0-9]{1,6})?))$/'],
        ]);

        $contract = new SosContract();
        $contract->fill($validated);
        $contract->save();
        $contract->addFileFromRequest();

        foreach ($validated['location'] as $latLng) {
            $location = new SosContractLocation();
            $location->fill($latLng);
            $contract->locations()->save($location);
        }

        return back()->with('message', 'Created successfully!');
    }

    /**
     * @param SosContract $contract
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(SosContract $contract)
    {
        $companies = SosCompany::orderBy('id')->pluck('name', 'id');
        return view('horicon::sos.contracts.edit', compact('contract', 'companies'));
    }

    /**
     * @param Request     $request
     * @param SosContract $contract
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, SosContract $contract)
    {
        $validated = $request->validate([
            'company_id' => 'required|exists:sos_companies,id',
            'code' => [
                'required',
                'string',
                'max:100',
                Rule::unique('sos_contracts')->where(function ($query) use ($contract) {
                    $query->where('id', '!=', $contract->id);
                    return $query;
                }),
            ],
            'location' => 'bail|required|max:255',
            'file' => 'file|mimes:pdf',
            'location.*.lat' => ['required'],
            'location.*.lng' => ['required'],
        ]);

        $contract->fill($validated);
        $contract->save();
        $contract->addFileFromRequest();

        $locations = $validated['location'];
        foreach ($locations as $key => $latLng) {
            $location = SosContractLocation::find($key);
            $location->fill($latLng);
            $location->save();
        }

        return back()->with('message', 'Updated successfully!');
    }

    /**
     * @param SosContract $contract
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(SosContract $contract)
    {
        $contract->delete();
        return back()->with('message', 'Deleted successfully!');
    }

    /**
     * @param SosContract $contract
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function download(SosContract $contract)
    {
        $file = $contract->getFile();
        return response()->download($file->getPath(), $file->name);
    }

    /**
     * @param SosContract $contract
     *
     * @return \Illuminate\Http\Response
     */
    public function createLocation(SosContract $contract)
    {
        return view('horicon::sos.contracts.location.create', compact('contract'));
    }

    /**
     * @param Request     $request
     * @param SosContract $contract
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function storeLocation(Request $request, SosContract $contract)
    {
        $validated = $request->validate([
            'lat' => ['required', 'regex:/([0-9.-]+).+?([0-9.-]+)/'],
            'lng' => ['required', 'regex:/([0-9.-]+).+?([0-9.-]+)/'],
        ]);

        $location = new SosContractLocation();
        $location->fill($validated);
        $location->save();

        $location->contract()->associate($contract);
        $location->save();

        return redirect($contract->url()->edit);
    }

    /**
     * @param SosContractLocation $location
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroyLocation(SosContractLocation $location)
    {
        $location->delete();
        return back()->with('message', 'Deleted successfully!');
    }
}
