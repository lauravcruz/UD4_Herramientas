<?php

declare(strict_types=1);


class Cliente
{
    private $dulcesComprados = [];
    private $numDulcesComprados = 0;
    public function __construct(
        public $nombre,
        private $numPedidosEfectuados = 0
    ) {
    }

    public function getNombre()
    {
        return $this->nombre;
    }
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
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
        array_push($this->dulcesComprados, $d);
        $this->setNumPedidosEfectuados($this->getNumPedidosEfectuados() + 1);
    }

    public function valorar(Dulce $d, String $c): void
    {
        if ($this->listaDeDulces($d)) {
            echo $c;
        } else {
            echo "No puede valorar ese dulce. No lo ha comprado";
        }
    }

    public function listarPedidos(): void
    {
    }


    public function muestraResumen(): void
    {
        echo "<p>Nombre: $this->nombre</p>        
            <p>Número de pedidos efectuados: </p>";
    }
}
