<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Carrinho extends BaseController{

    private $validacao;
    private $produtoEspecificacaoModel;
    private $extraModel;
    private $produtoModel;

    public function __construct(){

        $this->validacao = service('validation');

        $this->produtoEspecificacaoModel = new \App\Models\ProdutoEspecificacaoModel();
        $this->extraModel = new \App\Models\ExtraModel();
        $this->produtoModel = new \App\Models\ProdutoModel();

    }

    public function index()
    {
        //
    }

    public function adicionar(){

        if($this->request->getMethod() === 'post'){

            $produtoPost = $this->request->getPost('produto');
            
            
            $this->validacao->setRules([
                'produto.slug' => ['label' => 'Produto', 'rules' => 'required|string'],
                'produto.especificacao_id' => ['label' => 'Valor do Produto', 'rules' => 'required|greater_than[0]'],
                'produto.preco' => ['label' => 'Valor do Produto', 'rules' => 'required|greater_than[0]'],
                'produto.quantidade' => ['label' => 'Quantidade', 'rules' => 'required|greater_than[0]'],                
            ]);

            if(!$this->validacao->withRequest($this->request)->run()){

                return redirect()->back()->with('errors_model', $this->validacao->getErrors())
                                         ->with('atencao', 'Por favor verifique os erros abaixo e tente novamente')
                                         ->withInput(); 

            }
            

            $especificacaoProduto = $this->produtoEspecificacaoModel
                                         ->join('medidas', 'medidas.id = produtos_especificacoes.medida_id')
                                         ->where('produtos_especificacoes.id', $produtoPost['especificacao_id'])
                                         ->first();


            if($especificacaoProduto == null){

                return redirect()->back()->with('fraude', 'Não conseguimos processar a sua solicitação <strong>ERRO-ADD-PROD-1001</strong>');
                                         
            }

            if($produtoPost['extra_id'] && $produtoPost['extra_id'] != ""){

                $extra = $this->extraModel->where('id', $produtoPost['extra_id'])->first();

                if($extra == null){

                    return redirect()->back()->with('fraude', 'Não conseguimos processar a sua solicitação <strong>ERRO-ADD-PROD-2002</strong>');
                                             
                }

            }
            //dd($extra);
            $produto = $this->produtoModel->select(['id', 'nome', 'slug', 'ativo'])->where('slug', $produtoPost['slug'])->first()->toArray();
            
            if($produto == null || $produto['ativo'] == false){

                return redirect()->back()->with('fraude', 'Não conseguimos processar a sua solicitação <strong>ERRO-ADD-PROD-3003</strong>');
                                         
            }

            $produto['slug'] = mb_url_title($produto['slug'] . '-' .  $especificacaoProduto->nome . '-' . (isset($extra) ? 'com extra-'. $extra->nome : ''), '-', true);

            dd($produto);

    }else{

        return redirect()->back();

    }

    }
}
