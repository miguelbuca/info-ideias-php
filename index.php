<?php
    interface Questoes{
        /**
         * Desenvolva uma função que receba como parametro o ano e retorne o século ao qual este ano faz parte.
         * O primeiro século começa no ano 1 e termina no ano 100, o segundo século começa no ano 101 e termina no 200.
         * 
         * Exemplos para teste:
         * Ano 1905 = século 20
         * Ano 1700 = século 17
         */
        public function SeculoAno($ano);
        /**
         * Crie uma função que receba como parâmetro um número inteiro e retorne o maior número primo inferior ao número recebido como parâmetro. 
         * Se o argumento for negativo, a função deverá retornar o valor zero.
         */
        public function PrimoInferior($num);
        /**
         * Escreva um programa que preencha um array com 20 números inteiros sorteados entre 1 e 10. 
         * Depois informe qual número mais se repetiu e quantas vezes ele se repetiu.
         */
        public function Sorteados();
        /**
         * 
         * 
         */
        public function SequenciaCrescente($array);
    }

    class Main implements Questoes{

        public function SeculoAno($ano)
        {   
            if(!is_int($ano) || $ano<1) return "Valor inválido";
            
            if($ano<100)return 1;
            else{
                $res = $ano/100;
                return "Ano ". $ano . " =  século ". (is_int($res) ? $res : intval($res)+1 )."<br>";
            }
        }
        public function PrimoInferior($num)
        {   
            if(!is_int($num)) return "Valor inválido";
            else if($num<0) return 0;
            
            $val = $divisores = null;
            
            for($i=$num-1; $i>0 && $val === null ; $i--){

                $divisores = 1;

                for ($index=1; $index < $i; $index++) { 
                    if(($i%$index)==0){
                        ++$divisores;
                    }
                }

                if($divisores === 2) 
                    $val = $i;
            }

            return "Número ".$num." = ".$val."<br>";
        }
        public function Sorteados()
        {   

            $array = [];
            $resumo = [];

            $m_n_repeticao = 0;
 
            for ($i = 0; $i < 20; $i++) {
                $val = mt_rand(1, 10);
                $array[] = $val;
                $resumo[$val] = 0;
            }

            foreach ($resumo as $key => $value) {
                for ($i=0; $i < 20; $i++) { 
                    if($array[$i] === $key){
                        
                        $val = $resumo[$key]+1;
                        $resumo[$key] = $val;

                        $m_n_repeticao = $val>$m_n_repeticao 
                            ? $val : $m_n_repeticao;
                    }
                }
            }

            echo var_dump($array);

            echo "<h3>Numero(s) repetidos:</h3>";
            foreach ($resumo as $key => $value) {
                if($value === $m_n_repeticao){
                    echo "O número ".$key. " ele se repete ". $value ." vezes <br>";
                }
            }
        }
        public function SequenciaCrescente($array)
        {

            $eValid = false;

            foreach ($array as $key => $value) {

                $nArray = [];

                for ($i=0; $i < count($array); $i++) { 
                    if($value !== $array[$i]){
                        $nArray[$array[$i]] = $array[$i];
                    }
                }
                $nSort = implode('-',$nArray);
                
                sort($nArray);

                $sort = implode('-',$nArray);

                echo strcmp($nSort,$sort);

                $eValid = $nSort === implode('-',$nArray);

            }

            return $eValid;
        }
    }

    echo "<h1>Teste PHP</h1>";

    $main = new Main();

    echo "<h4>1- Seculo Ano</h4>";
    echo $main->SeculoAno(1905);
    echo $main->SeculoAno(1700);
    echo "<hr>";
    echo "<h4>2- Primo Inferior</h4>";
    echo $main->PrimoInferior(7);
    echo $main->PrimoInferior(30);
    echo "<hr>";
    echo "<h4>3- Sorteados repetidos</h4>";
    $main->Sorteados();
    echo "<h4>4- Sequencia Crescente</h4>";
    echo $main->SequenciaCrescente([1, 2, 5, 5, 5]);

