<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Mesa;
use App\Cliente;
use App\Conta;
use App\Funcionario;
use App\Item;
use App\Pedido;
use App\Produto;
use App\ContasProdutos;
use App\Categoria;
use App\ProdutosItens;
use App\User;
use App\Role;



class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();
		
        $this->call('CategoriasTableSeeder');
        $this->call('MesasTableSeeder');
        $this->call('ClientesTableSeeder');
        $this->call('FuncionariosTableSeeder');
        $this->call('ProdutosTableSeeder');
        $this->call('ItensTableSeeder');
        $this->call('ProdutosItensTableSeeder');
        $this->call('RolesTableSeeder');
        $this->call('UsersTableSeeder');
	}

}

class CategoriasTableSeeder extends Seeder {
    public function run() {
        DB::table('categorias')->delete();
        
        Categoria::create(array(
            'nome' => 'sanduiches'
        ));

        Categoria::create(array(
            'nome' => 'bebidas'
        ));

        Categoria::create(array(
            'nome' => 'porcoes'
        ));

        Categoria::create(array(
            'nome' => 'pratos'
        ));

    }
}

class RolesTableSeeder extends Seeder {
    public function run() {
        DB::table('roles')->delete();
        
        Role::create(array(
            'name' => 'nenhum',
            'display_name' => 'Nenhum',
            'description' => 'Não faz nada'
        ));

        Role::create(array(
            'name' => 'cozinha',
            'display_name' => 'Cozinha',
            'description' => 'Trabalha na cozinha'
        ));

        Role::create(array(
            'name' => 'administrador',
            'display_name' => 'Administrador',
            'description' => 'Chefe ou gerente'
        ));

        Role::create(array(
            'name' => 'garcom',
            'display_name' => 'Garçom',
            'description' => 'Acesso à área de garçom'
        ));

        Role::create(array(
            'name' => 'atendente',
            'display_name' => 'Atendente',
            'description' => 'Acesso à área de atendentes'
        ));

    }
}


class UsersTableSeeder extends Seeder {
    public function run() {
        DB::table('users')->delete();
        
        User::create(array(
            'login' => 'admin',
            'password' => bcrypt('admin')
        ));

    }
}

class MesasTableSeeder extends Seeder {

    public function run()
    {
        DB::table('mesas')->delete();

        //preenche as mesas (de 1 até 8)
        for ($i = 1 ; $i <= 8 ; $i++) {
        	Mesa::create(array('numero' => $i));
        }

    }

}

class ClientesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('clientes')->delete();

        Cliente::create(array(
        	'nome' => 'Maria Ferreira',
        	'telefone' => '(62) 8190-2093',
        	'endereco' => 'Rua Borgeas N 23 St. Bela Vista'
        ));

        Cliente::create(array(
            'nome' => 'Juliana Borges',
            'telefone' => '(62) 8190-2030',
            'endereco' => 'Rua Teste N St. Bueno'
        ));

    }

}



class FuncionariosTableSeeder extends Seeder {

    public function run()
    {
        DB::table('funcionarios')->delete();

        Funcionario::create(array(
        	'nome' => 'Josair Franco Borges',
        	'salario' => 1025.00,
        	'cargo' => 'garcom',
            'produtosVendidos' => 0,
            'ativo' => true,
        	'gerente' => 0
        ));

        Funcionario::create(array(
            'nome' => 'Lorenço Pereira',
            'salario' => 1025.00,
            'cargo' => 'garcom',
            'produtosVendidos' => 0,
            'ativo' => true,
            'gerente' => 0
        ));

        Funcionario::create(array(
            'nome' => 'Bolsonaro Abreu',
            'salario' => 1025.00,
            'cargo' => 'garcom',
            'produtosVendidos' => 0,
            'ativo' => true,
            'gerente' => 0
        ));

        Funcionario::create(array(
            'nome' => 'Marco Lopes Barbosa',
            'salario' => 7025.00,
            'cargo' => 'Gerente supervisor',
            'produtosVendidos' => 0,
            'ativo' => true,
            'gerente' => 1
        ));

    }
}

class ItensTableSeeder extends Seeder {
    public function run() {
        DB::table('items')->delete();

        Item::create(array(
            'nome' => 'bacon',
            'precoCompra' => 0.50,
            'precoVenda' => 1.50,
            'urlImagem' => 'imagens/itens/bacon.jpg',
            'ativo' => 1
        ));

        Item::create(array(
            'nome' => 'presunto',
            'precoCompra' => 0.50,
            'precoVenda' => 1.50,
            'urlImagem' => 'imagens/itens/presunto.jpg',
            'ativo' => 1
        ));

         Item::create(array(
            'nome' => 'cheddar',
            'precoCompra' => 0.50,
            'precoVenda' => 1.50,
            'urlImagem' => 'imagens/itens/cheddar.png',
            'ativo' => 1
        ));

         Item::create(array(
            'nome' => 'salsicha',
            'precoCompra' => 0.50,
            'precoVenda' => 1.50,
            'urlImagem' => 'imagens/itens/salsicha.jpg'
        ));

         Item::create(array(
            'nome' => 'Mussarela',
            'precoCompra' => 0.50,
            'precoVenda' => 1.50,
            'urlImagem' => 'imagens/itens/mussarela.jpg'
        ));

         Item::create(array(
            'nome' => 'Tomate',
            'precoCompra' => 0.50,
            'precoVenda' => 1.50,
            'urlImagem' => 'imagens/itens/tomate.jpg',
            'ativo' => 1
        ));

         Item::create(array(
            'nome' => 'Alface',
            'precoCompra' => 0.50,
            'precoVenda' => 1.50,
            'urlImagem' => 'imagens/itens/alface.jpg',
            'ativo' => 1
        ));

         Item::create(array(
            'nome' => 'cebola',
            'precoCompra' => 0.50,
            'precoVenda' => 1.50,
            'urlImagem' => 'imagens/itens/cebola.jpg',
            'ativo' => 1
        ));

         Item::create(array(
            'nome' => 'pao',
            'precoCompra' => 0.50,
            'precoVenda' => 1.50,
            'urlImagem' => 'imagens/itens/paohamburger.jpg',
            'ativo' => 1
        ));
    }
}

class ProdutosTableSeeder extends Seeder {

    public function run()
    {
        DB::table('produtos')->delete();

        /* sanduiches */
        Produto::create(array(
        	'nome' => 'Frango Simples',
        	'precoCompra' => 3.53,
        	'precoVenda' => 11.50,
        	'idCategoria' => 1,
            'ativo' => true,
        	'urlImagem' => 'imagens/produtos/sanduiches/frangoSimples.jpg'
        ));

        Produto::create(array(
            'nome' => 'Filé (Pão Baguete)',
            'precoCompra' => 4.72,
            'precoVenda' => 14.50,
            'idCategoria' => 1,
            'ativo' => true,
            'urlImagem' => 'imagens/produtos/sanduiches/bagueteFile.jpg'
        ));

        Produto::create(array(
            'nome' => 'Hamburger Simples',
            'precoCompra' => 3.32,
            'precoVenda' => 10.50,
            'idCategoria' => 1,
            'ativo' => true,
            'urlImagem' => 'imagens/produtos/sanduiches/hamburgerSimples.jpg'
        ));

        Produto::create(array(
            'nome' => 'Hamburger Duplo',
            'precoCompra' => 3.80,
            'precoVenda' => 12.50,
            'idCategoria' => 1,
            'ativo' => true,
            'urlImagem' => 'imagens/produtos/sanduiches/duplo.png'
        ));

        Produto::create(array(
            'nome' => 'Cachorro Quente',
            'precoCompra' => 2.34,
            'precoVenda' => 5.20,
            'idCategoria' => 1,
            'ativo' => true,
            'urlImagem' => 'imagens/produtos/sanduiches/hotdog.jpg'
        ));

        Produto::create(array(
            'nome' => 'Sanduíche Natural',
            'precoCompra' => 2.89,
            'precoVenda' => 4.50,
            'idCategoria' => 1,
            'ativo' => true,
            'urlImagem' => 'imagens/produtos/sanduiches/natural.jpg'
        ));

        /* bebidas */
        Produto::create(array(
            'nome' => 'Coca Lata',
            'precoCompra' => 2.50,
            'precoVenda' => 4.50,
            'idCategoria' => 2,
            'ativo' => true,
            'urlImagem' => 'imagens/produtos/bebidas/coca-lata.jpg'
        ));

         Produto::create(array(
            'nome' => 'Coca Zero',
            'precoCompra' => 2.50,
            'precoVenda' => 4.50,
            'idCategoria' => 2,
            'ativo' => true,
            'urlImagem' => 'imagens/produtos/bebidas/zero-lata.jpg'
        ));

        Produto::create(array(
            'nome' => 'Guaraná Lata',
            'precoCompra' => 2.50,
            'precoVenda' => 4.50,
            'idCategoria' => 2,
            'ativo' => true,
            'urlImagem' => 'imagens/produtos/bebidas/guarana.jpg'
        ));

        Produto::create(array(
            'nome' => 'Suco del Valle',
            'precoCompra' => 1.30,
            'precoVenda' => 4.80,
            'idCategoria' => 2,
            'ativo' => true,
            'urlImagem' => 'imagens/produtos/bebidas/delvalle.jpg'
        ));

         Produto::create(array(
            'nome' => 'Suco de Laranja',
            'precoCompra' => 1.30,
            'precoVenda' => 5.80,
            'idCategoria' => 2,
            'ativo' => true,
            'urlImagem' => 'imagens/produtos/bebidas/suco-laranja.jpg'
        ));

         Produto::create(array(
            'nome' => 'Milk-Shake de Morango',
            'precoCompra' => 3.30,
            'precoVenda' => 8.80,
            'idCategoria' => 2,
            'ativo' => true,
            'urlImagem' => 'imagens/produtos/bebidas/shake-morango.jpg'
        ));

         Produto::create(array(
            'nome' => 'Milk-Shake de Chocolate',
            'precoCompra' => 3.30,
            'precoVenda' => 8.80,
            'idCategoria' => 2,
            'ativo' => true,
            'urlImagem' => 'imagens/produtos/bebidas/shake-chocolate.jpg'
        ));

        //porções
         Produto::create(array(
            'nome' => 'Pastéis de Queijo',
            'precoCompra' => 3.30,
            'precoVenda' => 8.90,
            'idCategoria' => 3,
            'ativo' => true,
            'urlImagem' => 'imagens/produtos/porcoes/pasteisqueijo.jpg'
        ));

          Produto::create(array(
            'nome' => 'Pastéis de Carne',
            'precoCompra' => 3.30,
            'precoVenda' => 8.90,
            'idCategoria' => 3,
            'ativo' => true,
            'urlImagem' => 'imagens/produtos/porcoes/pasteiscarne.jpg'
        ));

         Produto::create(array(
            'nome' => 'Batata Frita (Peq)',
            'precoCompra' => 2.50,
            'precoVenda' => 4.50,
            'idCategoria' => 3,
            'ativo' => true,
            'urlImagem' => 'imagens/produtos/porcoes/batata.jpg'
        ));

         Produto::create(array(
            'nome' => 'Batata Frita (Méd)',
            'precoCompra' => 3.50,
            'precoVenda' => 7.50,
            'idCategoria' => 3,
            'ativo' => true,
            'urlImagem' => 'imagens/produtos/porcoes/batata.jpg'
        ));

         Produto::create(array(
            'nome' => 'Batata Frita (Gd)',
            'precoCompra' => 4.50,
            'precoVenda' => 9.50,
            'idCategoria' => 3,
            'ativo' => true,
            'urlImagem' => 'imagens/produtos/porcoes/batata.jpg'
        ));


        //pratos
        Produto::create(array(
            'nome' => 'Cupim',
            'precoCompra' => 5.50,
            'precoVenda' => 12.00,
            'idCategoria' => 4,
            'ativo' => true,
            'urlImagem' => 'imagens/produtos/pratos/cupim.jpg'
        ));

        Produto::create(array(
            'nome' => 'Filé à cavalo',
            'precoCompra' => 6.50,
            'precoVenda' => 13.00,
            'idCategoria' => 4,
            'ativo' => true,
            'urlImagem' => 'imagens/produtos/pratos/fileacavalo.png'
        ));

        Produto::create(array(
            'nome' => 'Frango',
            'precoCompra' => 4.50,
            'precoVenda' => 12.00,
            'idCategoria' => 4,
            'ativo' => true,
            'urlImagem' => 'imagens/produtos/pratos/frango.jpg'
        ));

        Produto::create(array(
            'nome' => 'Salada',
            'precoCompra' => 3.50,
            'precoVenda' => 8.00,
            'idCategoria' => 4,
            'ativo' => true,
            'urlImagem' => 'imagens/produtos/pratos/salada.jpg'
        ));
    }}


class ProdutosItensTableSeeder extends Seeder {
        public function run() {
            /* itens que compõem o sanduíche simples */
            ProdutosItens::create(array(
                'produto_id' => 1,
                'item_id' => 1
            ));

            ProdutosItens::create(array(
                'produto_id' => 1,
                'item_id' => 2
            ));

            ProdutosItens::create(array(
                'produto_id' => 1,
                'item_id' => 3
            ));

            ProdutosItens::create(array(
                'produto_id' => 1,
                'item_id' => 5
            ));

            ProdutosItens::create(array(
                'produto_id' => 1,
                'item_id' => 6
            ));

            ProdutosItens::create(array(
                'produto_id' => 1,
                'item_id' => 7
            ));

            ProdutosItens::create(array(
                'produto_id' => 1,
                'item_id' => 9
            ));


            /* itens que compõem o baguete (filé) */
            ProdutosItens::create(array(
                'produto_id' => 2,
                'item_id' => 2
            ));

            ProdutosItens::create(array(
                'produto_id' => 2,
                'item_id' => 5
            ));

            ProdutosItens::create(array(
                'produto_id' => 2,
                'item_id' => 6
            ));

            ProdutosItens::create(array(
                'produto_id' => 2,
                'item_id' => 7
            ));
        }
}

