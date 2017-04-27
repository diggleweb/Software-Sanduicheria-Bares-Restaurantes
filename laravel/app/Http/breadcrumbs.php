<?php

// Home
Breadcrumbs::register('home', function($breadcrumbs)
{
    $breadcrumbs->push('Home', route('home'));
});

//administrador
Breadcrumbs::register('administrador', function($breadcrumbs)
{
	$breadcrumbs->parent('home');
    $breadcrumbs->push('Administrador', route('administrador'));
});

/* Produtos */
Breadcrumbs::register('listarProdutos', function($breadcrumbs)
{
	$breadcrumbs->parent('administrador');
    $breadcrumbs->push('Produtos', route('listarProdutos'));
});

Breadcrumbs::register('editarProduto', function($breadcrumbs)
{
	$breadcrumbs->parent('listarProdutos');
    $breadcrumbs->push('Editar Produto', route('editarProduto'));
});

Breadcrumbs::register('novoProduto', function($breadcrumbs)
{
	$breadcrumbs->parent('listarProdutos');
    $breadcrumbs->push('Novo Produto', route('novoProduto'));
});

/* Itens */
Breadcrumbs::register('listarItens', function($breadcrumbs)
{
	$breadcrumbs->parent('administrador');
    $breadcrumbs->push('Itens', route('listarItens'));
});

Breadcrumbs::register('editarItem', function($breadcrumbs)
{
	$breadcrumbs->parent('listarItens');
    $breadcrumbs->push('Editar Item', route('editarItem'));
});

Breadcrumbs::register('novoItem', function($breadcrumbs)
{
	$breadcrumbs->parent('listarItens');
    $breadcrumbs->push('Novo Item', route('novoItem'));
});

/* Contas encerradas */
Breadcrumbs::register('contasEncerradas', function($breadcrumbs)
{
	$breadcrumbs->parent('administrador');
    $breadcrumbs->push('Contas Encerradas', route('contasEncerradas'));
});

/* Funcionarios */
Breadcrumbs::register('listarFuncionarios', function($breadcrumbs)
{
	$breadcrumbs->parent('administrador');
    $breadcrumbs->push('Funcionários', route('listarFuncionarios'));
});

Breadcrumbs::register('editarFuncionario', function($breadcrumbs)
{
	$breadcrumbs->parent('listarFuncionarios');
    $breadcrumbs->push('Editar Funcionário', route('editarFuncionario'));
});

Breadcrumbs::register('novoFuncionario', function($breadcrumbs)
{
	$breadcrumbs->parent('listarFuncionarios');
    $breadcrumbs->push('Novo Funcionário', route('novoFuncionario'));
});

/* Usuários */
Breadcrumbs::register('listarUsuarios', function($breadcrumbs)
{
	$breadcrumbs->parent('administrador');
    $breadcrumbs->push('Usuários', route('listarUsuarios'));
});

Breadcrumbs::register('editarUsuario', function($breadcrumbs)
{
	$breadcrumbs->parent('listarUsuarios');
    $breadcrumbs->push('Editar Usuário', route('editarUsuario'));
});




