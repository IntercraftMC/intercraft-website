<?php

use Jenssegers\Agent\Agent;

function isMobile() {
	static $agent;
	if (!$agent) $agent = new Agent();
	return $agent->isMobile() || $agent->isTablet();
}