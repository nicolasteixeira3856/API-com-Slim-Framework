<?php 
    use Psr\Http\Message\ServerRequestInterface as Request;
    use Psr\Http\Message\ResponseInterface as Response;
    use Illuminate\Database\Capsule\Manager as Capsule;

    require 'vendor/autoload.php';

    $app  = new \Slim\App([
        'settings' => [
            'displayErrorDetails' => true
        ]
    ]);

    //Banco de Dados
    $container = $app->getContainer();
    $container['db'] = function(){
        $capsule = new Capsule;
        $capsule->addConnection([
            'driver'    => 'mysql',
            'host'      => 'localhost',
            'database'  => 'slim',
            'username'  => 'root',
            'password'  => '',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ]); 

        $capsule->setAsGlobal();
        //Setup the Eloquent ORM...
        $capsule->bootEloquent();

        return $capsule;
    };

    $app->get('/criartabela', function(Request $request, Response $response){
        /* Criar DB */
        $db = $this->get('db');
        $db->schema()->dropIfExists('usuarios');
        $db->schema()->create('usuarios', function($table){
            $table->increments('id');
            $table->string('nome');
            $table->string('email');
            $table->timestamps();
        });
        /* Inserir */
        $db->table('usuarios')->insert([
            'nome'  => 'Nicolas Teixeira',
            'email' => 'nicolasteixeira3856@outlook.com'
        ]);
        $db->table('usuarios')->insert([
            'nome'  => 'Maria Teixeira',
            'email' => 'Maria@outlook.com'
        ]);
        /* Atualizar */
        $db->table('usuarios')
        ->where('id', 1)
        ->update([
            'nome' => "Nícolas"
        ]);
        /* Deletar */
        $db->table('usuarios')
        ->where('id', 2)
        ->delete();
        /* Listar */
        //$tabela_usuarios = $db->table('usuarios');
        $usuarios = $db->table('usuarios')->get();
        foreach ($usuarios as $usuario) {
            echo $usuario->nome.'<br>';
        }
    });

    $app->run();


    /* Tipos de respostas 
        Cabeçalho, texto, JSON, XML 
    

    $app->get('/header', function(Request $request, Response $response){
        $response->write('Esse é um retorno header');
        return $response   ->withHeader('allow', 'PUT')
                           ->withAddedHeader('Content-Length', 10);
    });

    $app->get('/json', function(Request $request, Response $response){
        return $response->withJson([
            "nome" => "Nicolas Teixeira"
        ]);

    });

    $app->get('/xml', function(Request $request, Response $response){
        $xml= file_get_contents('arquivo.xml');
        $response->write($xml);
        //->withHeader('Content-Type', 'application/xml');
        return $response;
    });
    */

    

    /* Middleware */

    /*$app->add(function($request, $response, $next){
        $response->write('Inicio camada 1 + ');
        //return $next($request, $response);
        $response = $next($request, $response);
        $response->write('+  Fim camada 1 ');
        return $response;
    });

    $app->add(function($request, $response, $next){
        $response->write('Inicio camada 2 + ');
        return $next($request, $response);
    });

    $app->get('/usuarios', function(Request $request, Response $response){
        $response->write('Ação Principal usuarios');
    });

    $app->get('/postagens', function(Request $request, Response $response){
        $response->write('Ação Principal postagens');
    });*/
    
    

    //Container Dependecy Injection
    /*
    class Servico {
        
    }

    $servico = new Servico;
    
    /* Container Pimple 
    $container = $app->getContainer();
    $container['servico'] = function(){
        return new Servico;
    };

    $app->get('/servico', function(Request $requestm, Response $response)  {
        $servico = $this->get('servico');
        var_dump($servico);
    });

    //Controllers como serviço

    /*$container = $app->getContainer();
    $container['View'] = function(){
        return new MyApp\View;
    };

    $app->get('/usuario', '\MyApp\controllers\Home:index');*/

    /*$container = $app->getContainer();
    $container['Home'] = function(){
        return new MyApp\controllers\Home (new MyApp\View);
    };

    $app->get('/usuario', 'Home:index');*/
    //Padrão PSR7
    /*$app->get('/postagens', function(Request $request, Response $response){
        //Esreve no corpo da resposta utilizando o padrão PSR7
        $response->getBody()->write("Listagem de postagens");
        return $response;
    });

    /* Tipos de requisição ou verbos HTTTP 

    get -> Recuperar recursos do servidor (select)
    post -> Criar dado no servidor (insert)
    put -> Atualizar dados no servidor (update)
    delete -> Deletar dados no servidor (delete)

    

    $app->post('/usuarios/adiciona', function(Request $request, Response $response){
        //Esreve no corpo da resposta utilizando o padrão PSR7
        //$_POST
        $post   = $request->getParsedBody();
        $nome   = $post['Nome'];
        $email  = $post['Email'];
        /* Salvar no banco de dados 
        //return $response->getBody()->write("Sucesso");
        return $response->getBody()->write($nome. " - ".$email);
    });

    $app->put('/usuarios/atualiza', function(Request $request, Response $response){
        //Esreve no corpo da resposta utilizando o padrão PSR7
        //$_POST
        $post   = $request->getParsedBody();
        $id     = $post['id'];
        $nome   = $post['nome'];
        $email  = $post['email'];
        /* Atualizar no banco de dados
        //return $response->getBody()->write("Sucesso");
        return $response->getBody()->write("Sucesso ao atualizar: ". $id);
    });

    $app->delete('/usuarios/remove/{id}', function(Request $request, Response $response){
        //Esreve no corpo da resposta utilizando o padrão PSR7
        //$_POST
        $id = $request->getAttribute('id');
        /* Deletar no banco de dados 
        //return $response->getBody()->write("Sucesso");
        return $response->getBody()->write("Sucesso ao deletar: ". $id);
    });


    $app->run();
    */
    /*
    $app->get('/postagens', function(){
        echo "Listagem de Postagens";
    });

    $app->get('/usuarios[/{id}]', function($request, $response){
        $id = $request->getAttribute('id');
        echo "Listagem de Usuarios" . $id;
    });

    $app->get('/postagens2[/{ano}[/{mes}]]', function($request, $response){
        $ano = $request->getAttribute('ano');
        $mes = $request->getAttribute('mes');
        echo "Listagem de Postagens Ano: " . $ano . ' Mes: ' . $mes;
    });

    $app->get('/lista/{itens:.*}', function($request, $response){
        $itens = $request->getAttribute('itens');
        var_dump(explode("/", $itens));
        echo $itens;
    });
    */

    /*Nomear Rotas
    $app->get('/blog/postagens/{id}', function($request, $response){
        echo 'Listar postagem para um ID';
    })->setName("blog");

    $app->get('/meusite', function($request, $response){
        $retorno = $this->get("router")->pathFor("blog", ["id" => "5"]);

        echo $retorno;
    });*/

    /* Agrupar rotas
    $app->group('/v1', function(){
        $this->get('/postagens', function(){
            echo "Listagem de Postagens";
        });
    
        $this->get('/usuarios', function(){
            echo "Listagem de Usuarios";
        });
    
    });
    */
?>