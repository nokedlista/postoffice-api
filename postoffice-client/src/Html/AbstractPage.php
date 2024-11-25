<?php
namespace App\Html;

use App\Interfaces\PageInterface;

abstract class AbstractPage implements PageInterface 
{
    static function head()
    {
        echo '
        <!doctype html>
        <html lang="hu-hu">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
 
            <title>REST API ügyfél</title>
            <link rel="stylesheet" href="fontawesome\css\all.css">
            <!--Scripts-->
            <script src="js/js.js" type="text/javascript"></script>
            <script src="js/app.js" type="text/javascript"></script>
 
        </head>';
    }

    static function nav() 
    {
        echo '
        <nav>
            <form name="nav" method="post" action="index.php">
                <button type="submit" name="btn-home">Kezdőlap</button>
                <button type="submit" name="btn-counties">Megyék</button>
                <button type="submit" name="btn-cities">Városok</button>
            </form>
        </nav>
        ';
    }

    static function footer() 
    {
        echo'
        <footer>
            
        </footer>
        </html>
        ';
    }

    abstract static function tableHead();

    abstract static function tableBody(array $entities);

    abstract static function table(array $entities);

    static function searchBar() 
    {
        echo'
        <form method="post" action"">
            <input
                type="search"
                name="needed"
                placeholder="keres"
            >
            <button
                type="submit"
                id="btn-search"
                
        ';
    }
}