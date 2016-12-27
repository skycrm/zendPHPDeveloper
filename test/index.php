<?php
/**
 * Created by PhpStorm.
 * User: Евгения
 * Date: 19.12.2016
 * Time: 19:11
 */

ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);
$title = 'ZEND exam preparation';

require_once 'Parser.php';

$parserObj = new Parser('test.txt');
$parserObj->parseQuestions();

if (isset($_GET['question'])) {
    $currentQuestion = intval($_GET['question']);
} else {
    $currentQuestion = 1;
}

$answers = '';
foreach ($parserObj->arParsedData[$currentQuestion]['answers'] as $key => $answer) {
    if ($answer != "")
        $answers .= $key . '. ' . $answer . '</br>';
}

$content = '
<div class="row">
    <div class="col s12 m12">
        <div class="card yellow lighten-3">
            <div class="card-content">
                <span class="card-title"><i class="material-icons">question answer</i> Question #' . $currentQuestion . '</span>
                <div class="card-panel grey lighten-5 z-depth-1">
                    <div class="row valign-wrapper">
                        <div class="col s12">
                            <h5>' . $parserObj->arParsedData[$currentQuestion]['question'] . '</h5>
                            ' . $answers . '
                                <ul class="collapsible" data-collapsible="accordion">
                                    <li>
                                        <div class="collapsible-header"><i class="material-icons">done</i>Correct answer</div>
                                        <div class="collapsible-body"><p>'.$parserObj->arParsedData[$currentQuestion]['correct'].'</p></div>
                                    </li>
                                    <li>
                                        <div class="collapsible-header"><i class="material-icons">subject</i>whole question text</div>
                                        <div class="collapsible-body"><p>'.$parserObj->arParsedData[$currentQuestion]['all'].'</p></div>
                                    </li>
                                </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
         <a class="waves-effect waves-light btn-large"  href="?question=' . ($currentQuestion - 1) . '"><i class="material-icons right">chevron_left</i>previous</a>
         <a class="waves-effect waves-light btn-large"  href="?question=' . ($currentQuestion + 1) . '">next<i class="material-icons right">chevron_right</i></a>
    </div>
</div>
';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <title><?= $title ?></title>

    <!-- CSS -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="css/range/nouislider.css" type="text/css" rel="stylesheet" media="screen,projection"/>

    <!--  Scripts-->
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/materialize.js"></script>

    <script type="text/javascript" src="js/jquery.canvasjs.min.js"></script>
    <script src="js/init.js"></script>

    <script src="js/range/nouislider.js"></script>
    <script src="js/range/wNumb.js"></script>
    <script src="js/range/range.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.collapsible').collapsible();
        });
    </script>

</head>
<body>
<nav class="purple lighten-1" role="navigation">
    <div class="nav-wrapper container"><a id="logo-container" href="/zendStudy/test/?q=1"
                                          class="brand-logo"><?= $title ?></a>
        <ul class="right hide-on-med-and-down">
            <li><a id="refreshData" href="answerList/">Список ответов</a></li>
        </ul>

        <ul id="nav-mobile" class="side-nav">
            <li><a id="refreshData" href="answerList/">Список ответов</a></li>
        </ul>
        <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>
</nav>

<div class="container">
    <div class="section">
        <div class="row">
            <?= $content ?>
        </div>
    </div>
</div>

<footer class="page-footer grey darken-1">
    <div class="footer-copyright">
        <div class="container">
            Made for pass ZENDexam Autor: Ivan Smirnov
        </div>
    </div>
</footer>

</body>
</html>
