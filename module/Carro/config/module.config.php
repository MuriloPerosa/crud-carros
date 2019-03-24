<?php

namespace Carro;

use Zend\ServiceManager\Factory\InvokableFactory;

return [

	'router' => [
		'routes' => [
			'carro' => [
				'type' => \Zend\Router\Http\Segment::class,
				'options' => [
					'route' => '/carro[/:action[/:id]]',
					'constraints' => [
						'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
						'id' => '[0-9]+'
					],
					'defaults' => [
						'controller' => Controller\CarroController::class,
						'action' => 'index',
					],
				],
			],
		],
	],
	'controllers' => [
		'factories' => [
			// Controller\CarroController::class => InvokableFactory::class,
		],
	],
	'view_manager' => [
        'template_path_stack' => [
           'carro' => __DIR__ . '/../view',
        ],
    ],
    'db' => [
    	'driver' => 'Pdo_Mysql',
    	'database' => 'zendexemplo',
    	'username' => 'root',
    	'password' => '',
    	'hostname' => 'localhost'
    ],

];