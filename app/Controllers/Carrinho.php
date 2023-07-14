<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Carrinho extends BaseController{

    private $validacao;
    private $produtoEspecificacaoModel;
    private $extraModel;
    private $produtoModel;
    private $medidaModel;
    private $bairroModel;
    private $acao;

    public function __construct(){

        $this->validacao = service('validation');

        $this->produtoEspecificacaoModel = new \App\Models\ProdutoEspecificacaoModel();
        $this->extraModel = new \App\Models\ExtraModel();
        $this->produtoModel = new \App\Models\ProdutoModel();
        $this->medidaModel = new \App\Models\MedidaModel();
        $this->bairroModel = new \App\Models\BairroModel();

        $this->acao = service('router')->methodName();

    }

    public function index()
    {
        $data = [
            'titulo' => 'Meu carrinho de compras'
        ];

        if(session()->has('carrinho') && count(session()->get('carrinho')) > 0){

            $data['carrinho'] = json_decode(json_encode(session()->get('carrinho')), false);

        }

        return view('Carrinho/index', $data);
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
            
            $produto = $this->produtoModel->select(['id', 'nome', 'slug', 'ativo'])->where('slug', $produtoPost['slug'])->first();
            
            if($produto == null || $produto->ativo == false){

                return redirect()->back()->with('fraude', 'Não conseguimos processar a sua solicitação <strong>ERRO-ADD-PROD-3003</strong>');
                                         
            }

            $produto = $produto->toArray();

            $produto['slug'] = mb_url_title($produto['slug'] . '-' .  $especificacaoProduto->nome . '-' . (isset($extra) ? 'com extra-'. $extra->nome : ''), '-', true);

            $produto['nome'] = $produto['nome']. ' ' . $especificacaoProduto->nome. ' ' . (isset($extra) ? 'Com extra '. $extra->nome : '');

            $preco = $especificacaoProduto->preco + (isset($extra) ? $extra->preco : 0);

            $produto['preco'] = number_format($preco, 2);
            $produto['quantidade'] = (int) $produtoPost['quantidade'];
            $produto['tamanho'] = $especificacaoProduto->nome;

            unset($produto['ativo']);


            if(session()->has('carrinho')){

                $produtos = session()->get('carrinho');

                $produtosSlugs = array_column($produtos, 'slug');

                if(in_array($produto['slug'], $produtosSlugs)){

                    $produtos = $this->atualizaProduto($this->acao, $produto['slug'], $produto['quantidade'], $produtos);

                    session()->set('carrinho', $produtos);

                }else{

                    session()->push('carrinho', [$produto]);

                }

            }else{

                $produtos[] = $produto;
                session()->set('carrinho', $produtos);

            }
            
            return redirect()->to(site_url('carrinho'))->back()->with('sucesso', 'Produto adicionado com sucesso!');

    }else{

        return redirect()->back();

    }    

    }

public function especial(){

    if($this->request->getMethod() === 'post'){

        $produtoPost = $this->request->getPost();

        $this->validacao->setRules([
            'primeira_metade' => ['label' => 'Primeiro produto', 'rules' => 'required|greater_than[0]'],
            'segunda_metade' => ['label' => 'Segundo produto', 'rules' => 'required|greater_than[0]'],
            'tamanho' => ['label' => 'Tamanho do produto', 'rules' => 'required|greater_than[0]'],            
        ]);

        if(!$this->validacao->withRequest($this->request)->run()){

            return redirect()->back()->with('errors_model', $this->validacao->getErrors())
                                     ->with('atencao', 'Por favor verifique os erros abaixo e tente novamente')
                                     ->withInput(); 

        }

        $primeiroProduto = $this->produtoModel->select(['id', 'nome', 'slug'])
                                              ->where('id', $produtoPost['primeira_metade'])
                                              ->first();

        if($primeiroProduto == null){

            return redirect()->back()
                             ->with('fraude', 'Não conseguimos processar a sua solicitação. Por favor, entre em contato com a nossa equipe e informe o código do erro <strong>ERRO-ADD-CUSTOM-1001</strong>');

        }

        $segundoProduto = $this->produtoModel->select(['id', 'nome', 'slug'])
                                              ->where('id', $produtoPost['segunda_metade'])
                                              ->first();

        if($segundoProduto == null){

            return redirect()->back()
                             ->with('fraude', 'Não conseguimos processar a sua solicitação. Por favor, entre em contato com a nossa equipe e informe o código do erro <strong>ERRO-ADD-CUSTOM-2002</strong>');

        }

        $primeiroProduto = $primeiroProduto->toArray();
        $segundoProduto = $segundoProduto->toArray();

        if($produtoPost['extra_id'] && $produtoPost['extra_id'] != ""){

            $extra = $this->extraModel->where('id', $produtoPost['extra_id'])->first();

            if($extra == null){

                return redirect()->back()->with('fraude', 'Não conseguimos processar a sua solicitação <strong>ERRO-ADD-CUSTOM-3003</strong>');
                                         
            }

        }


        $medida = $this->medidaModel->exibeValor($produtoPost['tamanho']);

        if($medida->preco == null){

            return redirect()->back()->with('fraude', 'Não conseguimos processar a sua solicitação <strong>ERRO-ADD-CUSTOM-4004</strong>');
                                     
        }
        
        $produto['slug'] = mb_url_title($medida->nome. ' - metade - ' . $primeiroProduto['slug'] . ' - metade - ' .  $segundoProduto['slug'] . '-' . (isset($extra) ? 'com extra-'. $extra->nome : ''), '-', true);
        $produto['nome'] = $medida->nome. ' metade ' . $primeiroProduto['nome'] . ' metade ' .  $segundoProduto['nome'] . ' ' . (isset($extra) ? 'Com extra de '. $extra->nome : '');
   
        $preco = $medida->preco + (isset($extra) ? $extra->preco : 0);

        $produto['preco'] = number_format($preco, 2);
        $produto['quantidade'] = 1; // Sempre será um
        $produto['tamanho'] = $medida->nome;

        if(session()->has('carrinho')){

            $produtos = session()->get('carrinho');

            $produtosSlugs = array_column($produtos, 'slug');

            if(in_array($produto['slug'], $produtosSlugs)){

                $produtos = $this->atualizaProduto($this->acao, $produto['slug'], $produto['quantidade'], $produtos);

                session()->set('carrinho', $produtos);

            }else{

                session()->push('carrinho', [$produto]);

            }

        }else{

            $produtos[] = $produto;
            session()->set('carrinho', $produtos);

        }
        
        return redirect()->to(site_url('carrinho'))->back()->with('sucesso', 'Produto adicionado com sucesso!');


    }else{

        return redirect()->back();

    }

}

public function atualizar(){

    if($this->request->getMethod() === 'post'){

        $produtoPost = $this->request->getPost('produto');

        $this->validacao->setRules([
            'produto.slug' => ['label' => 'Produto', 'rules' => 'required|string'],
            'produto.quantidade' => ['label' => 'Quantidade', 'rules' => 'required|greater_than[0]'],
        ]);

        if(!$this->validacao->withRequest($this->request)->run()){
            return redirect()->back()
                             ->with('errors_model', $this->validacao->getErrors())
                             ->with('atencao', 'Por favor verifique os erros abaixo e tente novamente')
                             ->withInput();
        }

        $produtos = session()->get('carrinho');

        $produtosSlugs = array_column($produtos, 'slug');

        if(!in_array($produtoPost['slug'], $produtosSlugs)){
            return redirect()->back()->with('fraude', 'Não conseguimos processar a sua solicitação <strong>ERRO-ATUA-PROD-7007</strong>');
        }else{

            $produtos = $this->atualizaProduto($this->acao, $produtoPost['slug'], $produtoPost['quantidade'], $produtos);
            session()->set('carrinho', $produtos);

            return redirect()->back()->with('sucesso', 'Quantidade atualizada com sucesso');
        }
    }else{
        return redirect()->back();
    }

}

public function remover(){

    if($this->request->getMethod() === 'post'){

        $produtoPost = $this->request->getPost('produto');

        $this->validacao->setRules([
            'produto.slug' => ['label' => 'Produto', 'rules' => 'required|string'],
        ]);

        if(!$this->validacao->withRequest($this->request)->run()){
            return redirect()->back()
                             ->with('errors_model', $this->validacao->getErrors())
                             ->with('atencao', 'Por favor verifique os erros abaixo e tente novamente')
                             ->withInput();
        }

        $produtos = session()->get('carrinho');

        $produtosSlugs = array_column($produtos, 'slug');

        if(!in_array($produtoPost['slug'], $produtosSlugs)){
            return redirect()->back()->with('fraude', 'Não conseguimos processar a sua solicitação <strong>ERRO-ATUA-PROD-7007</strong>');
        }else{

            $produtos = $this->removeProduto($produtos, $produtoPost['slug']);
            session()->set('carrinho', $produtos);

            return redirect()->back()->with('sucesso', 'Produto removido do carrinho de compras');
            }
        }else{
        return redirect()->back();
    }

}

public function limpar(){

    session()->remove('carrinho');

    return redirect()->to(site_url('carrinho'));

}

public function consultaCep(){

    if(!$this->request->isAJAX()){

        return redirect()->back();

    }

    $this->validacao->setRule('cep', 'CEP', 'required|exact_length[9]');

    if(!$this->validacao->withRequest($this->request)->run()){

        $retorno['erro'] = '<span class="text-danger small">'. $this->validacao->getError() .'</span>';

        return $this->response->setJSON($retorno);

    }

    $cep = str_replace("-", "", $this->request->getGet('cep'));

    helper('consulta_cep');

    $consulta = consultaCep($cep);

    if (isset($consulta->erro) && !isset($consulta->cep)){

        $retorno['erro'] = '<span class="text-danger small">Informe um CEP válido</span>';

        return $this->response->setJSON($retorno);

    }

    $bairroRetornoSlug = mb_url_title($consulta->bairro, '-', true);

    $bairro = $this->bairroModel->select('nome, valor_entrega')->where('slug', $bairroRetornoSlug)->where('ativo', true)->first();

    if($bairro == null){

        $retorno['erro'] = '<span class="text-danger small">Não atendemos o Bairro: '
        . esc($consulta->bairro)
        . ' - ' . esc($consulta->localidade)
        . ' - CEP ' . esc($consulta->cep)
        . ' - ' . esc($consulta->uf)
        . '</span>';

        return $this->response->setJSON($retorno);

    }

    $retorno['valor_entrega'] = 'R$ ' . esc(number_format($bairro->valor_entrega, 2));

    $retorno['bairro'] = '<span class="small">Valor de entrega para o Bairro: '
        . esc($consulta->bairro)
        . ' - ' . esc($consulta->localidade)
        . ' - CEP ' . esc($consulta->cep)
        . ' - ' . esc($consulta->uf)
        . ' - R$ ' . esc(number_format($bairro->valor_entrega, 2))
        . '</span>';

    $carrinho = session()->get('carrinho');

    $total = 0;
    
    foreach ($carrinho as $produto){

        $total += $produto['preco'] * $produto['quantidade'];

    }
    
    $total += esc(number_format($bairro->valor_entrega, 2));

    $retorno['total'] = 'R$ ' .esc(number_format($total, 2));

    return $this->response->setJSON($retorno);

    /*
    echo '<pre>';
    print_r($consulta);
    exit;
    */
}

    private function atualizaProduto(string $acao, string $slug, int $quantidade, array $produtos){

        $produtos = array_map(function ($linha) use ($acao, $slug, $quantidade){

            if($linha['slug'] == $slug){

                if($acao === 'adicionar'){

                    $linha['quantidade'] += $quantidade;

                }

                if($acao === 'especial'){

                    $linha['quantidade'] += $quantidade;

                }

                if($acao === 'atualizar'){

                    $linha['quantidade'] = $quantidade;

            }

            }

            return $linha;

        }, $produtos);

        return $produtos;

    }


    private function removeProduto(array $produtos, string $slug){

        return array_filter($produtos, function ($linha) use($slug) {

            return $linha['slug'] != $slug;

        } );

    }
}
