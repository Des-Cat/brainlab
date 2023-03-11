<?php

/* Start Clear Header */
remove_action ('wp_head', 'rsd_link');
remove_action( 'wp_head', 'wlwmanifest_link');


/* Connect Site Scripts */
add_action( 'wp_enqueue_scripts', 'site_scripts' );
function site_scripts () {
	$version = '0.01';
	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'wp-block-library-theme' );
	wp_dequeue_style( 'wc-block-style' ); // Remove WooCommerce block CSS
	wp_deregister_script('wp-embed');
}

/* New Post Type Registration */
add_action( 'init', 'register_post_types' );
function register_post_types() {

	register_post_type('tour', [
		'labels' => [
			'name'               => 'Туры', // основное название для типа записи
			'singular_name'      => 'Тур', // название для одной записи этого типа
			'add_new'            => 'Добавить тур', // для добавления новой записи
			'add_new_item'       => 'Добавление тура', // заголовка у вновь создаваемой записи в админ-панели.
			'edit_item'          => 'Редактирование тура', // для редактирования типа записи
			'new_item'           => 'Новый тур', // текст новой записи
			'view_item'          => 'Смотреть тур', // для просмотра записи этого типа.
			'search_items'       => 'Искать тур', // для поиска по этим типам записи
			'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
			'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
			'menu_name'          => 'Туры', // название меню
		],
		'menu_icon'          => 'dashicons-palmtree',
		'public'             => true,
		'menu_position'      => 5,
		'supports'           => ['title', 'thumbnail', 'excerpt'],
		'has_archive'        => true,
		'has_excerpt'        => false,
	] );

	register_taxonomy('tour-categories', 'tour', [
		'labels'        => [
			'name'                        => 'Категории туров',
			'singular_name'               => 'Категория тура',
			'search_items'                =>  'Искать категории',
			'popular_items'               => 'Популярные категории',
			'all_items'                   => 'Все категории',
			'edit_item'                   => 'Изменить категорию',
			'update_item'                 => 'Обновить категорию',
			'add_new_item'                => 'Добавить новую категорию',
			'new_item_name'               => 'Новое название категории',
			'separate_items_with_commas'  => 'Отделить категории запятыми',
			'add_or_remove_items'         => 'Добавить или удалить категорию',
			'choose_from_most_used'       => 'Выбрать самую популярную категорию',
			'menu_name'                   => 'Категории',
		],
		'hierarchical'  => true,
	]);

}

require_once( 'inc/Custom_DB_Handler.php' );
