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
if ($journal_host == 'vestnik.tspu.edu.ru') {
    $journal_replace = $journals[0];
    $journals[0] = $journals[4];
    $journals[4] = $journal_replace;
} elseif ($journal_host == 'edujournal.tspu.edu.ru'){
    $journal_replace = $journals[0];
    $journals[0] = $journals[3];
    $journals[3] = $journal_replace;
} elseif ($journal_host == 'npo.tspu.edu.ru') {
    $journal_replace = $journals[0];
    $journals[0] = $journals[3];
    $journals[3] = $journal_replace;
    $journal_replace = $journals[2];
    $journals[2] = $journals[4];
    $journals[4] = $journal_replace;
} elseif ($journal_host == 'ling.tspu.edu.ru') {
    $journal_replace = $journals[1];
    $journals[1] = $journals[3];
    $journals[3] = $journal_replace;
    $journal_replace = $journals[2];
    $journals[2] = $journals[4];
    $journals[4] = $journal_replace;
} elseif ($journal_host == 'praxema.tspu.edu.ru') {
    $journal_replace = $journals[0];
    $journals[0] = $journals[3];
    $journals[3] = $journal_replace;
    $journal_replace = $journals[1];
    $journals[1] = $journals[4];
    $journals[4] = $journal_replace;
}
	foreach ($journals as $journal) {
		printf('<div class="tile thumb"><a href="http://%s/" target="_blank" title="%s"><img src="images/stories/%s/issue.png"></a></div>',
			str_replace($currentJournalDomain, $journal['domain'], $uri),
			$journal['name_'.$lang],
			$journal['domain']);
	}
?>