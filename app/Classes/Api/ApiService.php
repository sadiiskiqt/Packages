<?php

namespace App\Classes\Api;

use Illuminate\Http\Request;


class ApiService extends ApiRepository
{

    public function apiCall($sPackageName)
    {
        $init = curl_init();

        curl_setopt($init, CURLOPT_URL, "https://packagist.org/search.json?q=" . $sPackageName);
        curl_setopt($init, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($init, CURLOPT_SSL_VERIFYPEER, false);
        $json = curl_exec($init);

        if (curl_exec($init) === false) {
        } else {
            $results = json_decode($json, true);
            if (!empty($results['results'])) {
                foreach ($results['results'] as $result) {
                    $this->saveData(
                        $result['name'],
                        $result['description'],
                        $result['repository'],
                        $result['downloads'],
                        $result['favers'],
                        $results['total']
                    );
                }

            }
        }

        curl_close($init);
    }

    /**
     * @param Request $oRequest
     * @return mixed
     */
    public function packageDistributor(Request $oRequest)
    {
        $aRules = array('packageName' => 'required|Min:2|Max:50',);

        $oValidate = \Validator::make($oRequest->all(), $aRules);
        if (!$oValidate->passes()) {
            return false;
        } else {
            $sPackageName = $oRequest->input('packageName');
            $aPackages = $this->getPackage($sPackageName);

            if (!empty($aPackages)) {
                return $aPackages;
            } else {
                $this->apiCall($sPackageName);
                return $this->getPackage($sPackageName);
            }
        }
    }

}