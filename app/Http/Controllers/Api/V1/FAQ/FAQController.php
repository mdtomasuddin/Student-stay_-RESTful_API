<?php

namespace App\Http\Controllers\Api\V1\FAQ;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\FAQ;
use Exception;
use Illuminate\Http\Request;

class FAQController extends Controller
{
    /***
     * Retrieve the 'per_page'
     * $Request
     */
    public function index(Request $request)
    {
        try {
            $perPage       = $request->query('per_page', 50);
            $query = FAQ::where('status', 'active')->orderByDesc('id');

            $faqs = $query->paginate($perPage); //per page .
            return Helper::jsonResponse(true, 'Data retrieved successfully.', 200, $faqs, true);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'Failed to retrieve list', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Fetch the details of a specific FAQ by ID (GET).
     * $ID
     */
    public function show($id)
    {
        try {
            $faq = FAQ::find($id);
            if (! $faq) {
                return Helper::jsonResponse(false, 'FAQ not found', 404);
            }
            // Return response
            return Helper::jsonResponse(true, 'FAQ retrieved successfully.', 200, $faq);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'Failed to retrieve FAQ', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
