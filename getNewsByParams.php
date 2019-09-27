<?
class GetNews
{


	function GetNewsWithParams($IBLOCK_ID,$SECTION_ID, $SELECT, $FILTER,$SORT)
	{
		$cache = Cache::createInstance(); 
		//если для теста нужно очистить кеш $cache->clean("cache_key");
		if ($cache->initCache(3600, "CacheNews")) 
		{ 
			$vars = $cache->getVars();
			return $vars;
		}
		elseif ($cache->startDataCache()) 
		{
			$res = CIBlockElement::GetList($SORT, $FILTER, false, false, $SELECT);
			$arrRes=array();
			while($ob = $res->GetNext())
			{ 
				$arrRes[] = $ob;
			} 

			$cache->endDataCache($arrRes); 
			return $arrRes;
		}

	}

}


//Не забыть использовать кеш: use \Bitrix\Main\Data\Cache;

//пример вызова
$News = GetNews::GetNewsWithParams(3,0,Array("ID", "IBLOCK_ID", "NAME", "PROPERTY_*","PREVIEW_PICTURE","IBLOCK_SECTION_ID"),Array("ID"=>"29"),array("ID"=>"ASC"));
echo "<pre>";
var_dump($News);
echo "</pre>";
?>