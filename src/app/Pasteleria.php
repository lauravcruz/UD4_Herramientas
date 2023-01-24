<?php

declare(strict_types=1);

namespace src\app;

include_once("./autoload.php");

use src\util\ClienteNoEncontradoException;
use src\util\DulceNoEncontradoException;
use src\util\LogFactory;
use Monolog\Logger;

class Pasteleria
{
    private Logger $log;
    private $productos = [];
    private $clientes = [];
    //numProductos y clientes devuelve el tamaño del array
    //private $numProductos;
    //private $numClientes;


    public function __construct(
        public $nombre,
    ) {
        $this->log = LogFactory::getLogger();
    }
    /**
     * Summary of getNombre
     * @return string
     */
    public function getNombre(): string
    {
        return $this->nombre;
    }
    /**
     * Summary of setNombre
     * @param string $nombre
     * @return void
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * Summary of getNumProductos
     * Devuelve el número total de productos de la pastelería
     * @return int
     */

    public function getNumProductos()
    {
        return count($this->productos);
    }

    /**
     * Summary of getNumClientes
     * Devuelve el número total de clientes de la pastelería
     * @return int
     */

    public function getNumClientes()
    {
        return count($this->clientes);
    }

    /**
     * Summary of incluirProducto
     * Añade un dulce a los productos de la pastelería
     * @param Dulce $producto
     * @return void
     */
    public function incluirProducto(Dulce $producto)
    {
        array_push($this->productos, $producto);
    }

    /**
     * Summary of incluirTarta
     * Crea y añade una tarta a los productos de la pastelería
     * El número se le asigna en función del número de productos total
     * @param string $nombre
     * @param float $precio
     * @param int $numPisos
     * @param int $minC
     * @param int $maxC
     * @param array $rellenos
     * @return void
     */
    public function incluirTarta($nombre, $precio, $numPisos, $minC, $maxC, $rellenos)
    {
        if (count($rellenos) != $numPisos) {
            echo "No es posible crear la tarta. Debe tener el mismo número de relleno que de pisos";
        } else {
            $tarta = new Tarta($nombre, $this->getNumProductos(), $precio, $numPisos, $minC, $maxC);
            $tarta->setRellenos($rellenos);
            $this->incluirProducto($tarta);
        }
    }

    /**
     * Summary of incluirBollo
     * Crea y añade un bollo a los productos de la pastelería
     * El número se le asigna en función del número de productos total
     * @param string $nombre
     * @param float $precio
     * @param string $relleno
     * @return void
     */
    public function incluirBollo($nombre, $precio, $relleno)
    {
        $bollo = new Bollo($nombre, $this->getNumProductos(), $precio, $relleno);
        $this->incluirProducto($bollo);
    }
    /**
     * Summary of incluirChocolate
     * Crea y añade un chocolate a los productos de la pastelería
     * El número se le asigna en función del número de productos total
     * @param string $nombre
     * @param float $precio
     * @param float $porcentajeCacao
     * @param float $peso
     * @return void
     */
    public function incluirChocolate($nombre, $precio, $porcentajeCacao, $peso)
    {
        $chocolate = new Chocolate($nombre, $this->getNumProductos(), $precio, $porcentajeCacao, $peso);
        $this->incluirProducto($chocolate);
    }
    /**
     * Summary of incluirCliente
     * Crea e incluye un cliente en los clientes de la pastelería
     * El número se le asigna en función del número de clientes total
     * @param string $nombre
     * @return void
     */

    public function incluirCliente($nombre)
    {
        $cliente = new Cliente($nombre, $this->getNumClientes());
        array_push($this->clientes, $cliente);
    }
    /**
     * Summary of getClientes
     * @return array
     */

    public function getClientes()
    {
        return $this->clientes;
    }
    /**
     * Summary of getProductos
     * @return array
     */

    public function getProductos()
    {
        return $this->productos;
    }

    /**
     * Summary of listarProductos
     * La función imprime por pantalla el listado de productos de la pastelería
     * @return void
     */

    public function listarProductos()
    {
        $listarProducto = "<p>PRODUCTOS: </p><ul>";
        foreach ($this->getProductos() as $producto) {
            $listarProducto .= "<li>$producto->nombre</li>";
        }
        $listarProducto .= "</ul>";
        echo $listarProducto;
    }

    /**
     * Summary of listarClientes
     * La función imprime por pantalla el listado de clientes de la pastelería
     * @return void
     */
    public function listarClientes()
    {
        $listarCliente = "<p>CLIENTES: </p><ul>";

        foreach ($this->getClientes() as $cliente) {
            $listarCliente .= $cliente->muestraResumen();
        }
        $listarCliente .= "</ul>";
        echo $listarCliente;
    }

    /**
     * Summary of comprarClienteProducto
     * La función comprarClienteProducto recibe el número del cliente y el número del dulce que compra. 
     * Se comprueba que ambos están en Pastelería y se llama a la función comprar del cliente
     * @param int $numeroCliente
     * @param int $numeroDulce
     * @throws ClienteNoEncontradoException
     * @throws DulceNoEncontradoException
     * @return void
     */

    public function comprarClienteProducto($numeroCliente, $numeroDulce)
    {
        $existeDulce = false;
        $clienteExiste = false;
        try {
            foreach ($this->getClientes() as $cliente) {
                if ($cliente->getNumero() == $numeroCliente) {
                    $c = $cliente;
                    $clienteExiste = true;
                }
            }
            if (!$clienteExiste) {
                $this->log->error("Cliente no encontrado", [$numeroCliente]);
                throw new ClienteNoEncontradoException("<p>Cliente no encontrado</p>");
            }
            foreach ($this->getProductos() as $dulce) {
                if ($dulce->getNumero() == $numeroDulce) {
                    $p = $dulce;
                    $existeDulce = true;
                    //Una vez encontrados ambos, realizamos la acción de comprar
                    if ($c->comprar($p)) {
                        $this->log->alert("Se ha realizado la compra", [$numeroCliente, $numeroDulce]);
                        echo "<p>Se ha realizado la compra</p>";
                    } else {
                        echo "<p>Error en la compra</p>";
                    }
                }
            }
            if (!$existeDulce) {
                $this->log->warning("Dulce no encontrado", [$numeroDulce]);
                throw new DulceNoEncontradoException("<p>Dulce no encontrado</p>");
            }
        } catch (DulceNoEncontradoException $e) {
            echo $e->getMessage();
        } catch (ClienteNoEncontradoException $e) {
            echo $e->getMessage();
        }
    }
}
