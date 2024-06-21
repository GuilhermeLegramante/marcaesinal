<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Table Columns
    |--------------------------------------------------------------------------
    */

    'column.name' => 'Nome',
    'column.guard_name' => 'Guard',
    'column.roles' => 'Perfis de Usuário',
    'column.permissions' => 'Permissões',
    'column.updated_at' => 'Alterado em',

    /*
    |--------------------------------------------------------------------------
    | Form Fields
    |--------------------------------------------------------------------------
    */

    'field.name' => 'Nome',
    'field.guard_name' => 'Guard',
    'field.permissions' => 'Permissões',
    'field.select_all.name' => 'Selecionar todos',
    'field.select_all.message' => 'Habilitar todas as permissões para esse perfil',

    /*
    |--------------------------------------------------------------------------
    | Navigation & Resource
    |--------------------------------------------------------------------------
    */

    'nav.group' => 'Configurações',
    'nav.role.label' => 'Perfis de Usuário',
    'nav.role.icon' => 'heroicon-o-shield-check',
    'resource.label.role' => 'Perfil de Usuário',
    'resource.label.roles' => 'Perfis de Usuário',

    /*
    |--------------------------------------------------------------------------
    | Section & Tabs
    |--------------------------------------------------------------------------
    */
    'section' => 'Entidades',
    'resources' => 'Recursos',
    'widgets' => 'Widgets',
    'pages' => 'Páginas',
    'custom' => 'Permissões customizadas',

    /*
    |--------------------------------------------------------------------------
    | Messages
    |--------------------------------------------------------------------------
    */

    'forbidden' => 'Você não tem permissão para acessar',

    /*
    |--------------------------------------------------------------------------
    | Resource Permissions' Labels
    |--------------------------------------------------------------------------
    */

    'resource_permission_prefixes_labels' => [
        'view' => 'Visualizar',
        'view_any' => 'Visualizar Todos',
        'create' => 'Criar',
        'update' => 'Editar',
        'delete' => 'Excluir',
        'delete_any' => 'Excluir Todos',
        'force_delete' => 'Forçar Exclusão',
        'force_delete_any' => 'Forçar Exclusão de Todos',
        'restore' => 'Restaurar',
        'reorder' => 'Reordenar',
        'restore_any' => 'Restaurar Todos',
        'replicate' => 'Replicar',
    ],
];
