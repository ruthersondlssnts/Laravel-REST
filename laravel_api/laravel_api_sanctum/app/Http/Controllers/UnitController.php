<?php

namespace App\Http\Controllers;

use App\Http\Requests\UnitRequest;
use App\Http\Resources\EmployeeResource;
use App\Http\Resources\UnitResource;
use App\Models\Employee;
use App\Models\Unit;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return Unit::find(1)->employees;one to many
        return UnitResource::collection(Unit::all());
    }

    public function getBranches($ascendants='')
    {
        $units;
        if($ascendants){
           $units= DB::select('call spGetBranches(?)',array($ascendants.','));
        }else{
            $units= DB::select('call spGetBranches(?)',array(""));
        }
        $response = 
        [
            'units' => $units,
            'ascendants' =>$ascendants?$ascendants.',':'',
        ];
        // if($ascendants!=0){
        //     $response = [
        //         'units' => Unit::where('ascendants', '=', $ascendants . ',')->get(),
        //         'ascendants' => $ascendants.',',
        //     ];
        //     return new UnitResource($response);
        // }
        // else{
            
        //     $response = [
        //         'units' => Unit::whereNull('ascendants')->get(),
        //         'ascendants' =>'',
        //     ];
        //     return new UnitResource(
        //         $response
        //     );
        // }
         return new UnitResource(
                    $response
                );
    }
    public function getBranchEmployees($id)
    {
        $unit = Unit::findOrFail($id);
        // $employees = Employee::with(['department' => function ($query) use ($unit) {
        //     $query->where('name', '=', $unit->id)->get();
        // }])->get();
        $employees = DB::table('employees')
            ->join('units', 'employees.department_id', '=', 'units.id')
            ->select('employees.id', 'employees.name', 'employees.contact', 'units.name as department', 'units.id as departmentId', 'units.ascendants as departmentAscendants')
            ->where('units.id', $unit->id)
            ->get();

        if ($employees->isEmpty()) {
            $employees = DB::table('employees')
                ->join('units', 'employees.department_id', '=', 'units.id')
                ->select('employees.id', 'employees.name', 'employees.contact', 'units.name as department', 'units.id as departmentId', 'units.ascendants as departmentAscendants')
                ->where('units.ascendants', 'like', '%' . $unit->id . '%')
                ->get();
            return new EmployeeResource($employees);
        }

        return new EmployeeResource($employees);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UnitRequest $request)
    {
        return new UnitResource(Unit::create($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $unit = Unit::findOrFail($id);
        return new UnitResource($unit);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UnitRequest $request, $id)
    {

        $unit = Unit::findOrFail($id);
        $unit->update($request->all());
        return new UnitResource($unit);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $unit = Unit::findOrFail($id);
        Unit::where('ascendants', 'LIKE', '%' . $unit->id . '%')->delete();
        $unit->delete();

        return response(null, 204);
    }
}
