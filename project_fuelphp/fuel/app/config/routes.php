<?php
return array(
	'_root_'  => 'index',  // The default route
	'index/login' => 'index/login',
	'index/logout' => 'index/logout',
	'index/getBalance' => 'index/getBalance',
	'pinball/view' => 'Pinball/view',
	'record/getRecord' => 'record/getRecord',
	'record/getOldRecord' => 'record/getOneRecord',
	'record/getSomeRecord' => 'record/getSomeRecord',
	'Pinball/getBall'   => 'Pinball/game',
	'pinball/getTime'  => 'Pinball/getTime',
	'Pinball/getOneAns' => 'Pinball/selectOneAns',
	'Pinball/createBall' => 'Pinball/createBall',
	'compare/getAns' => 'compare/compareAns',
);