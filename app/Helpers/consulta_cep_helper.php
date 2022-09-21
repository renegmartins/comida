<?php

if(!function_exists('consultaCep')){

    function consultaCep(string $cep){

        $urlViaCep = "https://viacep.com.br/ws/{$cep}/json/";

        /* Abre conexão */
        $ch = curl_init();

        /* Definindo url */
        curl_setopt($ch, CURLOPT_URL, $urlViaCep);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        /* Executando post */
        $json = curl_exec($ch);

        /* Decodificando objeto JSON */
        $resultado = json_decode($json);

        /* Fechando conexão */
        return $resultado;

        
    }

}