<?php

namespace App\Html;

use App\RestApiClient\Client;

class PageCities extends AbstractPage
{
    static function table(array $counties)
    {
        echo "<h1>Városok</h1>";
        echo "<table id='cities-table'>";
        self::selectCounty($counties);
        echo "</table>";
    }

    static function tableHead() {}

    static function selectCounty($counties)
    {
        echo "
        <form method='post'>
            <select name='dropdown'>  
                <option value='Select' selected='selected'>Select</option>}";
        foreach ($counties as $county) {

            echo "<option value='{$county["name"]}'>{$county["name"]}</option>}";
        }
        echo "
            </select>
            <button type='submit' name='btn-select-county'>Választ</button>
        </form>
        ";
    }

    static function AbcButtons($abc)
    {
        echo 'kuki';
        $result = "<form method='post'>";
        foreach ($abc as $char) {
            $result .= "
                    <button type='submit' id='abc' name='abc' value='$char'>
                    $char
                    </button>
            ";
        }
        $result .= "
        </form>";
        var_dump($result);
        echo $result;
    }

    static function tableBody(array $cities) {}
}
