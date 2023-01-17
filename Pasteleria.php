<?php

declare(strict_types=1);
include_once("autoload.php");

class Pasteleria
{
    private $productos = [];
    private $clientes = [];
    //numProductos y clientes devuelve el tamaño del array
    //private $numProductos;
    //private $numClientes;

    public function __construct(
        public $nombre,
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

    public function getNumProductos()
    {
        return count($this->productos);
    }

    public function getNumClientes()
    {
        return count($this->clientes);
    }

    public function incluirProducto(Dulce $producto)
    {
        array_push($this->productos, $producto);
    }

    public function incluirTarta($nombre, $numero, $precio, $numPisos, $rellenos, $minC, $maxC)
    {
        $tarta = new Tarta($nombre, $numero, $numPisos, $rellenos, $minC, $maxC);
        $this->incluirProducto($tarta);
    }
    public function incluirBollo($nombre, $numero, $precio, $relleno)
    {
        $bollo = new Bollo($nombre, $numero, $precio, $relleno);
        $this->incluirProducto($bollo);
    }
    public function incluirChocolate($nombre, $numero, $precio, $porcentajeCacao, $peso)
    {
        $chocolate = new Chocolate($nombre, $numero, $precio, $porcentajeCacao, $peso);
        $this->incluirProducto($chocolate);
    }

    public function incluirCliente($nombre)
    {
        $cliente = new Cliente($nombre);
        array_push($this->clientes, $cliente);
    }

    public function getClientes()
    {
        return $this->clientes;
    }

    public function getProductos()
    {
        return $this->productos;
    }

    public function listarProductos()
    {
        $listarProducto = "<p>PRODUCTOS: </p><ul>";
        foreach ($this->getProductos() as $producto) {
            $listarProducto .= "<li>$producto->nombre</li>";
        }
        $listarProducto .= "</ul>";
        return $listarProducto;
    }
    public function listarClientes()
    {
        $listarCliente = "<p>CLIENTES: </p><ul>";

        foreach ($this->getClientes() as $cliente) {
            //Añadimos el username: 
            $listarCliente .= "<li>" . $cliente->muestraResumen() . "</li>";
            //echo $socio->listaAlquileres();
        }
        $listarCliente .= "</ul>";
        return $listarCliente;
    }

    public function comprarClienteProducto($numeroCliente, $numeroDulce)
    {
        foreach ($this->getClientes() as $cliente) {
            if ($cliente->getNumero() == $numeroCliente) {
                $c = $cliente;
                foreach ($this->getProductos() as $dulce) {
                    if ($dulce->getNumero() == $numeroDulce) {
                        $p = $dulce;
                        //Una vez encontrados ambos, realizamos la acción de comprar
                        $c->comprar($p);
                    }
                }
            }
        }
    }
}
