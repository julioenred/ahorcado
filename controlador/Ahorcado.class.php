<?php  

include 'Tablero.class.php';

class Ahorcado
{
    private $MAX_ERRORES = 7;
    private $tablero;

    function __construct()
    {
        $this->tablero = new Tablero();   
    }
    
    public function iniciar()
    {
        $this->tablero->mostrar();
    }

    public function jugar()
    {
        $letra = $_POST['letra'];
        $this->tablero->acertadaOfallada($letra);
        if ($this->terminado()) 
        {
            $this->fin();
        }
        else
        {
            $this->tablero->mostrar();
        }
        
    }

    private function terminado() 
    {
        return $this->tablero->numeroErrores() >= $this->MAX_ERRORES || $this->tablero->resuelto();
    }
    
    private function fin() {
        if ($this->tablero->resuelto()) 
        {
            $html = new DOMDocument();
            $html->loadHtmlFile('../vista/finGanador.html');
            echo $html->saveHtml();
        } 
        else 
        {
            $html = new DOMDocument();
            $html->loadHtmlFile('../vista/finPerdedor.html');
            echo $html->saveHtml();
        }
    }
}