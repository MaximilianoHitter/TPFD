<?php
//require_once('../../config.php');
require_once('../templates/header2.php');

//CAMBIAR
$objUsuarioRolCon = new UsuarioRolController();
$arrayBusqueda = [];
$arrayRoles = $objUsuarioRolCon->getRoles();
$arrayUsuarios = $objUsuarioRolCon->getUsuarios();
$lista = $objUsuarioRolCon->listarTodo($arrayBusqueda);
if(array_key_exists('array', $lista)){
    //var_dump($lista['arrayHTML']); 
}
?>
<div class="container d-flex justify-content-center mt-5 mb-5">
    <table id="dg" title="Administrador de Usuarios" class="easyui-datagrid" style="width:700px;height:600px" url="accion/usuariorol_listar.php" toolbar="#toolbar" pagination="true" fitColumns="true" singleSelect="true">
        <thead>
            <tr>
                <th field="idur" width="50">Id</th>
                <th field="nombre" width="50">Nombre Usuario</th>
                <th field="rol" width="50">Rol</th>
            </tr>
        </thead>
    </table>
    <div id="toolbar">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUsuarioRol()">Nuevo Usuario-Rol</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyUsuarioRol()">Deshabilitar Usuario-Rol</a>  
    </div>
    <div id="dlg" class="easyui-dialog" style="width:600px;" data-options="closed:true,modal:true,border:'thin',buttons:'#dlg-buttons'">
    <form id="fm" method="POST" novalidate style="margin:0; padding:20px 50px;">
    <h3>Usuario-Rol Información</h3>
    <!-- <div style="margin-bottom:10px;">
        <input name="idusuario" id="idusuario" class="easyui-textbox" required="true" label="Id usuario" style="width:100%;">
    </div> -->
    <div style="margin-bottom:10px;">
    <!--TIENE QUE SER UN SELECT-->
        <input name="nombre" id="nombre" class="easyui-textbox" required="true" label="Usuario" style="width:100%;">
    </div>
    <div style="margin-bottom:10px;">
        <input name="rodescripcion" id="rodescripcion" class="easyui-textbox" required="true" label="Rol" style="width:100%;">
    </div>
    <!-- <div style="margin-bottom:10px;">
        <input name="usmail" id="usmail" class="easyui-textbox" required="true" label="Email" style="width:100%;">
    </div> -->
        
        
    </form>
    <div id="dlg-buttons">
        <a href="javascript:void(0)" class="easyui-button c6" iconCls="icon-ok" onclick="guardarUsuarioRol()" style="width:90px">Aceptar</a>
        <a href="javascript:void(0)" class="easyui-button" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancelar</a>
    </div>
    <script>
        var url;
        function newUsuarioRol(){
            $('#dlg').dialog('open').dialog('center').dialog('setTitle', 'Nuevo Usuario-Rol');
            $('#fm').form('clear');
            url='accion/insertar_usuariorol.php';
        }
        /* function editUsuario(){
            var row = $('#dg').datagrid('getSelected');
            if(row){
                $('#dlg').dialog('open').dialog('center').dialog('setTitle', 'Editar usuario');
                $('#fm').form('load', row);
                url='accion/edit_usuario.php?idusuario='+row.idusuario;
            }
        } */
        function guardarUsuarioRol(){
            $('#fm').form('submit', {
                url:url,
                onSubmit:function(){
                    return $(this).form('validate');
                },
                success:function(result){
                    var result=eval('('+result+')');
                    //alert('Volvio servidor');
                    if(!result.respuesta){
                        $.messager.show({
                            title:'Error',
                            msg:result.errorMsg
                        });
                    }else{
                        $('#dlg').dialog('close');
                        $('#dg').datagrid('reload');
                    }
                }
            })
        }
        function destroyUsuarioRol(){
            var row=$('#dg').datagrid('getSelected');
            if(row){
                $.messager.confirm('confirm', 'Seguro desea eliminar el rol del usuario?', function(r){
                    if(r){
                        $.post('accion/destroy_usuariorol.php?idur='+row.idur,{idur:row.id}, function(result){
                            alert('Volvio servidor');
                            if(result.respuesta){
                                $('#dg').datagrid('reload');
                            }else{
                                $.messager.show({
                                    title:'Error',
                                    msg:result.errorMsg
                                });
                            }
                        }, 'json');
                    }
                })
            }
        }
    </script>
        
    </div>
</div>

<?php require_once('../templates/footer.php') ?>