<?php

namespace App\Http\Controllers\Api\V1\lettingAgent;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Agent\AgentCreateRequest;
use App\Models\Agent;
use Exception;
use Illuminate\Http\Request;

class AgentController extends Controller
{

    /**
     * Store a newly created agent in storage.
     * @param AgentCreateRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     * @throws \Exception
     */
    public function store(AgentCreateRequest $request)
    {
        try {
            $validated               = $request->validated(); // Get validated data
            $validated['ip_address'] = $request->ip();        //IP address

            $data = Agent::create($validated);
            return Helper::jsonResponse(true, 'Data Submitted successfully.', 201, $data);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'Data creation failed.', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
