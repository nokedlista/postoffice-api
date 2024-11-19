<?php
namespace App\Html;

class PageCounties extends AbstractPage
{
    static function table(array $entities)
    {
        echo "<h1>Megyék</h1>";
        // self::searchBar();
        echo "<table id='counties-table'>";
        self::tableHead();
        self::tableBody($entities);
        echo "</table>";

    }

    static function tableHead()
    {
        echo "
        <thead>
            <tr>
                <th class='id-col'>#</th>
                <th>Megnevezés</th>
                <th style='float: right; display: flex'>
                    Művelet&ndsp;
                    <button id='btn-add' title='Új'>+</button>
        ";
        echo "
                </th>
            </tr>
        </thead>";
    }

    static function editor()
    {
        echo "
                <th>&ndsp;</th>
                <th>
                    <form name='county-editor' method='post' action=''>
                        <input type='hidden' id='id' name='id'>
                        <input type='search' id='name' name='name' placeholder='Megye' required>
                        <button type='submit' id='id-save-county' name='btn-save-county' title='Ment'>Mentés</button>
                        <button type='button' id='btn-cancel-county' title='Mégese'>Mégse</button>
                    </form>
                </th>

                <th class='felx'>
                &ndsp
                </th>
        ";
    }

    static function tableBody(array $entities)
    {
        echo "<tbody>";
        $i = 0;
        foreach ($entities as $entity){
            $onClick = sprintf('btnEditCountyOnClick($d, "$s")', $entity['id'], $entity['name']);
            echo"
            <tr class='". (++$i % 2 ? "odd" : "even") , "'>
                <td>{$entity['id']}</td>
                <td>{$entity['name']}</td>
                <td class='flex float-right'>
                    <form method='post' action=''>
                        <button type='button'
                            id='btn-edit-{$entity['id']}'
                            name='btn-edit-county'
                            value='{$entity['id']}'
                            title='Módosít'>
                            Módosít
                            <i class='fa fa-edit'></i>
                        </button>
                    </form>
                    <form method='post' action=''>
                        <button type='submit'
                            id='btn-del-county-{$entity["id"]}'
                            name='btn-del-county'
                            value='{$entity['id']}'
                            title='Töröl'>Töröl
                            <i class='fa fa-trash'></i>
                        </button>
                    </form>

                </td>
            </tr>";
        }
    }

    static function modName($name)
    {
        echo "
        <td class='flex float-right'>
                    <form method='post' action=''>
                        <input type='text' name='mod' value='{$name}'>
                        <button type='button'
                            id='btn-edit'
                            name='btn-edit-county-submit'
                            value=''
                            title='Módosít'>
                            Módosít
                            <i class='fa fa-edit'></i>
                        </button>
                    </form>
        ";
    }
}