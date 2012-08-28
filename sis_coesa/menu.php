<dl id="nav">
	
    <?php if($usuario_priv==1 or $usuario_priv==3){ ?>
    <dt class="items"><b>Administración</b></dt>
        <dd>
          <ul>
          		<li><a href="/sis_coesa/almacen/articulos/lista.php">Insumos</a></li> 
                <li><a href="/sis_coesa/almacen/maquinas_costo/lista.php">Datos de máquina</a></li>
            </ul>
        </dd>
    <?php } ?>
    
    <?php if($usuario_priv==2 or $usuario_priv==3 or $usuario_priv==4){ ?>
    <dt class="items"><b>Ventas</b></dt>
        <dd>
          <ul>
                <li><a href="/sis_coesa/ventas/clientes/lista.php">Clientes</a></li>
                <li><a href="/sis_coesa/ventas/calc-cotizacion/lista.php">Cotización</a></li>
                <li><a href="/sis_coesa/ventas/datos-tecnicos-pt/lista.php">Datos Técnicos Básicos</a></li>
                <li><a href="/sis_coesa/ventas/costos-produccion/lista.php">Costos de Producción</a></li>
                <li><a href="/sis_coesa/ventas/pedidos/lista.php">Pedidos</a></li>
            </ul>
        </dd>
    <?php } ?>
    
    <?php if($usuario_priv==2 or $usuario_priv==3){ ?>
    <dt class="items"><b>Producción</b></dt>
        <dd>
          <ul>
          		<li><a href="/sis_coesa/produccion/datos-tecnicos-pt/lista.php">Datos Técnicos Producción</a></li>
          </ul>
        </dd>
    <?php } ?>
    
    <?php if($usuario_priv==2 or $usuario_priv==3){ ?>
    <dt class="items"><b>Mantenimiento del Sistema</b></dt>
        <dd>
          <ul>
                <li><a href="/sis_coesa/mantenimiento/cilindro/lista.php">Cilindro</a></li>
                <li><a href="/sis_coesa/mantenimiento/estado/lista.php">Estado</a></li>
                <li><a href="/sis_coesa/mantenimiento/maquinas/lista.php">Maquinas</a></li>
                <li><a href="/sis_coesa/mantenimiento/procesos/lista.php">Procesos Productivos</a></li>
                <li><a href="/sis_coesa/mantenimiento/articulos-tipo/lista.php">Tipo de Articulo</a></li>
                <li><a href="/sis_coesa/mantenimiento/maquinas-tipo/lista.php">Tipo de Máquina</a></li>
                <li><a href="/sis_coesa/mantenimiento/unidad-medida/lista.php">Uniades de Medida</a></li>
            </ul>
        </dd>
    <?php } ?>
        
    <dt class="items"><b>Usuario</b></dt>
        <dd>
          <ul>
          		<li><a href="/sis_coesa/chat/" target="_blank">Chat</a></li>
                <li><a href="/sis_coesa/usuarios/perfil/">Mi Perfil</a></li>
                <?php if($usuario_priv==3){ ?>
                <li><a href="/sis_coesa/usuarios/lista/lista.php">Lista de Usuarios</a></li>
                <li><a href="/sis_coesa/usuarios/tipos/lista.php">Tipos de Usuario</a></li>
                <?php } ?>
          </ul>
        </dd>
        
    <div id="img_progressbar" class="float_left an100 texto_cen padding_tb10">
    	<img src="/imagenes/progressbar.gif" name="progressbar" width="100" height="100" class="texto_cen ocultar" id="progressbar" ></div>
                
</dl><!-- FIN MENU -->