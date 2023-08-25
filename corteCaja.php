<?php 
require 'utilerys/sesionManager.php';
?>
<!doctype html>
<html lang="en">
  <?php
    require_once 'components/head.php'
  ?>
  <body onload="initComponents()">
    
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
          <h1 class="h2">Corte Caja</h1>
        </div>
        <div id="noCorte">
          <h3>
            No hay algun corte en curso
          </h3><br>
          <button class="btn btn-primary" onclick="generarCorte()">Generar nuevo corte</button>
        </div>
        <div id="bodyCorte">
          <div class="d-flex flex-column h3 border" >
              <div class="p-2 d-flex flex-row border-bottom">
                  <span  class="p-2">Folio de Corte: </span><span id="spanFolio" class="p-2"> 0001</span>
              </div>
              <div class="p-2 d-flex flex-row border-bottom">
                  <span class="p-2">Fecha y hora de inicio: </span><span id="spanFechaHora" class="p-2"> 06/08/2023 23:34</span>
              </div>
              <div class="p-2 d-flex flex-row border-bottom">
                  <span class="p-2">Folio Primer venta: </span><span id="spanPrimerVenta" class="p-2"> 0001</span>
              </div>
              <div class="p-2 d-flex flex-row border-bottom">
                  <span class="p-2">Folio Ultima venta: </span><span id="spanUltimaVenta"  class="p-2"> 0002</span>
              </div>
              <div class="p-2 d-flex flex-row border-bottom">
                  <span class="p-2">Numero de ventas: </span><span id="spanTotalVentas"  class="p-2"> 200</span>
              </div>
              <div class="p-2 d-flex flex-row border-bottom">
                  <span class="p-2">Total vendido: </span><span id="spanTotalVendido"  class="p-2"> 2000$</span>
              </div>
              <div class="p-2 d-flex flex-row border-bottom">
                  <div class="p-2"><button class="btn btn-primary" onclick="realizarCorte()">Realizar Corte</button></div>
              </div>
          </div>
        </div>
      </main>
    </div>
  </div>
  <?php
    require_once 'components/logoutModal.php' 
  ?>
    <script src="assets/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
    <script type="text/javascript">
      idCorte = null ; 
      async function initComponents(){
        const responseCorte = await fetch('http://localhost/sieslite/api/corte.php?opc=2', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            }
        });
        const json1 = await responseCorte.json();
        console.log(json1) ;
        if(json1.data == null){
            document.getElementById("noCorte").style.display = "block";
            document.getElementById("bodyCorte").style.display = "none";
            return ;
        }
        document.getElementById("noCorte").style.display = "none";
        document.getElementById("bodyCorte").style.display = "block";
        idCorte = json1.data.idCorte ; 
        let idPrimerVenta =json1.data.idPrimerVenta == null ? "Sin venta" : json1.data.idPrimerVenta.toString().padStart(5, '0');
        let idUltimaVenta =json1.data.idUltimaVenta == null ? "Sin venta" : json1.data.idUltimaVenta.toString().padStart(5, '0');
        document.getElementById("spanFolio").textContent = idCorte.toString().padStart(5, '0');
        document.getElementById("spanFechaHora").textContent = json1.data.fechaInicio;
        document.getElementById("spanPrimerVenta").textContent = idPrimerVenta;
        document.getElementById("spanUltimaVenta").textContent = idUltimaVenta;
        document.getElementById("spanTotalVentas").textContent = json1.data.totalVentas + " de ventas realizadas";
        document.getElementById("spanTotalVendido").textContent = "$" + json1.data.totalVendido ;
      }

      async function generarCorte(){
        const responseCorte = await fetch('http://localhost/sieslite/api/corte.php?opc=1', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            }
        });
        await initComponents();
      }

      async function realizarCorte(){
        let respuestaDialog = await Swal.fire({
          title: 'Desea terminar el Corte?',
          showDenyButton: true,
          showCancelButton: false,
          confirmButtonText: 'Aceptar',
          denyButtonText: `Cancelar`,
        }) ; 
        console.log(respuestaDialog);
        if(respuestaDialog.isDenied){
          return ; 
        }
        const responseCorte = await fetch('http://localhost/sieslite/api/corte.php?opc=3', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            }
        });
        let dataJson = await responseCorte.json();
        Swal.fire('Corte realizado con exito', '', 'success');
        await initComponents();
      }     
    </script>
  </body>
</html>
