<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\Api\ApiService as ApiService;

class ApiController extends Controller
{
    /**
     * @var ApiService
     */
    public $oApiService;

    /**
     * ApiController constructor.
     * @param ApiService $oApiService
     */
    public function __construct(ApiService $oApiService)
    {
        $this->oApiService = $oApiService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('welcome');
    }


    public function findPackage(Request $oRequest)
    {
        $aResults = $this->oApiService->packageDistributor($oRequest);
        return \View::make('Table.Table')->with('aResults', $aResults);
    }
}
