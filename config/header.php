<?php
return [
    'user' => [
        ['title' => 'ダッシュボード', 'route' => 'dashboard'],
		['title' => '発注ページ', 'route' => 'order.create'],
		['title' => '履歴',  'route' => 'order.history'],


    ],
    'coordinator' => [
        ['title' => 'ダッシュボード', 'route' => 'coordinator.dashboard'],
        ['title' => '受注ページ',  'route' => 'coordinator.orders'],
        ['title' => '履歴',  'route' => 'coordinator.history'],
    ],
    'area_manager' => [
        ['title' => 'ダッシュボード', 'route' => 'coordinator.dashboard'],
        ['title' => '受注ページ',  'route' => 'coordinator.orders'],
        ['title' => '履歴',  'route' => 'coordinator.history'],
    ],
];