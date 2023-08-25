<?php 
require 'utilerys/sesionManager.php';
?>
<!doctype html>
<html lang="en">
  <?php
    require_once 'components/head.php'
  ?>
  <body onload="inicializarVenta()">
    
  <?php
    require_once 'components/header.php' 
  ?>

  <div class="container-fluid">
    <div class="row">
      <?php
        require_once 'components/sidebarMenu.php'
      ?>

      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Punto de Venta</h1><br>  
        </div>
        <div class="row g-3 align-items-center border-bottom">
            <div class="col mb-3">
                <label for="codigoArticulo" class="col-form-label">Codigo Articulo</label>
            </div>
            <div class="col input-group mb-3">
                <input type="text" id="codigoArticulo" class="form-control" onkeyup="enterCodigoArticulo(event)">
                <div class="input-group-append">
                    <span class="input-group-text" onclick="abrirModalArticulos()"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 20" width="16" height="24"><path d="M10.68 11.74a6 6 0 0 1-7.922-8.982 6 6 0 0 1 8.982 7.922l3.04 3.04a.749.749 0 0 1-.326 1.275.749.749 0 0 1-.734-.215ZM11.5 7a4.499 4.499 0 1 0-8.997 0A4.499 4.499 0 0 0 11.5 7Z"></path></svg></span>
                </div>
            </div>
            <div class="col mb-3">
                <label for="codigoArticulo" class="col-form-label">Precio Unitario</label>
            </div>
            <div class="col mb-3">
                <input type="text" id="precioUnitario" class="form-control" readonly>
            </div>
            <div class="col mb-3">
                <label for="cantidad" class="col-form-label">Cantidad</label>
            </div>
            <div class="col mb-3">
                <input number="text" id="cantidad" class="form-control" onkeyup="enterCantidad(event)">
            </div>
        </div>
        <div class="d-flex flex-column justify-content-between flex-wrap flex-md-nowrap  pt-3 pb-2 mb-3 border-bottom">
            <span id="spanFolio" class="h3">Folio venta: </span>
            <div id="divTabla">
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">Codigo Articulo</th>
                        <th scope="col">Nombre Articulo</th>
                        <th scope="col">Cantidad Articulos</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Total</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>              
            </div>
           
        </div>  
      </main>
    </div>
  </div>
  <div class="modal fade" id="modalArticulos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sieslite</h5>
                <button class="btn" type="button" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <h4><span>Busqueda de articulos</span></h4>
                <div class="d-flex flex-column">
                        <div class="d-flex flex-row g-3 align-items-center border-bottom">
                            <div class="mb-3 col-md-2">
                                <label for="codigoArticulo" class="col-form-label h1">Buscar articulo:</label>
                            </div>
                            <div class="input-group mb-3 ">
                                <input type="text" id="srcBuscarArticulo" onkeyup="buscarTeclado()" class="form-control">
                                <div class="input-group-append">
                                    <span class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 20" width="16" height="24"><path d="M10.68 11.74a6 6 0 0 1-7.922-8.982 6 6 0 0 1 8.982 7.922l3.04 3.04a.749.749 0 0 1-.326 1.275.749.749 0 0 1-.734-.215ZM11.5 7a4.499 4.499 0 1 0-8.997 0A4.499 4.499 0 0 0 11.5 7Z"></path></svg></span>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom overflow-auto">
                            
                                <div id="divTablaModal">
                                    
                                </div>
                            
                        </div>  
                </div>
            </div>
            
        </div>
    </div>
  </div>
  <?php
    require_once 'components/logoutModal.php' 
  ?>
    <script src="assets/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
    <script type="text/javascript">
        let articulos = [];
        let idVenta = 0 ; 
        let idCorte = null ; 
        let articulosModal = [] ;
        let srcArticulo = "" ; 
        let articuloSeleccionado = null ; 
        let tipoPago = 0 ; 
        let objVenta = null ;
        let totalArticulos = 0.0 ;
        let totalVenta = 0 ; 
        

        async function inicializarVenta(){
            console.log('Calling inicializarVenta')
            articuloSeleccionado = null ; 
            const responseCorte = await fetch('http://localhost/sieslite/api/corte.php?opc=2', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                }
            });
            const json1 = await responseCorte.json();
            console.log(json1) ;
            if(json1.data == null){
                document.getElementById("spanFolio").textContent = 'Favor de generar un corte en curso para poder vender';
                return ;
            }
            idCorte = json1.data.idCorte ;

            let objJson = {
                "status"  : 2,
                "totalArticulos" : 0,
                "totalVenta" : 0.0 ,
                "idUsuario" : <?php echo $_SESSION['idUsuario'] ?>,
                "idCorte" : idCorte
            } 
            console.log(objJson);
            const response = await fetch('http://localhost/sieslite/api/ventas.php?opc=3', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(objJson)
            });
            const json = await response.json();
            console.log(json) ;
            idVenta = json.data ;
            document.getElementById("spanFolio").textContent = 'Folio venta: ' + idVenta.toString().padStart(5, '0');
        }
        

        async function cargarDatosTablaArticulosModal(){
            const response = await fetch('http://localhost/sieslite/api/articulos.php?opc=1', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({"codigo": srcArticulo , "nombre" : srcArticulo})
            });
            const json = await response.json();
            articulosModal = json.data ; 
            //console.log(articulosModal)
        }

        async function buscarTeclado(){
            srcArticulo = document.getElementById("srcBuscarArticulo").value ; 
            await cargarDatosTablaArticulosModal();
            await renderTablaModal();
        }

        async function renderTablaModal(){
            let tableSalida  = `<table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Codigo Articulo</th>
                            <th scope="col">Nombre Articulo</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Existencia</th>
                        </tr>
                    </thead><tbody>`;
            articulosModal.map((articulo , index)=> {
                tableSalida += `<tr onClick="asignarArticuloDesdeModal(${index})">
                    <th scope="row">${articulo.codigo}</th>
                    <th>${articulo.nombre}</th>
                    <th>${articulo.precio}</th>
                    <th>${articulo.existencia}</th>
                    </tr>`; 
            });
            
            tableSalida += `</tbody></table>`;
            if(articulosModal.length == 0){
              tableSalida += `<h3><center>Sin Registros</center></h3>`;  
            }
            document.getElementById("divTablaModal").innerHTML = tableSalida ; 
        }

         function asignarArticuloDesdeModal(index){
            articuloSeleccionado = obtenerArticuloArrayIndice(index);
            document.getElementById("codigoArticulo").value = articuloSeleccionado.codigo ;
            abrirCerrarModal(1); 
            document.getElementById("codigoArticulo").focus() ;
        }

        async function abrirModalArticulos(){
            abrirCerrarModal(0);
        }

        async function enterCodigoArticulo(event){
            
            let keycode = event.keyCode;
            console.log(event)
            if(keycode == '13' && idCorte != null){
                let srcCodigo = document.getElementById("codigoArticulo").value ;
                //alert('You pressed a "enter" key in textbox'); 
                if(articuloSeleccionado != null){
                    document.getElementById("precioUnitario").value = articuloSeleccionado.precio ;
                    document.getElementById("cantidad").focus() ;
                }else if(srcCodigo !== ""){
                    
                    const response = await fetch('http://localhost/sieslite/api/articulos.php?opc=1', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({"codigo": srcCodigo , "nombre" : null})
                    });
                    const json = await response.json();
                    
                    if(json.data.length == 0){
                        Swal.fire('No se encontro ningun articulo con ese codigo', '', 'info');
                        return ; 
                    }
                    articuloSeleccionado = json.data[0];
                    document.getElementById("precioUnitario").value = articuloSeleccionado.precio ;
                    document.getElementById("cantidad").focus() ;
                }else{
                    Swal.fire('Favor de ingresar un codigo para su busqueda', '', 'info');
                }
            }
        }

        async function enterCantidad(event){
            
            let keycode = event.keyCode;
            let cantidadTxt =  parseFloat(document.getElementById("cantidad").value) ;
            if(keycode == '13' && articuloSeleccionado!= null && cantidadTxt > 0){
               
                //document.getElementById("precioUnitario").value = articuloSeleccionado.precio ;
                
                let total =parseFloat(cantidadTxt *articuloSeleccionado.precio);
                let objetoArticuloVenta = {
                    idArticulo : articuloSeleccionado.idArticulo ,
                    codigo : articuloSeleccionado.codigo,
                    nombreArticulo : articuloSeleccionado.nombre,
                    idVenta : idVenta ,
                    cantidad: cantidadTxt ,
                    precioUnitario : articuloSeleccionado.precio,
                    total : total,
                    status : 1 
                };
                articulos.push(objetoArticuloVenta);
                articuloSeleccionado = null ; 
                renderTabla();
                document.getElementById("srcBuscarArticulo").value = "" ;
                document.getElementById("codigoArticulo").value = "" ;
                document.getElementById("cantidad").value = "" ;
                document.getElementById("precioUnitario").value = "" ;
                srcArticulo = "" ; 
                document.getElementById("codigoArticulo").focus() ;  
                
            }
        }

        async function realizarCobro(){
            let objJson = {
                "status"  : 1,
                "totalArticulos" : totalArticulos,
                "totalVenta" : totalVenta ,
                "idUsuario" : <?php echo $_SESSION['idUsuario'] ?>,
                "idCorte" : idCorte ,
                "idVenta" :idVenta ,
                "articulos" : articulos ,
                "tipoPago" :tipoPago 
            } 
            console.log(objJson);
            const { value: formValues } = await Swal.fire({
            title: 'Realizar Cobro',
            html:
                `Total a pagar: $${totalVenta}<br>`+
                `Paga con: <input required type="number" id="swal-input2" class="swal2-input">`,
            focusConfirm: false,
            preConfirm: () => {
                return document.getElementById('swal-input2').value ;
                
            } 
            });

            if (!formValues) {
                Swal.fire('Favor de llenar el campo del pago', '', 'info');
                return ; 
            }
            if (formValues < 0) {
                Swal.fire('El monto a pagar debe ser mayor a 0', '', 'info');
                return ; 
            }

            if (formValues < totalVenta) {
                Swal.fire('Con esa cantidad no salda la cuenta', '', 'info');
                return ; 
            }
            
            const response = await fetch('http://localhost/sieslite/api/ventas.php?opc=4', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(objJson)
            });
            const json = await response.json();
            console.log(json)
            Swal.fire('Venta Realizada con exito¡', 'Su cambio es $' + parseFloat(formValues - totalVenta), 'success');
            
            articulos =  [] ;
            await renderTabla();
            await inicializarVenta();
            
        }

        function renderTabla(){
            let totalArticulosR = 0.0 ;
            let totalVentaR = 0 ; 
            let tableSalida  = `<span id="spanFolio" class="h3"></span><table class="table" id="tablaVenta">
                    <thead>
                        <tr>
                        <th scope="col">Codigo Articulo</th>
                        <th scope="col">Nombre Articulo</th>
                        <th scope="col">Cantidad Articulos</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Total</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        </tr>
                    </thead><tbody>`;
            articulos.map((articulo , index)=> {
                console.log(articulo);
                tableSalida += `<tr>
                    <th scope="row">${articulo.codigo}</th>
                    <th>${articulo.nombreArticulo}</th>
                    <th>${articulo.cantidad}</th>
                    <th>${articulo.precioUnitario}</th>
                    <th>${articulo.total}</th>
                    <th><button class="btn btn-primary" onClick="editarArticulo(${index})"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path d="M11.013 1.427a1.75 1.75 0 0 1 2.474 0l1.086 1.086a1.75 1.75 0 0 1 0 2.474l-8.61 8.61c-.21.21-.47.364-.756.445l-3.251.93a.75.75 0 0 1-.927-.928l.929-3.25c.081-.286.235-.547.445-.758l8.61-8.61Zm.176 4.823L9.75 4.81l-6.286 6.287a.253.253 0 0 0-.064.108l-.558 1.953 1.953-.558a.253.253 0 0 0 .108-.064Zm1.238-3.763a.25.25 0 0 0-.354 0L10.811 3.75l1.439 1.44 1.263-1.263a.25.25 0 0 0 0-.354Z"></path></svg></th>
                    <th><button class="btn btn-danger" onClick="removerArticulo(${index})"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 12 12" width="12" height="12"><path d="M2.22 2.22a.749.749 0 0 1 1.06 0L6 4.939 8.72 2.22a.749.749 0 1 1 1.06 1.06L7.061 6 9.78 8.72a.749.749 0 1 1-1.06 1.06L6 7.061 3.28 9.78a.749.749 0 1 1-1.06-1.06L4.939 6 2.22 3.28a.749.749 0 0 1 0-1.06Z"></path></svg></button></th>  
                    </tr>`; 
                totalArticulosR += articulo.cantidad ;
                totalVentaR +=articulo.total;
            });
            if(articulos.length > 0){
                tableSalida += `<tr>
                    <th></th>    
                    <th>Total Articulos</th>
                    <th>${totalArticulosR}</th>
                    <th>Total Venta: </th>
                    <th>$${totalVentaR}</th>   
                    <th></th>
                    <th></th>        
                </tr>`;
                tableSalida += `<tr>
                    <th colspan = 3></th>    
                    <th class="mb-3">Pago con: </th>
                    <th class="mb-3" colspan=2>
                        <select class="form-select" onChange="cambiarTipoPago()">
                            <option selected value = 0>Efectivo</option>
                            <option value=1>Tarjeta</option>
                        </select>
                    </th>
                    <th><button class="btn btn-primary" onClick="realizarCobro()">Realizar Cobro</th>       
                </tr>`;
            }
            
            tableSalida += `</tbody></table>`;
            totalArticulos =totalArticulosR ;
            totalVenta =totalVentaR;
            document.getElementById("divTabla").innerHTML = tableSalida ; 
        }

        function removerArticulo(indice){
            artFiltered = articulos.filter((articulo  , index)=> index != indice);
            articulos = artFiltered ;
            renderTabla();
        }

        function cambiarTipoPago(){
            tipoPago = tipoPago == 0 ? 1 : 0 ; 
            console.log(tipoPago)
        }

        function obtenerArticuloArrayIndice(indice){
           return articulosModal.filter((art , index) => indice == index)[0];
        }

        function abrirCerrarModal(opcion){
            let modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('modalArticulos'));
            if(opcion==0) 
            modal.show() 
            else 
            modal.hide();
        }

       

    </script>
</body>
</html>
