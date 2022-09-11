
<?php

class ControladorUsuario
{

    static public function ctrMostrarUsuarios($item, $valor, $pagina = null)
    {
        $ofset = null;
        if ($pagina != null) {
            $ofset = $pagina * 10;
        }
        $respuesta = ModeloUsuario::mdlMostrarUsuarios($item, $valor, $ofset);
        return $respuesta;
    }


    public function ctrMostrarUsuariosPaginar($pagina = null)
    {
        $ofset = null;
        if ($pagina != null) {
            $ofset = ($pagina - 1) * 10;
        } else {
            $pagina = 1;
        }

        $usuarios = ModeloUsuario::mdlMostrarUsuarios(null, null, $ofset);
        $cantidad = ModeloUsuario::mdlContarTablaPaginar('usuario');

        $cantidad = ceil($cantidad / 1);
        $datos = array(
            'usuarios' => $usuarios,
            'paginador' => $this->ctrCrearPaginador($cantidad, $pagina),

        );
        return $datos;
    }

    static public function ctrMostrarPreguntas($tabla, $campo, $condicion, $valor)
    {
        $respuesta = ModeloUsuario::mdlContarTabla($tabla, $campo, $condicion, $valor);
        return $respuesta;
    }




    function ctrCrearPaginador($nroPaginas, $paginaActual)
    {

        $botones = '';

        for ($i = 1; $i <= $nroPaginas; $i++) {
            if ($paginaActual != $i) {
                $botones .= "<li class=\"page-item\"><a class=\"page-link\" href=\"" . BASE_URL . "admin/$i\">$i</a></li>";
            } else {
                $botones .= "
                <li class=\"page-item active\" aria-current=\"page\">
                    <span class=\"page-link\" >$i</span>
                </li>";
            }
        }
        $paginador = "
            <nav aria-label=\"...\">
                <ul class=\"pagination\">
                    $botones
                </ul>
            </nav>
            ";
        return $paginador;
    }
}
