<?php
require_once('../templates/preheader.php');
$objRolCon = new RolController();
try {
    $rol = $objSession->getRolPrimo();
    if ($rol != '') {
        if ($rol == 'Admin') {
            $list = $objRolCon->listarTodo();
            $lista = [];
            foreach ($list as $key => $value) {
                $datos = $value->dameDatos();
                array_push($lista, $datos);
            }
        } elseif ($rol == 'Cliente' || $rol == 'Deposito') {
            $lista = [];
        }
    }
} catch( \Throwable $th ){
    $rol = '';
    $lista = []; //  ['idproducto' => '', 'pronombre' => '', 'sinopsis'=>'', 'procantstock'=>'', 'autor'=>'', 'precio'=>'', 'isbn'=>'', 'categoria'=>''];
}

?>
<!-- datatables --> 
<!-- <div class="container-fluid p-5 d-flex justify-content-center rol">
    <div class="row col-md-12">
        <div class="col-md-6" style="background-color:white;">
            <table class="table table-light" id="tabla_de_roles">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Descripción</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        /* if(count($lista) > 0){
                            foreach ($lista as $key => $value) {
                                echo '<tr>';
                                echo '<td><input type="hidden" id="'.$value['idrol'].'" value="'.$value['idrol'].'">'.$value['idrol'].' </td>';
                                echo '<td><span id="rodescripcion'.$value['idrol'].'">'.$value['rodescripcion'].'</span></td>';
                                echo '<td><button class="btn btn-success" onclick="editar('.$value['idrol'].')">Editar</button><button class="btn btn-danger" onclick="borrar('.$value['idrol'].')">Borrar</button></td>';
                                echo '</tr>';
                            }
                        }else{
                            echo '<tr> <td></td> <td></td> <td></td> </tr>';
                        } */
                    ?>
                    
                </tbody>
            </table>
        </div>
    </div>
</div>-->

<!-- modal de edicion -->
<div class="modal" tabindex="-1" role="dialog" id="mymodal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edición de Rol</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p id="texto"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="cerrarModal()">Close</button>
      </div>
    </div>
  </div>
</div>-->

<!-- modal de borrar -->
<!--<div class="modal" tabindex="-1" role="dialog" id="mymodalBorrar">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edición de Rol</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p id="textoBorrar"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="cerrarModalBorrar()">Close</button>
      </div>
    </div>
  </div>
</div> -->

<script>
    var base_url = 'http://localhost/TPFD/Views/rol';

    document.addEventListener('DOMContentLoaded', function () {
        let table = new DataTable('#tabla_de_roles');
    });

    function editar(id){
        $.ajax('accion/algo.php?idrol=' + id,
            { dataType: 'html', // type of response data
                success: function (data) {   // success callback function
                    console.log(data);
                    datos = JSON.parse(data);
                    $('#texto').text('Edición del rol con id:'+datos.idrol+' y nombre '+datos.rodescripcion);
                    $('#mymodal').modal('show');
                }
            });
    }

    function borrar(id){
        console.log('borrar el id:'+id);
        $.ajax('accion/borrar.php?idrol=' + id,
            { dataType: 'html', // type of response data
                success: function (data) {   // success callback function
                    console.log(data);
                    datos = JSON.parse(data);
                    $('#textoBorrar').text('Edición del rol con id:'+datos.idrol+' y nombre '+datos.rodescripcion);
                    $('#mymodalBorrar').modal('show');
                }
            });
    }

    function cerrarModal(){
        $('#mymodal').modal('hide');
    }

    function asd(id){
        fetch(base_url+'/accion/pepe/'+id, {
            method: 'GET', // or 'PUT'
            async: true,
            headers: {
                'Content-Type': 'application/json'
            }
        }).then(res => res.json())
        .then(response => ver_respuesta(response));
    }

    function ver_respuesta(response) {
        console.log(response);
    }

    function cerrarModalBorrar(){
        $('#mymodalBorrar').modal('hide');
    }
</script>


<!-- easy ui -->
<div class="container-fluid p-5 my-1 d-flex justify-content-center rol">
    <div class="row">
        <div class="col-sm-12">

            <table id="dg" title="Administrador de Roles" class="easyui-datagrid" style="width:1200px; height:700px" url="accion/listar_rol.php" toolbar="#toolbar" pagination="true" fitColumns="true" singleSelect="true">
                <thead>
                    <tr>
                        <th field="idrol" width="50">Id</th>
                        <th field="rodescripcion" width="50">Descripción</th>
                    </tr>
                </thead>
            </table>
            
            <div id="toolbar" style="padding:4px">
                <?php
                if ($rol == 'Admin') {
                    echo "<a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" iconCls=\"icon-add\" plain=\"true\" onclick=\"newRol()\">Nuevo Rol</a>
                    <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" iconCls=\"icon-edit\" plain=\"true\" onclick=\"editRol()\">Editar Rol</a>
                    <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" iconCls=\"icon-remove\" plain=\"true\" onclick=\"destroyRol()\">Deshabilitar Rol</a>";
                }
                ?>
            </div>

            <div id="dlg" class="easyui-dialog" style="width:600px;" data-options="closed:true,modal:true,border:'thin',buttons:'#dlg-buttons'">
                <form id="fm" method="POST" novalidate style="margin:0; padding:20px 50px;">
                    <h3>Rol Información</h3>
                    <div style="margin-bottom:10px;">
                        <input name="rodescripcion" id="rodescripcion" class="easyui-textbox" required="true" label="Nombre" style="width:100%;">
                    </div>
                </form>
                <div id="dlg-buttons">
                    <a href="javascript:void(0)" class="easyui-button c6" iconCls="icon-ok" onclick="guardarRol()" style="width:90px">Aceptar</a>
                    <a href="javascript:void(0)" class="easyui-button" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancelar</a>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    var url;

    function newRol() {
        $('#dlg').dialog('open').dialog('center').dialog('setTitle', 'Nuevo rol');
        $('#fm').form('clear');
        url = 'accion/insertar_rol.php';
    }

    function editRol() {
        var row = $('#dg').datagrid('getSelected');
        if (row) {
            $('#dlg').dialog('open').dialog('center').dialog('setTitle', 'Editar rol');
            $('#fm').form('load', row);
            url = 'accion/edit_rol.php?idrol=' + row.idrol;
        }
    }

    function guardarRol() {
        $('#fm').form('submit', {
            url: url,
            onSubmit: function() {
                return $(this).form('validate');
            },
            success: function(result) {
                var result = eval('(' + result + ')');
                //alert('Volvio servidor');
                if (!result.respuesta) {
                    $.messager.show({
                        title: 'Error',
                        msg: result.errorMsg
                    });
                } else {
                    $('#dlg').dialog('close');
                    $('#dg').datagrid('reload');
                }
            }
        })
    }

    function destroyRol() {
        var row = $('#dg').datagrid('getSelected');
        if (row) {
            $.messager.confirm('confirm', 'Seguro desea eliminar el rol?', function(r) {
                if (r) {
                    $.post('accion/destroy_rol.php?idrol=' + row.idrol, {
                        idrol: row.id
                    }, function(result) {
                        alert('Volvio servidor');
                        if (result.respuesta) {
                            $('#dg').datagrid('reload');
                        } else {
                            $.messager.show({
                                title: 'Error',
                                msg: result.errorMsg
                            });
                        }
                    }, 'json');
                }
            })
        }
    }

</script>

<style type="text/css">
    .rol {
        background-color: #006d31;
        color: white;
    }
</style>

<?php require_once( '../templates/footer.php' ) ?>