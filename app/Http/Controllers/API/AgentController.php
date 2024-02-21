<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateAgentsRequest;
use App\Models\Agents;
use App\Models\direction;
use App\Models\fonction;
use Exception;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    //Retrieve some agents table data
    public function index()
    {
        $data = Agents::all();
        $data->load('fonction');
        $data->load('direction');
        $response_data = [];

        foreach ($data as $agent) {
            $agent_data = [
                "nom" => $agent->nom,
                "prenom" => $agent->prenom,
                "sexe" => $agent->sexe,
                "libelle_fonction" => $agent->fonction->libelle,
                "libelle_direction" => $agent->direction->libelle_direction,
            ];

            $response_data[] = $agent_data;
        }

        return response()->json($response_data);
    }
    //Add agent
    public function store(CreateAgentsRequest $request)
    {
        try {

            $user = new Agents();
            $user->nom = $request->nom;
            $user->postnom = $request->postnom;
            $user->prenom = $request->prenom;
            $user->adresse = $request->adresse;
            $user->telephone = $request->telephone;
            $user->sexe = $request->sexe;

            //check the label passed corresponds to the label of the function table
            $fonction = fonction::where('libelle', $request['libelle'])->first();;
            //check the label_direction passed corresponds to the label of the direction table
            $direction = direction::where('libelle_direction', $request['libelle_direction'])->first();;
            if (!$fonction || !$direction) {
                return [
                    "status" => 404,
                    "message" => "Tu dois fournir le libelle"

                ];
            }
            $user->code_fonction = $fonction->code_fonction;
            $user->code_direction = $direction->code_direction;



            $user->save();
            return [
                "status" => 200,
                "message" => "user added successfully",
                "user" => $user

            ];
        } catch (Exception $e) {
            return response()->json($e);
        }
    }
}
