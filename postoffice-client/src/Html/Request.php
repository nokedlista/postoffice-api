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
        }
    }

    static function getCounties()
    {
        $client = new Client();
        $response = $client->get('counties');

        return $response['data'];
    }

    static function getCounty($id)
    {
        $client = new Client();
        $response = $client->get("counties/{$id}");
        return $response['data'];
    }

    static function delCounty($id)
    {
        $client = new Client();
        $response = $client->delete("counties", $id);
        return $response['data'];  
    }

    static function editCounty($id, $name)
    {
        $client = new Client();
        $response = $client->update("counties", $id, ["name"=> $name]);
        return $response['data'];
    }

    static function addCounty($name)
    {
        $client = new Client();
        $response = $client->post("counties", ['name' => $name]);
        return $response['data'];
    }
}
