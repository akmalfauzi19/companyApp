<?php

namespace App\Http\Controllers;

use App\Models\Companies;
use App\Models\Employees;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employees::with('companies')->orderBy('id', 'DESC')->paginate(5);
        return view('pages.employees.index')->with([
            'employees' => $employees
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Companies::all()->pluck('name', 'id')->prepend(trans('Select Company'), '');
        return view('pages.employees.create')->with([
            'companies' => $companies
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $model = new Employees;
        $this->validate($request, [
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'max:255', 'unique:' . $model->getTable() . ',email'],
            'company_id' => ['required', 'integer'],
        ]);
        $data = $request->all();
        $model->create($data);

        return redirect()->route('employees.index')
            ->with('success', 'Companies Successfully Created');
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
        $employees = Employees::find($id);
        if ($employees) {
            $companies = Companies::all()->pluck('name', 'id')->prepend(trans('Select Company'), '');
            return view('pages.employees.edit')->with([
                'employees' => $employees,
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
        $employeesModel = new Employees;
        $employee = $employeesModel->find($id);
        if ($employee) {
            $this->validate($request, [
                'name' => ['nullable', 'string'],
                'email' => ['nullable', 'email', 'max:255', 'unique:' . $employeesModel->getTable() . ',email,' . $id],
                'company_id' => ['nullable', 'integer'],
            ]);

            $data = $request->all();

            $status = $employee->update($data);
            if ($status) {
                return redirect()->route('employees.index')->with('success', 'Employee Successfully Updated');
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
        $employee = Employees::find($id);
        if ($employee) {
            $status = $employee->delete();
            if ($status) {
                return redirect()->route('employees.index')->with('success', 'Companies successfully deleted');
            } else {
                return back()->with('error', 'Something went wrong!');
            }
        } else {
            return back()->with('error', 'Data Not Found');
        }
    }
}
