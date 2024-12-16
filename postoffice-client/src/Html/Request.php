<?php

namespace App\Html;

use App\RestApiClient\Client;
use App\Database\DB;
use Exception;

class Request
{
    static function handle()
    {
        switch ($_SERVER['REQUEST_METHOD']) {
            case "POST":
                self::postRequest();
                break;
            default:
                // self::getRequest();
                break;
        }
    }

    static function postRequest()
    {
        $request = $_REQUEST;
        switch ($request) {
            case isset($request['btn-counties']):
                PageCounties::table(self::getCounties());
                break;
            case isset($request['btn-cities']):
                PageCities::table(self::getCounties());
                break;
            case isset($request['btn-del-county']):
                self::delCounty($_POST['btn-del-county']);
                break;
            case isset($request['btn-edit-county']):
                $countyData = self::GetCounty($_POST['btn-edit-county']);
                PageCounties::editCounty($countyData['name'], $countyData['id']);
                break;
            case isset($request['btn-save-county']):
                self::editCounty($_POST['id'], $_POST['name']);
                break;
            case isset($request['btn-add']):
                PageCounties::addCounty();
                break;
            case isset($request['btn-add-county']):
                self::addCounty($_POST['name']);
                break;
            case isset($request['btn-cancel-edit']):
                PageCounties::table(self::getCounties());
                break;
            case isset($request['btn-select-county']):
                $abc = self::getAbcByCities($_POST['dropdown']);
                PageCities::AbcButtons($abc);
        }
    }

    static function getCounties()
    {
        $client = new Client();
        $response = $client->getCounty('counties');
        return $response['data'];
    }

    static function getCounty($id)
    {
        $client = new Client();
        $response = $client->getCounty("counties/{$id}");
        return $response['data'];
    }

    static function getCountyByName($county)
    {
        $client = new Client();
        $response = $client->getCounty("counties");
        $datas = $response['data'];
        foreach ($datas as $data) {
            if ($data['name'] == $county) {
                $id = $data['id'];
            }
        }
        return $id;
    }

    static function delCounty($id)
    {
        $client = new Client();
        $client->deleteCounty("counties", $id);
    }

    static function editCounty($id, $name)
    {
        $client = new Client();
        $response = $client->updateCounty("counties", $id, ["name" => $name]);
        return $response['data'];
    }

    static function addCounty($name)
    {
        $client = new Client();
        $response = $client->addCounty("counties", ['name' => $name]);
        return $response['data'];
    }

    static function getABCbyCities($county)
    {
        $client = new Client();
        $data = $client->getCities("cities");
        $cities = [];
        $id = self::getCountyByName($county);
        foreach ($data['data'] as $array) {
            if ($array['id_county'] == $id) {

                $cities += $array;
            }
        }
        $abc = [];
        foreach ($cities as $city) {
            $ch = strtoupper($city['city'][0]);
            if (!in_array($ch, $abc)) {
                $abc[] = $ch;
            }
        }
        return $abc;
    }
}
