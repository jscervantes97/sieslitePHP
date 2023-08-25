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
            <h1 class="h2">Configuracion de usuarios</h1><br>  
        </div>
        <div class="d-flex flex-row g-3 align-items-center border-bottom">
            <div class="mb-3 col-md-2">
                <label for="srcUsuario" class="col-form-label h1">Buscar usuario:</label>
            </div>
            <div class="input-group mb-3 ">
                <input type="text" id="srcUsuario" onkeyup="buscarTeclado()" class="form-control">
                <div class="input-group-append">
                    <span class="input-group-text" ><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 20" width="16" height="24"><path d="M10.68 11.74a6 6 0 0 1-7.922-8.982 6 6 0 0 1 8.982 7.922l3.04 3.04a.749.749 0 0 1-.326 1.275.749.749 0 0 1-.734-.215ZM11.5 7a4.499 4.499 0 1 0-8.997 0A4.499 4.499 0 0 0 11.5 7Z"></path></svg></span>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <div id="divTabla">
                <table class="table">
                    <thead>
                        <tr>
                          <th scope="col">Nombre usuario</th>
                          <th scope="col">Rol</th>
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
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sieslite</h5>
                <button class="btn" type="button" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
              <h4><span id="tituloModal"></span></h4>
              <div class="d-flex flex-column">
                <label for="nombreUsuario" class="col-form-label col-md-4">Nombre usuario :</label>
                <input type="text" id="nombreUsuario" class="form-control">
                <label for="selectUsuario" class="col-form-label col-md-4">Tipo usuario :</label>
                <select class="form-select" id="selectUsuario">
                  <option selected value = 0 id="usrAdmin">Admin</option>
                  <option value=1 id="usrCajero">Cajero</option>
                </select>
                <label for="contra" class="col-form-label col-md-4">Contraseña :</label>
                <div class="col input-group mb-3">
                  <input type="password" id="contra" class="form-control">
                  <div class="input-group-append">
                      <span class="input-group-text" id="togglePassword" onClick="showPass()"><svg xmlns="http://www.w3.org/2000/svg" style="margin-top:5px;" width="16" height="24"><path d="M8 2c1.981 0 3.671.992 4.933 2.078 1.27 1.091 2.187 2.345 2.637 3.023a1.62 1.62 0 0 1 0 1.798c-.45.678-1.367 1.932-2.637 3.023C11.67 13.008 9.981 14 8 14c-1.981 0-3.671-.992-4.933-2.078C1.797 10.83.88 9.576.43 8.898a1.62 1.62 0 0 1 0-1.798c.45-.677 1.367-1.931 2.637-3.022C4.33 2.992 6.019 2 8 2ZM1.679 7.932a.12.12 0 0 0 0 .136c.411.622 1.241 1.75 2.366 2.717C5.176 11.758 6.527 12.5 8 12.5c1.473 0 2.825-.742 3.955-1.715 1.124-.967 1.954-2.096 2.366-2.717a.12.12 0 0 0 0-.136c-.412-.621-1.242-1.75-2.366-2.717C10.824 4.242 9.473 3.5 8 3.5c-1.473 0-2.825.742-3.955 1.715-1.124.967-1.954 2.096-2.366 2.717ZM8 10a2 2 0 1 1-.001-3.999A2 2 0 0 1 8 10Z"></path></svg></span>
                  </div>
                </div>                
              </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancelar</button>
                <button class="btn btn-primary" onclick="guardarDatos()">Guardar</button>
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
        function showPass(){
          
          const password = document.getElementById('contra');
          let type = password
                .getAttribute('type') === 'password' ?
                'text' : 'password';
            password.setAttribute('type', type);
        }
        let usuarios = [];
        let usuarioBuscar = "" ; 
        let usuarioSeleccionado = null  ;
        let indexUsr = null ;
        let usrSearch = "" ;


        async function initComponents(){
          await cargaUsuarios();
          await renderTabla();
        }

        async function buscarTeclado(){
          usrSearch = document.getElementById("srcUsuario").value ; 
          initComponents();
        }

        async function cargaUsuarios(){
          const response = await fetch('http://localhost/sieslite/api/usuario.php?opc=2', {
              method: 'POST',
              headers: {
                  'Content-Type': 'application/json'
              },
              body: JSON.stringify({"nombreUsuario": usrSearch , "limite" : 0})
          });
          const json = await response.json();
          usuarios = json.data ; 
        }
        async function renderTabla(){
          console.log('Calling renderTabla');
          
            let tableSalida  = `<table class="table">
                    <thead>
                        <tr>
                        <th scope="col">Nombre usuario</th>
                        <th scope="col">Rol</th>
                        <th scope="col"></th>
                        <th scope="col"><button class="btn btn-primary" onclick="editarCrearUsuario(null)"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path d="M7.75 2a.75.75 0 0 1 .75.75V7h4.25a.75.75 0 0 1 0 1.5H8.5v4.25a.75.75 0 0 1-1.5 0V8.5H2.75a.75.75 0 0 1 0-1.5H7V2.75A.75.75 0 0 1 7.75 2Z"></path></svg></button></th>

                        </tr>
                    </thead><tbody>`;
            usuarios.map((user , index)=> {
                tableSalida += `<tr>
                    <th scope="row">${user.nombreUsuario}</th>
                    <th>${user.rol}</th>
                    <th><button class="btn btn-primary" onClick="editarCrearUsuario(${index})"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path d="M11.013 1.427a1.75 1.75 0 0 1 2.474 0l1.086 1.086a1.75 1.75 0 0 1 0 2.474l-8.61 8.61c-.21.21-.47.364-.756.445l-3.251.93a.75.75 0 0 1-.927-.928l.929-3.25c.081-.286.235-.547.445-.758l8.61-8.61Zm.176 4.823L9.75 4.81l-6.286 6.287a.253.253 0 0 0-.064.108l-.558 1.953 1.953-.558a.253.253 0 0 0 .108-.064Zm1.238-3.763a.25.25 0 0 0-.354 0L10.811 3.75l1.439 1.44 1.263-1.263a.25.25 0 0 0 0-.354Z"></path></svg></th>
                    <th><button class="btn btn-danger" onClick="removerUsuario(${index})"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 12 12" width="12" height="12"><path d="M2.22 2.22a.749.749 0 0 1 1.06 0L6 4.939 8.72 2.22a.749.749 0 1 1 1.06 1.06L7.061 6 9.78 8.72a.749.749 0 1 1-1.06 1.06L6 7.061 3.28 9.78a.749.749 0 1 1-1.06-1.06L4.939 6 2.22 3.28a.749.749 0 0 1 0-1.06Z"></path></svg></button></th>  
                    </tr>`; 
            });
            
            tableSalida += `</tbody></table>`;
            document.getElementById("divTabla").innerHTML = tableSalida ; 
        }

        function editarCrearUsuario(indice){
          console.log(usuarioSeleccionado);
          let dnd = document.querySelector('#selectUsuario');
          if(indice == null){
            usuarioSeleccionado = null ;
            document.getElementById("tituloModal").textContent = 'Nuevo Usuario';
            document.getElementById("nombreUsuario").value = '' ; 
            document.getElementById("contra").value = '' ; 
            dnd.value = 1 ; 
          }else{
            document.getElementById("tituloModal").textContent = 'Editar Usuario';
            usuarioSeleccionado = obtenerUsuarioArrayIndice(indice);
            //console.log(usuarioSeleccionado);
            dnd.value = usuarioSeleccionado.rol  == 'ADMIN'  ? 0 : 1 ; 
            document.getElementById("nombreUsuario").value = usuarioSeleccionado.nombreUsuario;
            document.getElementById("contra").value = usuarioSeleccionado.contra;
          }
          let modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('editModal'));
          modal.show();
           //modal.hide();
        }

        async function guardarDatos(){
          let dnd = document.querySelector('#selectUsuario').value ;
          let nombreUsuario = document.getElementById("nombreUsuario").value ;
          let contra = document.getElementById("contra").value ;
          if(nombreUsuario === "" ||contra === ""){
            Swal.fire('Faltan datos por llenar... verifique el formulario¡', '', 'info');
            return ; 
          }
          let usuarioJson = {
            "idUsuario": usuarioSeleccionado == null ? 0 : usuarioSeleccionado.idUsuario,
            "nombreUsuario": nombreUsuario,
            "contra": contra,
            "rol": dnd = dnd == 0 ? 'ADMIN' : 'CAJERO',
            "status": 1
          }
          const opcionApi = usuarioSeleccionado == null ? 3 : 4 ;  
          console.log('opcion del api a mandar a llamar' + opcionApi)
          let respuestaDialog = await Swal.fire({
            title: 'Datos Correctos?',
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: 'Aceptar',
            denyButtonText: `Cancelar`,
          }) ; 
          if(respuestaDialog.isConfirmed){
            const response = await fetch('http://localhost/sieslite/api/usuario.php?opc='+opcionApi, {
            method: 'POST',
            headers: {
                  'Content-Type': 'application/json'
              },
              body: JSON.stringify(usuarioJson)
            });
            const json = await response.json();
           

            if(json.msg.toLowerCase().includes("duplicate")){
              Swal.fire('Error, ya existe un usuario con ese nombre dado de alta,  intente con otro¡', '', 'info');
            }
            else{
              Swal.fire(json.msg, '', 'success');
              usuarioSeleccionado = null ;
              let modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('editModal'));
              modal.hide();
              await initComponents();
            }
          }
        }

        async function removerUsuario(indice){
          usuarioBorrar =obtenerUsuarioArrayIndice(indice);
          let respuestaDialog = await Swal.mixin({
            customClass: {
              confirmButton: 'btn btn-success',
              cancelButton: 'btn btn-danger',
              denyButton: 'btn btn-danger'
            },
            buttonsStyling: false
          }).fire({
            title: 'Dese eliminar el usuario seleccionado?',
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: 'Aceptar',
            denyButtonText: `Cancelar`,
            cancelButtonText : 'Cancelar'
          }) ; 
          if(respuestaDialog.isConfirmed){
            let usuarioJson = {
            "idUsuario": usuarioBorrar.idUsuario,
            }
            const response = await fetch('http://localhost/sieslite/api/usuario.php?opc=5', {
            method: 'POST',
            headers: {
                  'Content-Type': 'application/json'
              },
              body: JSON.stringify(usuarioJson)
            });
            const json = await response.json();
            

            if(json.msg.toLowerCase().includes("error")){
              Swal.fire('Ocurrio el siguiente error ' + json.msg, '', 'danger');
            }
            else{
              Swal.fire(json.msg, '', 'success');
              await initComponents();
            }
          }
        }

        function obtenerUsuarioArrayIndice(indice){
           return usuarios.filter((user , index) => indice == index)[0];
        }

    </script>
  </body>
</html>
