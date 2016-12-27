<?php
/**
 * Created by PhpStorm.
 * User: Евгения
 * Date: 19.12.2016
 * Time: 18:40
 */

$files = scandir(dirname(__FILE__));
foreach ($files as $file)
{
    if(!is_dir($file))
    {
        echo "<a href='$file'>$file</a><br>";
    }
}
