
<?
require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';
CModule::IncludeModule('iblock');
CIBlockElement::SetPropertyValuesEx($_POST['elementId'], 2, array("VOTES" => $_POST['voteValue']));
?>

