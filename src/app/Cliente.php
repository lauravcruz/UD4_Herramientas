<?php

declare(strict_types=1);

namespace src\app;

//include_once("autoload.php");
include_once("Dulce.php");
include_once("./util/ClienteNoEncontradoException.php");
include_once("./util/DulceNoCompradoException.php");
include_once("./util/DulceNoEncontradoException.php");
include_once("./util/LogFactory.php");

use src\util\DulceNoCompradoException;
use Exception;
use src\util\LogFactory;
use Monolog\Logger;

class Cliente
{
    private Logger $log;
    private $dulcesComprados = [];
    //numDulcesComprados será el tamaño del array de dulcesComprados
    //private $numDulcesComprados = 0;
    public function __construct(
        public $nombre,
        private $numero,
        private $numPedidosEfectuados = 0,
    ) {
        $this->log = LogFactory::getLogger();
    }

    public function getNombre()
    {
        return $this->nombre;
    }
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getNumero()
    {
        return $this->numero;
    }
    public function setNumero($numero)
    {
        $this->numero = $numero;
    }

    public function setNumPedidosEfectuados($numPedido)
    {
        $this->numPedidosEfectuados = $numPedido;
    }

    public function getNumPedidosEfectuados()
    {
        return $this->numPedidosEfectuados;
    }

    public function getNumDulcesComprados(): int
    {
        return count($this->getDulcesComprados());
    }

    public function getDulcesComprados()
    {
        return $this->dulcesComprados;
    }


    public function listaDeDulces(Dulce $d): bool
    {
        //Recorre el array de dulcesComprados y comprueba si está el dulce
        return in_array($d, $this->getDulcesComprados());
    }

    public function comprar(Dulce $d)
    {
        try {
            array_push($this->dulcesComprados, $d);
            $this->setNumPedidosEfectuados($this->getNumPedidosEfectuados() + 1);
            $this->log->debug("Se ha añadido dulce al array", [$d->getNombre(), $this->getNombre()]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function valorar(Dulce $d, String $c): void
    {
        try {
            if ($this->listaDeDulces($d)) {
                echo "El cliente " . $this->getNombre() . " opina sobre " . $d->getNombre() . ": $c";
            } else {
                $this->log->alert("Dulce no comprado", [$d]);
                throw new DulceNoCompradoException("<p>No puede valorar ese dulce. No lo ha comprado</p>");
            }
        } catch (DulceNoCompradoException $e) {
            echo $e->getMessage();
        }
    }

    public function listarPedidos(): void
    {
        $listarPedidos = "<p>PEDIDOS DE " . $this->getNombre() . ": </p><ul>";

        foreach ($this->getDulcesComprados() as $pedido) {
            $listarPedidos .= "<li>" . $pedido->getNombre() . "</li>";
        }
        $listarPedidos .= "</ul>";
        echo $listarPedidos;
    }

    public function muestraResumen(): string
    {
        return "<li>Nombre: $this->nombre</li>        
            <ul><li>Número de pedidos efectuados: " . $this->getNumPedidosEfectuados() . "</li></ul>";
    }
}
