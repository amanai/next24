<?php
	global $actionList;
	$actionList = array(
		'IndexController'=>array(
			'actions'=>array(
				'IndexAction'=>array(
					'subactions'=>array(
						'sub1'=>array(),
						'sub2'=>array(USER_TYPE_GUEST,),
					),
					'allow'=>array(USER_TYPE_GUEST,),
				),
				'allow'=>array(USER_TYPE_GUEST,),
			),
			'allow'=>array(USER_TYPE_GUEST,),
		),
	);
?>