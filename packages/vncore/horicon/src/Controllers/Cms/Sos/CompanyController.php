<?php

namespace VNCore\Horicon\Controllers\Cms\Sos;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;
use VNCore\Horicon\Controllers\HoriconController;
use VNCore\Horicon\Imports\SosCompaniesImport;
use VNCore\Horicon\Models\SosCompany;

class CompanyController extends HoriconController
{
    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = SosCompany::query();

        $q = $request->get('q');
        if ($q) {
            $query->search($q);
        }

        $companies = $query->orderUpdated()->paginate(20);

        return view('horicon::sos.companies.index', compact('companies'));
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $company = new SosCompany();
        return view('horicon::sos.companies.create', compact('company'));
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|regex:/^[a-zA-Z0-9]+$/u|max:100|unique:sos_companies',
            'name' => 'bail|required|max:255',
            'desc' => 'required|max:3000',
        ]);

        $company = new SosCompany();
        $company->fill($validated);
        $company->save();

        return back()->with('message', 'Created successfully!');
    }

    /**
     * @param SosCompany $company
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(SosCompany $company)
    {
        return view('horicon::sos.companies.edit', compact('company'));
    }

    /**
     * @param Request    $request
     * @param SosCompany $company
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, SosCompany $company)
    {
        $validated = $request->validate([
            'code' => 'required|regex:/^[a-zA-Z0-9]+$/u|max:100|unique:sos_companies,code,'.$company->id,
            'name' => 'bail|required|max:255',
            'desc' => 'required|max:3000',
        ]);

        $company->fill($validated);
        $company->save();

        return back()->with('message', 'Updated successfully!');
    }

    /**
     * @param SosCompany $company
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(SosCompany $company)
    {
        $company->delete();
        return back()->with('message', 'Deleted successfully!');
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function import()
    {
        return view('horicon::sos.companies.import');
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function importStore(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx',
        ]);

        Excel::import(new SosCompaniesImport(), $request->file('file'));

        return back()->with('message', 'Nhập công ty thành công!');
    }
}
