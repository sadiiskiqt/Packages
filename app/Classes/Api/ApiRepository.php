<?php

namespace App\Classes\Api;


class ApiRepository
{

    private $packages_name = 'packages_name';

    protected function saveData($sName, $sDescription, $sRepository, $iDownloads, $iFavers, $iTotal)
    {
        \DB::table($this->packages_name)->insert(
            array(
                'name' => $sName,
                'description' => $sDescription,
                'repository' => $sRepository,
                'downloads' => $iDownloads,
                'favers' => $iFavers,
                'total' => $iTotal,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            )
        );
    }

    /**
     * @param $sPackageName
     * @return mixed
     */
    protected function getPackage($sPackageName)
    {
        $oResult = \DB::table($this->packages_name)
            ->where('name', 'LIKE', '%' . $sPackageName . '%')
            ->get();

        return $aResult = (!empty($oResult)) ? $oResult->toArray() : false;
    }

}