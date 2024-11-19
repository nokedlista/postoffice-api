<?php
namespace App\Html;

use App\RestApiClient\Client;
use App\Database\DB;

class Request
{
    static function handle() 
    {
        switch($_SERVER['REQUEST_METHOD'])
        {
            case "POST": 
                self::postRequest();
                break;
            case "GET": 
                //self::getRequest();
            default:
                // self::getRequest();
                break;
        }
    }

    static function postRequest()
    {
        $request = $_REQUEST;
        switch($request)
        {
            case isset($request['btn-counties']):
                PageCounties::table(self::getCounties());
                break;
            case isset($request['btn-del-county']):
                self::delCounty($_POST['btn-del-county']);
                break;
            case isset($request['btn-edit-county']):
                echo "anyad";
                var_dump($_POST);
                die;
                self::modCounty($_POST['btn-edit-county']);
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
        $query = "DELETE FROM counties WHERE id={$id}";
        $Db = new DB();
        $Db->mysqli->query($query);
    }

    static function modCounty($id)
    {
        $name = self::getCounty($id);
        var_dump($name);
        die;
        PageCounties::modName($name['name']);
    }
}