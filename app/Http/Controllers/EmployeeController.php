<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequests\EmployeeStoreRequest;
use App\Http\Requests\EmployeeRequests\EmployeeUpdateRequest;
use App\Models\Salary;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::with('users')->get();
        return view('hr.employee.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::doesntHave('employee')->get();
        $salaries = Salary::all();
        // $salaries = [];
        return view('hr.employee.create', compact('users', 'salaries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeStoreRequest $employeeStoreRequest)
    {
        $employee = Employee::create($employeeStoreRequest->validated());

        return redirect()->route('hr.employee.index')->with([
            'status' => 'success',
            'message' => "$employee->name employee has been successfully created"
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        $users = User::doesntHave('employee')->get();
        $salaries = Salary::all();
        return view('hr.employee.edit', compact('employee', 'users','salaries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeUpdateRequest $employeeUpdateRequest, Employee $employee)
    {
        $employee->update($employeeUpdateRequest->validated());

        return redirect()->route('hr.employee.index')->with([
            'status' => 'success',
            'message' => "$employee->name employee has been successfully updated"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return back()->with([
            'status' => 'success',
            'message' => "Employee has been successfully deleted"
        ]);
    }
}
