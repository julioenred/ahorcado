<?php  
include 'Palabra.class.php';

class Tablero
{
    private $MAX_ERRORES = 7;
    private $palabra;
    private $errores = [];

    function __construct(){
        $this->palabra = new Palabra();
        $this->iniciarErrores();
    }
    
    private function iniciarErrores() {
        for ($i = 0; $i < $this->MAX_ERRORES; $i++) {
            $this->errores[$i] = ' ';
        }
    }

    public function mostrar() {
        $datosModificar = [
                            ['id' => 'palabra', 'texto' => $this->palabra->formatear()], 
                            ['id' => 'errores', 'texto' => $this->formatearErrores()]
                          ];
        $this->renderizar('../vista/tablero.html', $datosModificar);
    }

    private function formatearErrores()
    {
        $errores = '';
        foreach ($this->errores as $key => $error) 
        {
            $errores = $errores . $error . ' ';
        }
        return $errores;
    }

    private function renderizar($vista, $datos)
    {
        $html = new DOMDocument();
        $html->loadHtmlFile($vista);
        foreach ($datos as $key => $elemento) 
        {
            $etiqueta = $html->getElementById($elemento['id']);
            $etiqueta->nodeValue = $elemento['texto'];
        }
        echo $html->saveHtml();
    }
    
    public function acertadaOfallada($letra) {
        if (!$this->palabra->acertada($letra)) {
            $this->incluirLetraErrores($letra);
        }else {
            $this->palabra->destaparLetraAcertada($letra);
        }
    }
    
    private function incluirLetraErrores($letra) {
        for ($i = 0; $i < count($this->errores); $i++) {
            if ($this->errores[$i] == ' ') {
                $this->errores[$i] = $letra;
                break;
            }
        }
    }

    public function numeroErrores() {
        $contador = 0;
        for ($i = 0; $i < count($this->errores); $i++) {
            if ($this->errores[$i] != ' ') {
                $contador = $contador + 1;
            }
        }
        return $contador;
    }

    public function resuelto() {
        return $this->palabra->resuelta();
    }

    public function fin()
    {
        
    }
    
    public function getPalabra() {
        return $this->palabra->getPalabra();
    }
}