<?php
/*
	simplenews.php - ALPHA version
	Nathan J. Dane, 2018.
	Returns a BBC News page as an array
	
	Layout (TBC):
	Short Headline
	Description
	URL
	Area (e.g. UK)
	Summary
	paragraphs(tab seperated)
*/

require "simple_html_dom.php";

function getNews($url,$limit)
{
	$html = file_get_html($url);	// Under NO circumstances should $html be overwritten. It's here to stay.
	
	$stitle=$html->find("meta[property=og:title]",0);	// Short title
	$stitle=$stitle->content;
	$stitle=htmlspecialchars_decode($stitle);
	
	$desc=$html->find('meta[property=og:description]',0);	// Description
	$desc=$desc->content;
	$desc=htmlspecialchars_decode($desc);
	
	$area=$html->find('meta[property=article:section]',0);	// Area
	$area=$area->content;
	$area=htmlspecialchars_decode($area);
	
	$intro=$html->find('p[class=story-body__introduction]',0)->plaintext;	// Summary
	$intro=htmlspecialchars_decode($intro);
	
	$paragraph='';
	$i=0;
	$found=false;
	foreach ($html->find('p') as $para)
	{
		if($i<$limit && $found==true)
		{
			$paragraph.="$para->plaintext	";
			$i++;
		}
		if (strpos($para,"introduction"))
		$found=true;
	}
	
	//echo "$stitle\r\n$desc\r\n$url $area\r\n$intro\r\n$paragraph\r\n";
	return array($stitle,$desc,$url,$area,$intro,$paragraph);
}

print_r(getNews("http://www.bbc.co.uk/news/world-europe-44307611",4));
