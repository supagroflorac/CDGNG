<?php
/**
 * index file
 *
 * @author Loris Puech
 * @author Florestan Bredow <florestan.bredow@daiko.fr>
 *
 * @version GIT: $Id$
 *
 */
namespace CDGNG;

if (!is_dir('vendor')) {
    print('Vous devez executer "composer install" dans le dossier de la Ferme.');
    exit;
}
$loader = require __DIR__ . '/vendor/autoload.php';

include "./data/actions.php";
include "./data/modalites.php";

$model = new Model("config.php");
$model->loadCalendarsList();

$view = new View($model);

$action = "";
if (isset($_POST["action"])) {
    $action = $_POST["action"];
}
switch ($action) {
    case "Show":
        if (isset($_POST["ics"])) {
            $view->showResults(
                $_POST["ics"],
                $_POST["startDate"],
                $_POST["endDate"],
                $_POST["export"]
            );
            break;
        }
        print ("Aucun fichier n'a été sélectionné");
        break;

    case "Export":
        if (isset($_POST["ics"])) {
            $view->showCsv(
                $_POST["ics"],
                $_POST["startDate"],
                $_POST["endDate"],
                $_POST["export"]
            );
            break;
        }
        print ("Aucun fichier n'a été sélectionné");
        break;

    case "Realised":
        $_POST['codes'] = array('Tous');
        if (isset($_POST["ics"])) {
            $view->showRealised($_POST["ics"], $_POST["date"]);
            break;
        }
        print ("Aucun fichier n'a été sélectionné");
        break;

    case "tableauAction":
        $view->exportTableauCDG("actions", isset($_POST["showArchived"]));
        break;

    case "tableauModalite":
        $view->exportTableauCDG("modalites");
        break;

    default:
        $view = new Views\Main($model);
        $view->show();
        break;
}
