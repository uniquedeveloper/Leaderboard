<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Employee;
use DB;
use Session;

class EmployeeController extends Controller
{
    /**
     * Show the list of all employees
     *
     * @param  
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('employees.list', ['employees' => Employee::all()]);
    }


    /**
     * Update details for given employee
     *
     * @param  Request
     * @param  Employee Model
     * @return String
     */
    public function edit(Request $request, Employee $employee)
    {
        try
        {
           // validate incoming request
            $validator = Validator::make($request->all(), [
               
               'points' => 'required|numeric|min:0|not_in:0',
           ]);
            
           if ($validator->fails()) {
                // Session::flash('error', $validator->messages()->first());
                return redirect()->back()->withInput();
           }

            DB::table('employees')
                  ->where('id', $request->id)
                  ->update(['points' => (int)$request->points]);
             return  'Success';

        }
        catch (Exception $e)
        {
            throw($e->getMessage());

        }
        return '';
    }


    /**
     * Create/Update details for given employee
     *
     * @param  Request
     * @param  Employee Model 
     * @return Route
     */
    public function add(Request $request, Employee $employee= null)
    {
        if(is_null($employee))
            Employee::create($request->all());
        else
            $employee->update($request->all());

        return redirect()->action([EmployeeController::class, 'index']);
    }

     /**
     * Update details for given employee
     *
     * @param  Employee Model
     * @return String
     */

    public function delete( Employee $employee= null )
    {
        $employee->delete();
        return 'Success';
    }
}