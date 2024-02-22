<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCongeRequest;
use App\Models\Agents;
use App\Models\conge;
use App\Models\durer;
use App\Models\Motif;
use Exception;
use Illuminate\Http\Request;

class CongeController extends Controller
{
    // ask leave
    public function store(CreateCongeRequest $request)
    {
        try {
            $leave = new conge();
            // check if a column exists in the related table before adding
            $agent = Agents::where('nom', $request['nom'])->first();;
            $last = durer::where('libelle', $request['libelle'])->first();;
            $reason = Motif::where('libelle_motif', $request['libelle_motif'])->first();;

            if (!$agent || !$last || !$reason) {
                return [
                    "status" => 404,
                    "message" => "Filled out your fields correctly"
                ];
            }

            $leave->matricule_agent = $agent->matricule_agent;
            $leave->code_durer = $last->code_durer;
            $leave->code_motif = $reason->code_motif;
            $leave->save();
            return [
                "status" => 200,
                "message" => "Leave added successfully",
                "leave" => $leave

            ];
        } catch (Exception $e) {
            return response()->json($e);
        }
    }
}
