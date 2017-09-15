<?php  

class Palabra
{
    private $DICCIONARIO = ["pelota", "barco", "ciudad", "rinoceronte"];
    private $palabra = [];
    private $letrasAcertadas = [];
    private $posicionPalabra;

    function __construct(){
        $this->palabra = $this->generarPalabra();
        $this->generarLetrasAcertadas();
    }
    
    private function generarPalabra() {
        $this->posicionPalabra = rand(0, count($this->DICCIONARIO) - 1);
        $palabra = str_split($this->DICCIONARIO[$this->posicionPalabra]);
        return $palabra;
    }
    
    private function generarLetrasAcertadas() {
        for ($i = 0; $i < count($this->palabra); $i++) {
            $this->letrasAcertadas[$i] = false;
        }
    }

    public function formatear() {
        $palabraFormateada = '';
        for ($i = 0; $i < count($this->palabra); $i++) {
            if ($this->letrasAcertadas[$i]) 
            {
                $palabraFormateada = $palabraFormateada . $this->palabra[$i] . ' ';
            }
            else 
            {
                $palabraFormateada = $palabraFormateada . '_' . ' ';
            }
        }
        return $palabraFormateada;
    }
    
    public function acertada($letra) {
        for ($i = 0; $i < count($this->palabra); $i++) {
            if ($letra == $this->palabra[$i]) {
                return true;
            }
        }
        return false;
    }
    
    public function resuelta() {
        for ($i = 0; $i < count($this->letrasAcertadas); $i++) {
            if (!$this->letrasAcertadas[$i]) {
                return false;
            }
        }
        return true;
    }

    public function destaparLetraAcertada($letra) {
        for ($i = 0; $i < count($this->palabra); $i++) {
            if ($this->palabra[$i] == $letra) {
                $this->letrasAcertadas[$i] = true;
            }
        }
    }

    public function getPalabra() {
        return $this->DICCIONARIO[$this->posicionPalabra];
    }
}