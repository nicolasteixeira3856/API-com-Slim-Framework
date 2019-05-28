<?php

    require 'vendor/autoload.php';

    $app  = new \Slim\App;

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

    /*Nomear Rotas */
    $app->get('/blog/postagens/{id}', function($request, $response){
        echo 'Listar postagem para um ID';
    })->setName("blog");

    $app->get('/meusite', function($request, $response){
        $retorno = $this->get("router")->pathFor("blog", ["id" => "5"]);

        echo $retorno;
    });

    /* Agrupar rotas */
    $app->group('/v1', function(){
        $this->get('/postagens', function(){
            echo "Listagem de Postagens";
        });
    
        $this->get('/usuarios', function(){
            echo "Listagem de Usuarios";
        });
    
    });



    $app->run();