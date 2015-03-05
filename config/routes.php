<?php

Map::get('/', 'welcome#index');

Map::get('/blog/:id/index', 'blog#index');

Map::get('/products/:id/show/:year', 'products#show');

/**
*	//Example map of route	
*
*	Map::get('/', 							'welcome#index');
*
*	Map::get('/login',						'users#login');
*
*	Map::get('/products/:id/show',			'products#show');
*
*	Map::get('/products/:id/edit',			'products#edit');
*
*	Map::get('/products/:id/:year',			'products#show_per_year');
*
*	Map::get('/products/:id/year/:year',	'products#show_per_text_year');
*
*	Map::resources('products');
*
*/
	
?>