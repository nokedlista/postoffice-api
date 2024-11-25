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
                    Művelet&nbsp;
                    <form method='post' action>
                        <button id='btn-add' name='btn-add' title='Új'>+</button>
                    </form>
                </th>
            </tr>
        </thead>";
    }

    static function tableBody(array $entities)
    {
        echo "<tbody>";
        $i = 0;
        foreach ($entities as $entity) {
            $onClick = sprintf('btnEditCountyOnClick($d, "$s")', $entity['id'], $entity['name']);
            echo "
            <tr class='" . (++$i % 2 ? "odd" : "even"), "'>
                <td>{$entity['id']}</td>
                <td>{$entity['name']}</td>
                <td class='flex float-right'>
                    <form method='post' action=''>
                        <button type='submit'
                            id='btn-edit-{$entity['id']}'
                            name='btn-edit-county'
                            value='{$entity['id']}'
                            title='Módosít'>
                            <i class='fa fa-edit'></i>
                        </button> </br>
                        <button type='submit'
                            id='btn-del-county-{$entity["id"]}'
                            name='btn-del-county'
                            value='{$entity['id']}'
                            title='Töröl'>
                            <i class='fa fa-trash' style='color: red'></i>
                        </button>
                    </form>

                </td>
            </tr>";
        }
    }

    static function editCounty($name, $id)
    {
        echo "
                <th>&nbsp;</th>
                <th>
                    <form method='post' action=''>
                        <input type='hidden' id='id' name='id' value='{$id}'>
                        <input type='search' id='name' name='name' placeholder='{$name}' required>
                        </br>
                        <button type='submit' id='id-save-county' name='btn-save-county' title='Ment'>Mentés</button>
                        
                    </form>
                    <form method='post'>
                        <button type='submit' id='btn-cancel-county' name='btn-edit-cancel'>Mégse</button>
                    </form>
                </th>
        ";
    }

    static function addCounty($hibae)
    {
        if ($hibae) {
            echo "Ilyen id-jű megye már van!";
        }
        echo "
                <th>&nbsp;</th>
                <th>
                    <form name='county-editor' method='post' action=''>
                        <input type='search' id='id' name='id' placeholder='A megye id-je' required>
                        <input type='search' id='name' name='name' placeholder='A megye neve' required>
                        <button type='submit' id='btn-add-county' name='btn-add-county' title='Ment'>Mentés</button>
                        <button type='button' id='btn-cancel-county' title='Mégese'>Mégse</button>
                    </form>
                </th>

                <th class='felx'>
                &nbsp
                </th>
        ";
    }
}
