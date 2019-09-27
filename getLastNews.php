<?function getFeeds() 
{

	$url = "https://lenta.ru/rss";
	$content = file_get_contents($url);
	$items = new SimpleXmlElement($content);
	return ($items);
}
?>
<?$news = getFeeds();	$count = 0;?>
<ul>
	<?foreach ($news->channel->item as $item):?> 

	<li>
		<a href="<?=$item->link?>"><?=$item->title?></a>
		<p>
			<?=$item->description?>
		</p>
	</li>
	<?$count++;
	if($count==6)
	{
		break;	
	}
	?>
}
<?endforeach?>
</ul>
