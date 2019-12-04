<?php

class Upload {

    private $imagem;
    public $nome_final = "";
    public $erro = "";
    public $tamanhoMax = 2097152;
    public $tamanhoArquivo = 0;
    public $livre_tam;
    private $adicional_nome = "";
    public $name;
    public $tmp_name;
    public $size;
    public $error;
    private $array_erro = array('Não houve erro', 'O arquivo no upload é maior do que o limite do PHP',
        'O arquivo ultrapassa o limite de tamanho especificado no HTML', 'O upload do arquivo foi feito parcialmente', 'Não foi feito o upload do arquivo');

    public function __construct($imagem = NULL, $livre_tam = NULL, $adicionalNome = "") {
        $this->imagem = $imagem;
        $this->livre_tam = $livre_tam;
        $this->adicional_nome = $adicionalNome;
        if ($this->imagem != NULL && isset($this->imagem["name"]) && $this->imagem["name"] != NULL && $this->imagem["name"] != "") {
            $this->name     = $this->imagem["name"];
            $this->tmp_name = $this->imagem["tmp_name"];
            $this->size     = $this->imagem["size"];
            $this->error    = $this->imagem["error"];            
            $this->upload();
        }
    }

    public function __destruct() {
        unset($this);
    }

    public function upload() {
        if (isset($this->name) && (($this->size <= $this->tamanhoMax) || ($this->size > $this->tamanhoMax && $this->livre_tam == "true"))) {
            if ($this->error == 0) {

                $separacao = explode('.', $this->name);
                $this->nome_final = $this->adicional_nome . date('Y-m-d') . time() . '.' . $separacao[1];
                $this->moveArquivo($this->tmp_name, "../arquivos/" . $this->nome_final);
                $this->tamanhoArquivo = $this->size;
            } elseif (isset($this->error) && $this->error !== NULL && $this->error !== "") {
                $this->erro = "Não foi possível fazer o upload, erro:" . $this->array_erro[$this->error];
            }
        } elseif ($this->size > $this->tamanhoMax) {
            $this->erro = "Tamanho máximo é 2 Mb";
        } else {
            $this->erro = "Não pode fazer upload sem arquivo!";
        }
    }

    private function moveArquivo($temp, $cam) {
        $res = move_uploaded_file($temp, $cam);
        if ($res == FALSE) {
            $this->erro = "Erro ao carregar imagem para servidor!";
        }
    }

    public function upload_png($tmp, $nome, $largura, $pasta) {
        $img = imagecreatefrompng($tmp);
        $x = imagesx($img);
        $y = imagesy($img);
        $altura = ($largura * $y) / $x;
        $nova = imagecreatetruecolor($largura, $altura);
        imagecopyresampled($nova, $img, 0, 0, 0, 0, $largura, $altura, $x, $y);
        imagepng($nova, "$pasta/$nome");
        imagedestroy($nova);
        imagedestroy($img);
        return($nome);
    }

}
