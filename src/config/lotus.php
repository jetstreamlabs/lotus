<?php

/*
 * Lotus Package for ADR, Inertia, Snowflake support in Laravel ^8.*
 * --------------------------------------------------------------------------
 * Copyright (c) Jetstream Labs, LLC. - All Rights Reserved.
 * Licensed under the MIT License (MIT) - https://opensource.org/licenses/MIT
 * Maintained by secondmanveran - Queen Creek, AZ USA
 */

return [
	'allowed' => [
		'actions' => [
			'__construct', '__invoke',
		],
		'responders' => [
			'send', 'make',
		],
	],
	'responder' => \App\Domain\Contracts\VueResponderInterface::class,
	'pages'     => [
		'path' => env('PAGE_PATH', 'resources/content/pages'),
	],
	'collections' => [
		'path' => env('COLLECTION_PATH', 'resources/content/collections'),
	],
];
