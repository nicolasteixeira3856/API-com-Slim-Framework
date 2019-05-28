<?php 
    use Psr\Http\Message\ServerRequestInterface as Request;
    use Psr\Http\Message\ResponseInterface as Response;

    require 'vendor/autoload.php';

    $app  = new \Slim\App;

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