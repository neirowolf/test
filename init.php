<?
function dump($var, $die = false, $all = false)
{ global $USER;
  	if( ($USER->isAdmin()) || ($all == true)) {?>
	<font style=»text-align: left; font-size: 10px;»><pre><?var_dump($var)?></pre></font><br>
	<?}
	if($die){
		die;
	}
}

AddEventHandler("iblock", "OnBeforeIBlockElementDelete", Array("MyClass", "OnBeforeIBlockElementDeleteHandler"));

class MyClass
{
    function OnBeforeIBlockElementDeleteHandler($ID)
    {
		$db_props = CIBlockElement::GetProperty(2, $ID, array("sort" => "asc"), Array("CODE"=>"VOTES"));
		$ar_props = $db_props->Fetch();
		$max = true;
		$arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_VOTES");
		$arFilter = Array("IBLOCK_ID"=> 2, "ACTIVE"=>"Y");
		$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
		while($ob = $res->GetNextElement()) {
			$arFields = $ob->GetFields();
			if ($arFields["PROPERTY_VOTES_VALUE"] > $ar_props["VALUE"]) {
				$max = false;
			}
		}
		if ($max = true) {
			$mailAdmin = COption::GetOptionString("main", "email_from");
			mail($mailAdmin, "Test", "Testtext");
		}
    }
}