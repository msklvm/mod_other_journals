<?php
	$db = JFactory::getDbo();
	$sql = 'SELECT `name_rus`, `name_eng`, `domain` FROM `#__vestnik`';
	$db->setQuery($sql);
	$journals = $db->loadAssocList();
	$uri = JFactory::getURI()->getHost();

	// echo "<pre style='display:none'>";
	// 	print_r($journals);
	// 	echo "</pre>";

	foreach ($journals as $key => $journal) {
		if (strpos($uri, $journal['domain']) !== false) {
			$currentJournalDomain = $journal['domain'];
			unset($journals[$key]);
			break;
		}
	}

	$loc  = JFactory::getLanguage()->getTag() ;
	$lang = ($loc == 'en-GB')
		? 'eng'
		: 'rus';

		if ($loc == 'en-GB') {
			$uri = $uri.'/en';
		} else {
			$uri = $uri.'/ru';
		}

	foreach ($journals as $journal) {
		sprintf('<div class="tile thumb"><a href="http://%s/" target="_blank" title="%s"><img src="images/stories/%s/issue.png"></a></div>',
			str_replace($currentJournalDomain, $journal['domain'], $uri),
			$journal['name_'.$lang],
			$journal['domain']);
	}
?>