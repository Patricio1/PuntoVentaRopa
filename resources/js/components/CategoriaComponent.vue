<template>
    <div class="tabs-wrapper text-center">             
             <div class="panel box-shadow-none text-left content-header">
                  <div class="panel-body" style="padding-bottom:0px;">
                    <div class="col-md-12">
                        <h3 class="animated fadeInLeft">GESTIÓN DE CATEGORÍAS</h3>
                        <!--<p class="animated fadeInDown">
                         Ui Element <span class="fa-angle-right fa"></span> GESTIÓN DE CATEGORÍAS
                        </p>-->
                    </div>
                   <!-- <ul id="tabs-demo" class="nav nav-tabs content-header-tab" role="tablist" style="padding-top:10px;">
                      <li role="presentation" class="active">
                        <a href="#tabs-area-demo" id="tabs2" data-toggle="tab">Tabs</a>
                      </li>
                      <li role="presentation" class="">
                        <a href="#panels-area-demo" id="tabs2" data-toggle="tab">Panels</a>
                      </li>
                    </ul>-->
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
                            <table id="table_categorias" class="table table-striped table-bordered" width="100%" cellspacing="0">
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
                        <form class="form-horizontal" id="formCategoria">                                   
                                     <div class="form-group row">
                                        <label class="col-md-3 control-label">Nombre</label>
                                        <div class="col-md-7">
                                            <input type="text" ref="NOMBRE_CAT" id="NOMBRE_CAT" name="NOMBRE_CAT" v-model="NOMBRE_CAT" required class="form-control" placeholder="Nombre de la categoría" maxlength="130">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-4 col-md-offset-4">
                                            <button type="button" v-if="tipoAccion==1" @click="registrarCategoria()" class="btn btn-success"><i class="fa fa-floppy-o"></i> Guardar</button>
                                            <button type="button" v-if="tipoAccion==2" @click="actualizarCategoria()" class="btn btn-info"><i class="fa fa-floppy-o"></i> Actualizar</button>
                                            <button type="button" v-if="tipoAccion==2" @click="cancelarActualizar()" class="btn btn-warning"><i class="fa fa-times"></i> Cancelar</button>
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
        export default {
            data(){
                return{
                    ID_CAT : 0,
                    NOMBRE_CAT : '',
                    ESTADO_CAT : 0,
                    cabeceras : ["Id","Nombre","Estado","Acciones"],
                    tablaCategorias : null,
                    tipoAccion : 1
                }
            },
            mounted() {
              
                this.iniciarTabla();
                this.validarCategoria();
                toastr.options = {
                                "closeButton": true,
                                "positionClass": "toast-bottom-right"
                                } 

               /** this.cambiarTabActivo('#liNuevo','active');
                this.cambiarTabActivo('#liListado','');*/


                // $('#liNuevo').attr('class', 'active');
                // $('#tabs-demo7-area2').attr('class', 'tab-pane fade active in');

              //   $('#liListado').attr('class', '');
                // $('#tabs-demo7-area1').attr('class', 'tab-pane fade');
                // toastr.options = {"closeButton": true}                 
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
                // initTab(event){
                //     let targetClassNames=event.target.className.split(" ");
                //     targetClassNames.filter(e=>{
                //         if(e==="desactivar-categoria")
                //         {
                //             this.desactivar(event.target.id);
                //         }
                //         else if(e==="activar-categoria")
                //         {
                //             this.activar(event.target.id);
                //         }
                //         else if(e==="editar-categoria")
                //         {
                //            let arrayID = event.target.id.split("-");
                //            this.getRegistroById(arrayID[1]);
                //         }
                //     });
                // },               
                // listarCategorias(){
                //     let me = this;
                //     me.iniciarTabla();
                // },
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
                //             $('#formCategoria').data('bootstrapValidator').resetForm();
                //             me.$refs.NOMBRE_CAT.focus();
                //         }                                                                                                                                     
                //     })
                //     .catch(function (error) {
                //         toastr.error('No se ha podido recuperar el registro con id '+idRegistro+'.', 'Error!')
                //     });                     
                // },
                // cambiarTabActivo(idTab,clase)
                // {
                //     if(clase=='active show')
                //     {
                //         $(idTab).attr('class', 'tab-pane fade active show');
                //         $(idTab+'-tab').attr('class', 'nav-item nav-link active show');
                //     }
                //     else
                //     {
                //         $(idTab).attr('class', 'tab-pane fade');
                //         $(idTab+'-tab').attr('class', 'nav-item nav-link');
                //     }
                // },
                // cambiarTab(indice)
                // {
                //     switch (indice)
                //     {
                //         case 0: //tab listado
                //         {
                //             this.cambiarTabActivo('#listado','active show');
                //             this.cambiarTabActivo('#editar','');
                //             break;
                //         }
                //         case 1: //tab nuevo/editar
                //         {
                //             this.cambiarTabActivo('#editar','active show');
                //             this.cambiarTabActivo('#listado','');
                //             $('#editar-tab').html('<i class="fa fa-edit"></i>'+' Editar');
                //             break;
                //         }
                //     }
                // },
                cancelarActualizar()
                {
                    let me = this;
                    me.tipoAccion = 1;
                    $('#tabs-demo6-2').html('<i class="fa fa-plus"></i>'+' Nuevo');
                    me.limpiarDatos();
                },
                iniciarTabla(){
                     this.tablaCategorias =   $('#table_categorias').DataTable(
                        {
                        'ajax'       : {
                        "type"   : "GET",
                        "url"    : "api/categorias",
                        "dataSrc": function (json) {
                            console.log(json);
                        var return_data = new Array();
                        var buttons = '';       
                        var btn = '';
                        var labelEstado = '';
                        for(var i=0;i< json.length; i++){
                        var ID_CAT = json[i].ID_CAT;
                            if(json[i].ESTADO_CAT>0)
                            {
                            btn = '<button id="'+ID_CAT+'" type="button" class="btn btn-danger desactivar-categoria"><span class="fa fa-trash"></span> Desactivar</button>';
                            labelEstado =  '<span  class="badge badge-success">Activo</span>';
                            }
                            else {
                            btn = '<button id="'+ID_CAT+'" type="button" class="btn btn-success activar-categoria"><span class="fa fa-check"></span> Activar</button>';
                            labelEstado = '<span class="badge badge-danger">Inactivo</span>';
                            }          
                            buttons = '<div class="btn-group btn-group-sm">'+
                            '<button id="edit-'+ID_CAT+'" class="btn btn-primary editar-categoria"><span class="fa fa-pencil-square-o"></span> Editar</button>'+btn+'</div>';
                            return_data.push({
                            'ID_CAT': json[i].ID_CAT,
                            'NOMBRE_CAT'  : json[i].NOMBRE_CAT,
                            'ESTADO_CAT' : labelEstado,
                            'acciones' : buttons
                            })
                        }
                        return return_data;
                        }
                        },
                        "columns"    : [
                            {'data': 'ID_CAT'},
                            {'data': 'NOMBRE_CAT'},
                            {'data': 'ESTADO_CAT'},
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

                    let me = this;
                    $('#table_categorias tbody').on( 'click', 'button.btn-primary', function () {
                        var data = me.tablaCategorias.row( $(this).parents('tr') ).data();
                        me.ID_CAT = data.ID_CAT;
                        me.NOMBRE_CAT = data.NOMBRE_CAT;
                        me.tipoAccion = 2;
                        me.cambiarTabActivo('#liNuevo','active');
                        me.cambiarTabActivo('#liListado','');
                        $('#tabs-demo6-2').html('<i class="fa fa-edit"></i>'+' Editar');
                        $('#formCategoria').data('bootstrapValidator').resetForm();
                        me.$refs.NOMBRE_CAT.focus();

                    });
                    $('#table_categorias tbody').on( 'click', 'button.btn-danger', function () {
                        var data = me.tablaCategorias.row( $(this).parents('tr') ).data();
                        me.ID_CAT = data.ID_CAT;
                        me.NOMBRE_CAT = data.NOMBRE_CAT;
                        me.desactivar();
                    });
                     $('#table_categorias tbody').on( 'click', 'button.btn-success', function () {
                        var data = me.tablaCategorias.row( $(this).parents('tr') ).data();
                        me.ID_CAT = data.ID_CAT;
                        me.NOMBRE_CAT = data.NOMBRE_CAT;
                        me.activar();
                    });
                },
                limpiarDatos()
                {
                    $('#formCategoria').data('bootstrapValidator').resetForm();
                    $("#formCategoria")[0].reset();
                    this.$refs.NOMBRE_CAT.focus();
                    let me = this;
                    me.ID_CAT = 0;
                    me.NOMBRE_CAT = '';
                },
                registrarCategoria(){
                    var validator = $('#formCategoria').data('bootstrapValidator');
                    validator.validate();
                    if(validator.isValid())
                    {            
                    let me = this;
                    axios.post('/api/categorias',{
                    'NOMBRE_CAT': me.NOMBRE_CAT
                    }).then(function (response){
                        if(response.status==200)
                        {         
                                if(response.data.success)                
                                {
                                    toastr.info(response.data.message);
                                    me.tablaCategorias.ajax.reload();
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
                // agregarFilaTabla(){
                //     let me = this;
                //     var labelEstado =  '<span  class="badge badge-success">Activo</span>';
                //     var btn = '<button id="'+me.ID_CAT+'" type="button" class="btn btn-danger desactivar-categoria"><span class="fa fa-trash"></span> Desactivar</button>';           
                //     var buttons = '<div class="btn-group btn-group-sm">'+
                //     '<button id="edit-'+me.ID_CAT+'" class="btn btn-primary editar-categoria" ><span class="fa fa-pencil-square-o"></span> Editar</button>'+btn+'</div>';               
                //     me.tablaCategorias.row.add({
                //     "ID_CAT": me.ID_CAT,
                //     "NOMBRE_CAT": me.NOMBRE_CAT,
                //     "ESTADO_CAT": labelEstado,
                //     "ACCIONES": buttons
                //     }).draw();
                // },
                validarCategoria(){
                   $('#formCategoria').bootstrapValidator({
                        message: 'Este valor no es valido',
                        feedbackIcons: {
                            valid: 'fa fa-check',
                            invalid: 'fa fa-times',
                            validating: 'fa fa-refresh'
                        },
                        fields: {
                            NOMBRE_CAT: {
                                validators: {
                                    stringLength: {
                                        min: 5,
                                        max: 100,
                                        message: 'Por favor ingrese al menos 5 caracteres y no más de 100'
                                    },
                                    notEmpty: {
                                        message: 'El nombre de categoría es requerido'
                                    },
                                    regexp: {
                                        //^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]+$
                                        regexp: /^[a-zA-ZÀ-ÿñáéíóú\s]+$/,
                                        message: 'El nombre debe constar solo de letras y espacios'
                                    }
                                }
                            }    		                                            
                        }
                    });
                },
                actualizarCategoria(){
                    let me = this;
                    var validator = $('#formCategoria').data('bootstrapValidator');
                    validator.validate();
                    if(validator.isValid())
                    {
                        axios.put('/api/categorias/'+me.ID_CAT,{
                        'ID_CAT': me.ID_CAT,
                        'NOMBRE_CAT': me.NOMBRE_CAT,
                        }).then(function (response){    
                            if(response.status==200)
                            {         
                                 if(response.data.success)                
                                 {
                                     toastr.success(response.data.message);
                                      me.tablaCategorias.ajax.reload();
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
                    axios.delete('/api/categorias/'+me.ID_CAT).then(function (response){
                        if(response.status==200)
                            {         
                                 if(response.data.success)                
                                 {
                                     toastr.success(response.data.message);
                                      me.tablaCategorias.ajax.reload();
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
                    title: '¿Está seguro de desactivar la categoría '+me.NOMBRE_CAT+' ?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Aceptar!',
                    cancelButtonText: 'Cancelar!',
                    reverseButtons: true
                    }).then((result) => {
                    if (result.value) {
                       axios.delete('/api/categorias/'+me.ID_CAT).then(function (response){
                            if(response.status==200)
                            {         
                                 if(response.data.success)                
                                 {
                                     toastr.warning(response.data.message);
                                      me.tablaCategorias.ajax.reload();
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