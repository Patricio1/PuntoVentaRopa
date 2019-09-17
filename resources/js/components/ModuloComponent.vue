<template>
    <div class="tabs-wrapper text-center">             
             <div class="panel box-shadow-none text-left content-header">
                  <div class="panel-body" style="padding-bottom:0px;">
                    <div class="col-md-12">
                        <h3 class="animated fadeInLeft">GESTIÓN DE MÓDULOS</h3>
                        
                    </div>
                   
                  </div>
              </div>
            <div class="col-md-12 tab-content">

              <div role="tabpanel" class="tab-pane fade active in" id="tabs-area-demo" aria-labelledby="tabs1">
              <div class="col-md-12">
                  <div class="col-md-12">
                      
                  <div class="col-md-12 tabs-area">

                    <ul id="tabs-demo6" class="nav nav-tabs nav-tabs-v6" role="tablist">
                      <li role="presentation" id="liListado" class="active">
                        <a href="#liListado-tab" class="lnk" id="tabs-demo6-1" role="tab" data-toggle="tab" aria-expanded="true"><span class="fa fa-list-alt"></span> Listado</a>
                      </li>
                      <li role="presentation" class="" id="liNuevo">
                        <a href="#liNuevo-tab" class="lnk" role="tab" id="tabs-demo6-2" data-toggle="tab" aria-expanded="false"><span id="iconNuevo" class="fa fa-plus"></span> Nuevo</a>
                      </li>
                    
                    </ul>
                    <div id="tabsDemo6Content" class="tab-content tab-content-v6 col-md-12">
                      <div role="tabpanel" class="tab-pane fade active in" id="liListado-tab" aria-labelledby="liListado-tab">
                       
                        <div class="responsive-table">
                            <table id="table_modulos" class="table table-striped table-bordered" width="100%" cellspacing="0">
                                <thead style="color:#fff;background:#546e7a">
                                    <tr>
                                        <th v-for="cabecera in cabeceras" :key="cabecera">{{ cabecera }}</th>                                      
                                    </tr>
                                </thead>
                                <tbody>                                                                              
                                </tbody>
                             </table>
                            </div> 

                      </div>
                      <div role="tabpanel" class="tab-pane fade" id="liNuevo-tab" aria-labelledby="liNuevo-tab">
                        <form class="form-horizontal" id="formModulo">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Nombre</label>
                                        <div class="col-sm-10">
                                            <input type="text" ref="NOMBRE_MOD" id="NOMBRE_MOD" name="NOMBRE_MOD" v-model="NOMBRE_MOD" required class="form-control" placeholder="Nombre del módulo" maxlength="130">
                                        </div>  
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Url</label>
                                        <div class="col-sm-10">
                                            <input type="text" ref="URL_MOD" id="URL_MOD" name="URL_MOD" v-model="URL_MOD" required class="form-control" placeholder="Url del módulo" maxlength="130">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Ícono</label>
                                        <div class="col-sm-10">
                                            <input type="text" ref="ICONO_MOD" id="ICONO_MOD" name="ICONO_MOD" v-model="ICONO_MOD" required class="form-control" placeholder="Ícono del módulo" maxlength="130">
                                        </div>  
                                    </div>
                                     <div class="form-group">
                                        <label class="col-sm-2 control-label">Padre</label>
                                            <div class="col-sm-10">                                            
                                                <model-list-select
                                                    :list="listaModulos"
                                                    class="form-control"
                                                    v-model="itemModulo"
                                                    name="MODULO"
                                                    id="MODULO"
                                                    option-value="ID"
                                                    option-text="NOMBRE"
                                                    placeholder="Seleccione categoría">
                                                </model-list-select>                                           
                                            </div>
                                    </div>
                                </div>                                 
                                                                     
                                   
                                    <div class="form-group row">
                                        <div class="col-md-4 col-md-offset-4">
                                            <button type="button" v-if="tipoAccion==1" @click="registrarModulo()" class="btn btn-success"><i class="fa fa-floppy-o"></i> Guardar</button>
                                            <button type="button" v-if="tipoAccion==2" @click="actualizarModulo()" class="btn btn-info"><i class="fa fa-floppy-o"></i> Actualizar</button>
                                            <button type="button" v-if="tipoAccion==2" @click="cancelarActualizar()" class="btn btn-warning"><i class="fa fa-times"></i> Cancelar</button>
                                        </div>
                                    </div> 
                                     </div>                   
                                </form>
                               


                      </div>
                      
                    </div>

                  </div>
                  </div>
              </div>
                </div>

             
              </div>
            </div>
</template>

<script>
import { ModelListSelect } from "vue-search-select";
        export default {
             components: {
                ModelListSelect
            },
            data(){
                return{
                    ID_MOD : 0,
                    NOMBRE_MOD : '',
                    ICONO_MOD : '',
                    URL_MOD : '',
                    ESTADO_MOD : 0,
                    cabeceras : ["Id","Nombre","IconHide","Icono","Url","PadreId","Padre","Estado","Acciones"],
                    tablaModulos : null,
                    tipoAccion : 1,
                    listaModulos : [],
                    itemModulo : {'ID':0,'NOMBRE':''},
                    moduloSelected : 0,
                    nombreModuloPadre: '',
                    idModuloPadre: 0
                }
            },
            mounted() {
              let me = this;
                me.iniciarTabla();
                me.validarDatos();
                me.personalizarModulo();
                toastr.options = {
                                "closeButton": true,
                                "positionClass": "toast-bottom-right"
                                }
               // me.itemModulo = {"ID_MOD":2,"NOMBRE_MOD":"Descuentos"};  

                //console.log(me.listaModulos); 
               /**$(".select2-A").select2({
      placeholder: "Seleccione un módulo",
      allowClear: true
    });*/



/**var studentSelect = $('#ddModulo');
$.ajax({
    type: 'GET',
    url: '/api/modulos/'
}).then(function (data) {
    console.log("----------------");
    console.log(data);
    $.each(data,function(clave,valor){
        //console.log(":) "+data[clave].NOMBRE_MOD);
        var option = new Option(data[clave].NOMBRE_MOD, data[clave].ID_MOD, true, true);
    studentSelect.append(option).trigger('change');
    });
   
    studentSelect.trigger({
        type: 'select2:select',
        params: {
            data: data
        }
    });

});*/


            },
            methods:{

                cambiarTabActivo(idTab,clase)
                {
                    if(clase=='active')
                    {
                        $(idTab).attr('class', 'active');
                        $(idTab+'-tab').attr('class', 'tab-pane fade active in');
                    }
                    else
                    {
                        $(idTab).attr('class', '');
                        $(idTab+'-tab').attr('class', 'tab-pane fade');
                    }
                },
                
                // getRegistroById(idRegistro){
                //     let me = this;
                //     var url = '/categorias/byid';
                //     axios.get(url, { params: { ID_CAT: idRegistro } }).then(function (response){
                //         if(response.status==200)
                //         {
                //             me.ID_CAT = response.data.ID_CAT;
                //             me.NOMBRE_CAT = response.data.NOMBRE_CAT;
                //             me.cambiarTab(1);
                //             me.tipoAccion = 2;
                //             $('#formModulo').data('bootstrapValidator').resetForm();
                //             me.$refs.NOMBRE_CAT.focus();
                //         }                                                                                                                                     
                //     })
                //     .catch(function (error) {
                //         toastr.error('No se ha podido recuperar el registro con id '+idRegistro+'.', 'Error!')
                //     });                     
                // },
               
               
                cancelarActualizar()
                {
                    let me = this;
                    me.tipoAccion = 1;
                    $('#tabs-demo6-2').html('<i class="fa fa-plus"></i>'+' Nuevo');
                    me.limpiarDatos();
                },
                iniciarTabla(){
                   let me = this;
                     me.tablaModulos =   $('#table_modulos').DataTable(
                        {
                        'ajax'       : {
                        "type"   : "GET",
                        "url"    : "api/modulos",
                        "dataSrc": function (json) {
                        //console.log(json);
                        var return_data = new Array();
                        var buttons = '';       
                        var btn = '';
                        var labelEstado = '';
                        for(var i=0;i< json.length; i++){
                          var moduloItem = {"ID":json[i].ID_MOD, "NOMBRE":json[i].NOMBRE_MOD};
                          me.listaModulos.push(moduloItem);

                        var ID_MOD = json[i].ID_MOD;
                            if(json[i].ESTADO_MOD>0)
                            {
                            btn = '<button id="'+ID_MOD+'" type="button" class="btn btn-danger desactivar-categoria"><span class="fa fa-trash"></span> Desactivar</button>';
                            labelEstado =  '<span  class="badge badge-success">Activo</span>';
                            }
                            else {
                            btn = '<button id="'+ID_MOD+'" type="button" class="btn btn-success activar-categoria"><span class="fa fa-check"></span> Activar</button>';
                            labelEstado = '<span class="badge badge-danger">Inactivo</span>';
                            }          
                            buttons = '<div class="btn-group btn-group-sm">'+
                            '<button id="edit-'+ID_MOD+'" class="btn btn-primary editar-categoria"><span class="fa fa-pencil-square-o"></span> Editar</button>'+btn+'</div>';
                            return_data.push({
                            'ID_MOD': json[i].ID_MOD,
                            'NOMBRE_MOD'  : json[i].NOMBRE_MOD,
                            'ICON_HIDE_MOD'  : json[i].ICONO_MOD,
                            'ICONO_MOD' : "<li class='"+json[i].ICONO_MOD+"'></li>",
                            'URL_MOD'  : json[i].URL_MOD,
                            'PADRE' : json[i].PADRE_ITEM,
                            'PADRE_ITEM' : json[i].PADRE_NOMBRE,
                            'ESTADO_MOD' : labelEstado,                            
                            'acciones' : buttons
                            })
                        }
                        return return_data;
                        }
                        },
                        "columnDefs": [
                            {
                                "targets": [ 2 ],
                                "visible": false,
                                "searchable": false
                            },
                            {
                                "targets": [ 5 ],
                                "visible": false,
                                "searchable": false
                            }
                        ],
                        "columns"    : [
                            {'data': 'ID_MOD'},
                            {'data': 'NOMBRE_MOD'},
                            {'data': 'ICON_HIDE_MOD'},
                            {'data': 'ICONO_MOD'},
                            {'data': 'URL_MOD'}, 
                            {'data': 'PADRE'},                       
                            {'data': 'PADRE_ITEM'},
                            {'data': 'ESTADO_MOD'},
                            {'data': 'acciones'}
                        ],
                            dom: 'lBfrtip',
                            lengthMenu: [[10, 20, 50, -1], [10, 20, 50, "Todo"]],
                            buttons: [
                            {
                                    extend:    'copyHtml5',
                                    text:      '<i class="fa fa-files-o"></i> Copiar',
                                    titleAttr: 'Copiar',
                                    exportOptions: {
                                    columns: 'th:not(:last-child)'
                                }
                                },
                                {
                                    extend:    'excelHtml5',
                                    text:      '<i class="fa fa-file-excel-o"></i> Excel',
                                    titleAttr: 'Excel',
                                    exportOptions: {
                                    columns: 'th:not(:last-child)'
                                }
                                },
                                {
                                    extend:    'csvHtml5',
                                    text:      '<i class="fa fa-file-text-o"></i> CSV',
                                    titleAttr: 'CSV',
                                    exportOptions: {
                                    columns: 'th:not(:last-child)'
                                }
                                },
                                {
                                    extend:    'pdfHtml5',
                                    text:      '<i class="fa fa-file-pdf-o"></i> PDF',
                                    titleAttr: 'PDF',
                                    title: 'Listado de'+$('#titulo').text(),
                                    exportOptions: {
                                    columns: 'th:not(:last-child)'
                                }
                                },
                                {
                                    extend:    'print',
                                    text:      '<i class="fa fa-print"></i> Imprimir',
                                    titleAttr: 'Imprimir',
                                    title: 'Listado de'+$('#titulo').text(),
                                    className: 'btn btn-info btn-xs',
                                    exportOptions: {
                                    columns: 'th:not(:last-child)'
                                }
                                }
                            ],
                            "language": {
                                "sProcessing":    "Procesando...",
                                "sLengthMenu":    "Mostrar _MENU_ registros",
                                "sZeroRecords":   "No se encontraron resultados",
                                "sEmptyTable":    "Ningún dato disponible en esta tabla",
                                "sInfo":          "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                                "sInfoEmpty":     "Mostrando registros del 0 al 0 de un total de 0 registros",
                                "sInfoFiltered":  "(filtrado de un total de _MAX_ registros)",
                                "sInfoPostFix":   "",
                                "sSearch":        "Buscar:",
                                "sUrl":           "",
                                "sInfoThousands":  ",",
                                "sLoadingRecords": "Cargando...",
                                "oPaginate": {
                                    "sFirst":    "Primero",
                                    "sLast":    "Último",
                                    "sNext":    "Siguiente",
                                    "sPrevious": "Anterior"
                                },
                                "oAria": {
                                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                                }
                            }
                    });

                    //let meuno = this;
                    $('#table_modulos tbody').on( 'click', 'button.btn-primary', function () {
                        var data = me.tablaModulos.row( $(this).parents('tr') ).data();
                        me.ID_MOD = data.ID_MOD;
                        me.NOMBRE_MOD = data.NOMBRE_MOD;
                        me.ICONO_MOD = data.ICON_HIDE_MOD;
                        me.URL_MOD = data.URL_MOD;
                        me.idModuloPadre = data.PADRE;
                        me.nombreModuloPadre = data.PADRE_ITEM;
                        //console.log(data)
                        me.tipoAccion = 2;
                        me.cambiarTabActivo('#liNuevo','active');
                        me.cambiarTabActivo('#liListado','');
                        $('#tabs-demo6-2').html('<i class="fa fa-edit"></i>'+' Editar');
                        $('#formModulo').data('bootstrapValidator').resetForm();
                        me.$refs.NOMBRE_MOD.focus();
                        me.itemModulo = {"ID":me.idModuloPadre, "NOMBRE":me.nombreModuloPadre};
                       // $("#ddModulo option[value='"+data.PADRE+"']").prop('selected', true);

                    });
                    $('#table_modulos tbody').on( 'click', 'button.btn-danger', function () {
                        var data = me.tablaModulos.row( $(this).parents('tr') ).data();
                        me.ID_MOD = data.ID_MOD;
                        me.NOMBRE_MOD = data.NOMBRE_MOD;
                        me.desactivar();
                    });
                     $('#table_modulos tbody').on( 'click', 'button.btn-success', function () {
                        var data = me.tablaModulos.row( $(this).parents('tr') ).data();
                        me.ID_MOD = data.ID_MOD;
                        me.NOMBRE_MOD = data.NOMBRE_MOD;
                        me.activar();
                    });
                },
                limpiarDatos()
                {
                    $('#formModulo').data('bootstrapValidator').resetForm();
                    $("#formModulo")[0].reset();
                     let me = this;
                    me.$refs.NOMBRE_MOD.focus();
                   
                    me.ID_MOD = 0;
                    me.NOMBRE_MOD = '';
                    me.ICONO_MOD = '';
                    me.URL_MOD = '';
                    me.nombreModuloPadre = '';
                    me.idModuloPadre = 0;
                    me.itemModulo = null;
                },
                 saludo1(){
                    let me = this;
                    var validator = $('.mo').data('bootstrapValidator');
                    validator.validate();
                    if(validator.isValid())
                    {
                        console.log("valido");
                   }
                   else console.log("no valido"); 
                }, 
                personalizarModulo()
                {
                    $('.mo').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            username: {
                message: 'The username is not valid',
                validators: {
                    notEmpty: {
                        message: 'The username is required and cannot be empty'
                    },
                    stringLength: {
                        min: 6,
                        max: 30,
                        message: 'The username must be more than 6 and less than 30 characters long'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_]+$/,
                        message: 'The username can only consist of alphabetical, number and underscore'
                    }
                }
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'The email is required and cannot be empty'
                    },
                    emailAddress: {
                        message: 'The input is not a valid email address'
                    }
                }
            },
            nombre1: {
                validators: {
                    notEmpty: {
                        message: 'Nombre1 is required and cannot be empty'
                    }
                }
            }
        }
    });
                },
                registrarModulo(){
                
                    let me = this;
                    if(!me.idModuloPadre)
                    me.idModuloPadre = 0;
                   // console.log(this.moduloSelected);
                  
                   var validator = $('#formModulo').data('bootstrapValidator');
                    validator.validate();
                    if(validator.isValid())
                    {                               
                    axios.post('/api/modulos',{
                    'NOMBRE_MOD': me.NOMBRE_MOD,
                    'ICONO_MOD':me.ICONO_MOD,
                    'URL_MOD':me.URL_MOD,
                    'PADRE_ITEM':me.itemModulo.ID
                    }).then(function (response){
                        if(response.status==200)
                        {         
                                if(response.data.success)                
                                {
                                    toastr.info(response.data.message);
                                    me.ID_MOD = response.data.data.ID_MOD;
                                    //me.tablaModulos.ajax.reload();
                                    me.agregarFilaTabla();
                                    me.limpiarDatos();
                                }
                                else toastr.error(response.data.message);                           
                        }
                        else
                        {
                            toastr.error("No se ha podido crear el registro.", 'Error!')
                        }          
                    })
                    .catch(function (error) {
                   // console.log(error);
                    toastr.error('No se ha podido guardar el registro.', 'Error!')
                    });
                }      
                },
                agregarFilaTabla(){
                    let me = this;
                    var labelEstado =  '<span  class="badge badge-success">Activo</span>';
                    var btn = '<button id="'+me.ID_MOD+'" type="button" class="btn btn-danger desactivar-categoria"><span class="fa fa-trash"></span> Desactivar</button>';           
                    var buttons = '<div class="btn-group btn-group-sm">'+
                    '<button id="edit-'+me.ID_MOD+'" class="btn btn-primary editar-categoria" ><span class="fa fa-pencil-square-o"></span> Editar</button>'+btn+'</div>';               
                    me.tablaModulos.row.add({
                    "ID_MOD": me.ID_MOD,
                    "NOMBRE_MOD": me.NOMBRE_MOD,
                    "ICON_HIDE_MOD"  : me.ICONO_MOD,
                    "ICONO_MOD": "<li class='"+me.ICONO_MOD+"'></li>",
                    "URL_MOD": me.URL_MOD,
                    'PADRE' : !me.itemModulo.ID?'':me.itemModulo.ID,
                    "PADRE_ITEM": !me.itemModulo.NOMBRE?'':me.itemModulo.NOMBRE,
                    "ESTADO_MOD": labelEstado,
                    "acciones": buttons
                    }).draw();



                     
                },
                validarDatos(){
                   $('#formModulo').bootstrapValidator({
                        message: 'Este valor no es valido',
                        feedbackIcons: {
                            valid: 'fa fa-check',
                            invalid: 'fa fa-times',
                            validating: 'fa fa-refresh'
                        },
                        fields: {
                            NOMBRE_MOD: {
                                validators: {
                                    stringLength: {
                                        min: 5,
                                        max: 100,
                                        message: 'Por favor ingrese al menos 5 caracteres y no más de 100'
                                    },
                                    notEmpty: {
                                        message: 'El nombre de módulo es requerido'
                                    },
                                    regexp: {
                                        //^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]+$
                                        regexp: /^[a-zA-ZÀ-ÿñáéíóú\s]+$/,
                                        message: 'El nombre debe constar solo de letras y espacios'
                                    }
                                }
                            },
                            ICONO_MOD: {
                                validators: {
                                    stringLength: {
                                        min: 5,
                                        max: 100,
                                        message: 'Por favor ingrese al menos 5 caracteres y no más de 100'
                                    },
                                    notEmpty: {
                                        message: 'El ícono de módulo es requerido'
                                    }
                                }
                            },
                            URL_MOD: {
                                validators: {
                                    stringLength: {
                                        min: 1,
                                        max: 110,
                                        message: 'Por favor ingrese al menos 1 caracteres y no más de 110'
                                    },
                                    notEmpty: {
                                        message: 'La url de módulo es requerido'
                                    }
                                }
                            }    		                                            
                        }
                    });
                },
                actualizarModulo(){
                    let me = this;
                    var validator = $('#formModulo').data('bootstrapValidator');
                    validator.validate();
                    if(validator.isValid())
                    {
                        axios.put('/api/modulos/'+me.ID_MOD,{
                        'ID_MOD': me.ID_MOD,
                        'NOMBRE_MOD': me.NOMBRE_MOD,
                        'ICONO_MOD':me.ICONO_MOD,
                        'URL_MOD':me.URL_MOD,
                        'PADRE_ITEM': !me.itemModulo.ID?0:me.itemModulo.ID
                        }).then(function (response){    
                            if(response.status==200)
                            {         
                                 if(response.data.success)                
                                 {
                                     toastr.success(response.data.message);
                                      me.tablaModulos.ajax.reload();
                                 }
                                 else toastr.error(response.data.message);                           
                            }
                            else
                            {
                                toastr.error("No se ha podido actualizar el registro.", 'Error!')
                            }
                        })
                        .catch(function (error) {
                        toastr.error('No se ha podido actualizar el registro.', 'Error!')
                        });
                   }              
                },                
                activar(){
                    let me = this;
                    axios.delete('/api/modulos/'+me.ID_MOD).then(function (response){
                        if(response.status==200)
                            {         
                                 if(response.data.success)                
                                 {
                                     toastr.success(response.data.message);
                                      me.tablaModulos.ajax.reload();
                                 }
                                 else toastr.error(response.data.message);                          
                            }
                            else
                            {
                                toastr.error("No se ha podido desactivar el registro.", 'Error!')
                            }  
                    })
                    .catch(function (error) {
                       toastr.error('No se ha podido activar el registro.', 'Error!')
                    });
                },
                desactivar(){
                    let me = this;
                    const swalWithBootstrapButtons = swal.mixin({
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger',
                    buttonsStyling: false,
                    })
                    swalWithBootstrapButtons({
                    title: '¿Está seguro de desactivar el módulo '+me.NOMBRE_MOD+' ?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Aceptar!',
                    cancelButtonText: 'Cancelar!',
                    reverseButtons: true
                    }).then((result) => {
                    if (result.value) {
                       axios.delete('/api/modulos/'+me.ID_MOD).then(function (response){
                            if(response.status==200)
                            {         
                                 if(response.data.success)                
                                 {
                                     toastr.warning(response.data.message);
                                      me.tablaModulos.ajax.reload();
                                 }
                                 else toastr.error(response.data.message);                          
                            }
                            else
                            {
                                toastr.error("No se ha podido desactivar el registro.", 'Error!')
                            }               
                    })
                    .catch(function (error) {
                    toastr.error('No se ha podido desactivar el registro.', 'Error!')
                    });                   
                    }
                    })
                }          
             }
        }
</script>