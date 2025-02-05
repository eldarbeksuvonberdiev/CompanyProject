<?php

namespace App\Http\Controllers;

use App\Models\Salary;
use App\Http\Controllers\Controller;
use App\Http\Requests\SalaryRequests\SalaryStoreRequest;
use App\Http\Requests\SalaryRequests\SalaryUpdateRequest;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $salaries = Salary::all();
        return view('hr.salary.index', compact('salaries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('hr.salary.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SalaryStoreRequest $salaryStoreRequest)
    {
        $salary =  Salary::create($salaryStoreRequest->validated());

        return redirect()->route('hr.salary.index')->with([
            'status' => 'success',
            'message' => "$salary->name salary type has been successfully created"
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Salary $salary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Salary $salary)
    {
        return view('hr.salary.edit', compact('salary'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SalaryUpdateRequest $salaryUpdateRequest, Salary $salary)
    {
        $salary->update($salaryUpdateRequest->validated());

        return redirect()->route('hr.salary.index')->with([
            'status' => 'success',
            'message' => "$salary->name salary type has been successfully updated"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Salary $salary)
    {
        $salary->delete();
        return back()->with([
            'status' => 'danger',
            'message' => "$salary->name has been successfully deleted"
        ]);
    }
}
