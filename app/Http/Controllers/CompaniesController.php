<?php

namespace App\Http\Controllers;

use App\Models\Companies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Companies::orderBy('id', 'DESC')->paginate(5);
        return view('pages.companies.index')->with([
            'companies' => $companies
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $model = new Companies;
        $this->validate($request, [
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'max:255', 'unique:' . $model->getTable() . ',email'],
            'website' => ['required', 'url'],
            'logo' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ]);

        $data = $request->all();

        if ($image = $request->file('logo')) {
            $destinationPath = 'images/company';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $data['logo'] = "$profileImage";
        }

        // $model->create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'website' => $request->website,
        //     'logo' => $filename
        // ]);
        // $model->create($data);
        $model->create($data);

        return redirect()->route('companies.index')->with('success', 'Companies Successfully Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $companies = Companies::find($id);
        if ($companies) {
            return view('pages.companies.edit')->with([
                'companies' => $companies
            ]);
        } else {
            return back()->with('error', 'Data Not Found');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $companiesModel = new Companies;
        $companies = $companiesModel->find($id);

        if ($companies) {
            $this->validate($request, [
                'name' => ['string'],
                'email' => ['nullable', 'email', 'max:255', 'unique:' . $companiesModel->getTable() . ',email,' . $id],
                'website' => ['url']
            ]);
            $data = $request->all();

            if ($image = $request->file('logo')) {
                $destinationPath = 'images/company';
                $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $profileImage);
                $data['logo'] = "$profileImage";
            } else {
                unset($input['logo']);
            }

            $status = $companies->update($data);
            if ($status) {
                return redirect()->route('companies.index')->with('success', 'Companies Successfully Updated');
            } else {
                return back()->with('error', 'Something went wrong!');
            }
        } else {
            return back()->with('error', 'Data Not Found');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $companies = Companies::find($id);
        if ($companies) {
            $image_path = public_path() . '/images/company/' . $companies->logo;
            unlink($image_path);
            $status = $companies->delete();
            if ($status) {
                return redirect()->route('companies.index')->with('success', 'Companies successfully deleted');
            } else {
                return back()->with('error', 'Something went wrong!');
            }
        } else {
            return back()->with('error', 'Data Not Found');
        }
    }
}
