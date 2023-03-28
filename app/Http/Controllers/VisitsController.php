<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\SaveVisitCountry;
use App\Services\VisitsCountProcessor;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class VisitsController extends BaseController
{

    public function __construct(
        private readonly VisitsCountProcessor $countProcessor
    )
    {
    }

    public function getCountriesVisits(): JsonResponse
    {
        $data = $this->countProcessor->getAllCountriesCount();

        return new JsonResponse($data);
    }
    public function saveVisitCountry(SaveVisitCountry $request): JsonResponse
    {
        $saved = $this->countProcessor->incrementForCountry($request->getCountryCode());

        if ($saved) {
            $code = 201;
            $data = ['message' => 'Visit info saved'];
        } else {
            $code = 500;
            $data = ['message' => 'Visit info not saved'];
        }

        return new JsonResponse($data, $code);
    }

}
