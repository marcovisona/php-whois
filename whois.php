<?php
require_once 'vendor/autoload.php';

$domains = file('domains.txt');

$tlds = array('com', 'it');

echo implode("\t", $tlds) . "\n";

foreach ($domains as $sld) {
	
	$availStates = array();
	
	foreach ($tlds as $tld) {
		$sld = preg_replace('/\n/', '', $sld);
		$domainName = $sld.".".$tld;
		$domain = new Phois\Whois\Whois($domainName);
		$whois_answer = $domain->info();
		$availStates[] = strval((int)$domain->isAvailable());
	}
	echo implode("\t", $availStates) . "\t" . $sld . "\n";
}

