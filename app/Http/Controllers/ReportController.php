<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Report;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view_all', Report::class);
        return Report::paginate();
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
    public function store(Request $request)
    {
        $this->authorize('create', Report::class);

        $reportIn = json_decode($request->input('data'));
        
        if($reportIn) {
            $report = new Report;
        
            $report->reporter_id = $reportIn->reporter_id;
            $report->reportee_id = $reportIn->reportee_Id;
            $report->title = $reportIn->title;
            $report->content = $reportIn->content;

            $report->save();

            return UtilityController::GeneralResponse("success", $report);

        } else {
            return UtilityController::GeneralResponse("failed", 'data not well formed');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $report = Report::find($id);
        if($report) {
            $this->authorize('view', $report);
            return UtilityController::GeneralResponse('success', $report);
        } else {
            return UtilityController::GeneralResponse('failed', "");
        }
        
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
    public function update(Request $request, $id)
    {
        if($reportIn) {
            $report = Report::find($id);
    
            if (!$report) {
                return UtilityController::GeneralResponse("failed", 'report does not exist');
            }

            $this->authorize('update', $report);

            $report->reporter_id = $reportIn->reporter_id;
            $report->reportee_id = $reportIn->reportee_Id;
            $report->title = $reportIn->title;
            $report->content = $reportIn->content;

            $report->save();

            return UtilityController::GeneralResponse("success", $report);

        } else {
            return UtilityController::GeneralResponse("failed", 'data not well formed');
        }
    }

    public function delete($id) {
        $report = Report::find($id);
        if($report) {
            $this->authorize('delete', $report);
            $report->delete();
            return UtilityController::GeneralResponse('success', 'Report deleted succesfully');
        } else {
            return UtilityController::GeneralResponse('failed', 'Report not found');
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
        //
    }
}
