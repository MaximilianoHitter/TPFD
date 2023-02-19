<?php
require_once('../templates/header2.php');
//require_once('../../config.php');
/* $objConPro = new ProductoController();
$lista = $objConPro->listarTodo(); */
?>

<div class="container d-flex justify-content-center mt-5 mb-5">
    <table id="dg" title="Administrador de Compras" class="easyui-datagrid" style="width:700px;height:600px" url="accion/listar_compra.php" toolbar="#toolbar" pagination="true" fitColumns="true" singleSelect="true">
        <thead>
            <tr>
                <th field="idcompra" width="50">Id Compra</th>
                <th field="cofecha" width="50">Fecha</th>
                <th field="idusuario" width="50">Id Usuario</th>
            </tr>
        </thead>
    </table>
    <div id="toolbar">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newCompra()">Nueva Compra</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editCompra()">Editar Compra</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyCompra()">Destroy Compra</a>  
    </div>
    <div id="dlg" class="easyui-dialog" style="width:600px;" data-options="closed:true,modal:true,border:'thin',buttons:'#dlg-buttons'">
    <form id="fm" method="POST" novalidate style="margin:0;padding:20px 50px;">
    <h3>Compra informacion</h3>
    <!-- <div style="margin-bottom:10px;">
        <input name="idcompra" id="idcompra" class="easyui-textbox" required="true" label="Id compra" style="width:100%;">
    </div>
    <div style="margin-bottom:10px;">
        <input name="cofecha" id="cofecha" class="easyui-textbox" required="true" label="compra fecha" style="width:100%;">
    </div> -->
    <div style="margin-bottom:10px;">
        <input name="idusuario" id="idusuario" class="easyui-textbox" required="true" label="Id Compra" style="width:100%;">
    </div>    
    </form>
    <div id="dlg-buttons">
        <a href="javascript:void(0)" class="easyui-button c6" iconCls="icon-ok" onclick="guardarCompra()" style="width:90px">Aceptar</a>
        <a href="javascript:void(0)" class="easyui-button" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancelar</a>
    </div>
    <script>
        var url;
        function newCompra(){
            $('#dlg').dialog('open').dialog('center').dialog('setTitle', 'Nuevo compra');
            $('#fm').form('clear');
            url='accion/insertar_compra.php';
        }
        function editCompra(){
            var row = $('#dg').datagrid('getSelected');
            if(row){
                $('#dlg').dialog('open').dialog('center').dialog('setTitle', 'Editar compra');
                $('#fm').form('load', row);
                url='accion/edit_compra.php?idcompra='+row.idcompra;
            }
        }
        function guardarCompra(){
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
        function destroyCompra(){
            var row=$('#dg').datagrid('getSelected');
            if(row){
                $.messager.confirm('confirm', 'Seguro desea eliminar el compra?', function(r){
                    if(r){
                        $.post('accion/destroy_compra.php?idcompra='+row.idcompra,{idcompra:row.id}, function(result){
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