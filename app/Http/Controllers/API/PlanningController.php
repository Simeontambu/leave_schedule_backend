<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePlanningRequest;
use App\Models\Agents;
use App\Models\conge;
use App\Models\Motif;
use App\Models\planning;
use Exception;
use Illuminate\Http\Request;

class PlanningController extends Controller
{
    public function index()
    {
        $data = planning::all();
        
        return response()->json($data);
    }
    public function store(CreatePlanningRequest $request)
    {
        try {
            $planning = new planning();
            // check if a column exists in the related table before adding
            $agent = Agents::where('nom', $request['nom'])->first();;

            if (!$agent) {
                return [
                    "status" => 404,
                    "message" => "Filled out your fields correctly"
                ];
            }

            $planning->code_conge = $request->code_conge;
            $planning->matricule_agent = $agent->matricule_agent;
            $planning->date_depart = $request->date_depart;
            $planning->date_retour = $request->date_retour;
            $planning->save();
            return [
                "status" => 200,
                "message" => "planning added successfully",
                "planning" => $planning

            ];
        } catch (Exception $e) {
            return response()->json($e);
        }
    }
}
