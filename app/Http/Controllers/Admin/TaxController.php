<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TaxRequest;
use App\Http\Requests\PaginateRequest;
use App\Http\Resources\TaxResource;
use App\Models\Tax;
use App\Services\TaxService;
use Exception;

class TaxController extends AdminController
{

    public TaxService $taxService;

    public function __construct(TaxService $taxService)
    {
        parent::__construct();
        $this->taxService = $taxService;
        $this->middleware(['permission:settings'])->only('show', 'store', 'update', 'destroy');
    }

    public function index(PaginateRequest $request)
    {
        try {
            return TaxResource::collection($this->taxService->list($request));
        } catch (Exception $exception) {
            return response(['status' => false, 'message' => $exception->getMessage()], 422);
        }
    }

    public function store(TaxRequest $request)
    {
        try {
            return new TaxResource($this->taxService->store($request));
        } catch (Exception $exception) {
            return response(['status' => false, 'message' => $exception->getMessage()], 422);
        }
    }

    public function update(TaxRequest $request, Tax $tax)
    {
        try {
            return new TaxResource($this->taxService->update($request, $tax));
        } catch (Exception $exception) {
            return response(['status' => false, 'message' => $exception->getMessage()], 422);
        }
    }

    public function destroy(Tax $tax)
    {
        try {
            $this->taxService->destroy($tax);
            return response('', 202);
        } catch (Exception $exception) {
            return response(['status' => false, 'message' => $exception->getMessage()], 422);
        }
    }

    public function show(Tax $tax)
    {
        try {
            return new TaxResource($this->taxService->show($tax));
        } catch (Exception $exception) {
            return response(['status' => false, 'message' => $exception->getMessage()], 422);
        }
    }
}