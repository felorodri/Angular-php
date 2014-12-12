<?php
include_once 'vendor/autoload.php';
$f3 = \Base::instance();

$f3->set('DEBUG',1);
if ((float)PCRE_VERSION<7.9)
	trigger_error('PCRE version is out of date');

$f3->config('config.ini');

$f3->route('GET /',
	function($f3) {
		
	}
);

$f3->theProjects = array(
				array( 'name'=>'Project X', 'description' => 'Lorem ipsum dolor amet' ),
				array( 'name'=>'Project Y', 'description' => 'Lorem ipsum dolor amet' ),
				array( 'name'=>'Project Z', 'description' => 'Lorem ipsum dolor amet' ),
				array( 'name'=>'Project W', 'description' => 'Lorem ipsum dolor amet' ),
				array( 'name'=>'Project S', 'description' => 'Lorem ipsum dolor amet' ),
				array( 'name'=>'Project R', 'description' => 'Lorem ipsum dolor amet' )
			);

$f3->route('GET /projects',
	function($f3) {
		$projects = array('data' => $f3->theProjects );

		echo json_encode($projects);
	}
);

$f3->route('GET /projects/@id',
	function($f3) {
		$params = $f3->get('PARAMS');
		$project = array('data' => $f3->theProjects[ $params['id'] + 1 ] );

		echo json_encode($project);
	}
);

$f3->route('GET /user/@id',
	function($f3) {
		$params = $f3->get('PARAMS');

		$user = array('data' => array(
				 'id' => $params['id'],
				 'name'=>'Julian', 
				 'college' => 'Universidad del Valle',
				 'city' => 'Santiago de Cali' 
				)
			);

		echo json_encode($user);
	}
);

$f3->route('\DELETE /user/@id', function ($f3){
	
});

$f3->route('PUT /user/@id', function($f3){
		
		$values = $f3->get('BODY');
		$values = json_decode($values);

		$values->name = $values->name . " new name";

		echo json_encode(array(
			'message' => 'Your data have been updated',
			'data' => $values
			));

	});

$f3->run();
