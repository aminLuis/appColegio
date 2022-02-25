<template>
    <div class="contenedor">

        <h3>Docentes</h3>
         
       <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#nuevoInsumo">Nuevo</button>
       <br><br>

       <table class="table table-ms">

           <thead>
               <tr>
                   <th>Cédula</th>
                   <th>Nombre</th>
                   <th>Apellidos</th>
                   <th>Asignatura</th>
                   <th>Acción</th>
               </tr>
           </thead>

           <tbody>
               <tr v-for="docente in listDocente" :key="docente.id">
                   <td v-text="docente.cedula"></td>
                   <td v-text="docente.nombre"></td>
                   <td v-text="docente.apellidos"></td>
                   <td v-text="docente.asignatura"></td>
                   <td>
                       <button @click="cargarDatos(docente)" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalEditar">
                           <i class="ni ni-ruler-pencil text-secondary"></i>
                       </button>
                       <button @click="deleteDocente(docente)" class="btn btn-danger btn-sm">
                           <i class="ni ni-fat-remove text-secondary"></i>
                       </button>
                   </td>
               </tr>
           </tbody>

       </table>

       <!-- MODAL CREAR DOCENTE -->

       <div class="modal fade" tabindex="-1" id="nuevoInsumo">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white">Datos docente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                    <form @submit.prevent="saveDocente">

                        <div class="row">

                            <div class="col">
                                <label for="" class="form-control-sm">Cédula</label>
                                <input v-model="arrayDocente.cedula" type="number" class="form-control form-control-sm" required>
                            </div>

                            <div class="col">
                                <label for="" class="form-control-sm">Nombre</label>
                                <input v-model="arrayDocente.nombre" type="text" class="form-control form-control-sm" required>
                            </div>

                            <div class="col">
                                <label for="" class="form-control-sm">Apellidos</label>
                                <input v-model="arrayDocente.apellidos" type="text" class="form-control form-control-sm" required>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col">
                                <label for="" class="form-control-sm">Asignatura</label>
                                <input v-model="arrayDocente.asignatura" type="text" class="form-control form-control-sm" required>
                            </div>

                            <div class="col">
                            </div>
                            <div class="col">
                            </div>

                        </div>


                        <br>
                        <button type="submit" class="btn btn-primary btn-sm">Guardar</button>

                    </form>

                </div>
                        <div class="modal-footer">
                        
                        </div>
                </div>
            </div>
       </div>

       <!--Final modal -->

       <!-- Inicio modal editar -->

       <div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Editar docente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    

                       <form @submit.prevent="updateDocente">

                        <div class="row">

                            <div class="col">
                                <label for="" class="form-control-sm">Cédula</label>
                                <input v-model="arrayEditar.cedula" type="number" class="form-control form-control-sm" required>
                            </div>

                            <div class="col">
                                <label for="" class="form-control-sm">Nombre</label>
                                <input v-model="arrayEditar.nombre" type="text" class="form-control form-control-sm" required>
                            </div>

                            <div class="col">
                                <label for="" class="form-control-sm">Apellidos</label>
                                <input v-model="arrayEditar.apellidos" type="text" class="form-control form-control-sm" required>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col">
                                <label for="" class="form-control-sm">Asignatura</label>
                                <input v-model="arrayEditar.asignatura" type="text" class="form-control form-control-sm" required>
                            </div>

                            <div class="col">
                            </div>
                            <div class="col">
                            </div>

                        </div>


                        <br>
                        <button type="submit" class="btn btn-primary btn-sm">Guardar cambios</button>

                    </form>



                </div>
                <div class="modal-footer">
                   
                </div>
                </div>
            </div>
        </div>

    

<!-- Final modal editar -->

    </div>
</template>

<script>
export default {
    
    data() {
        return {
            arrayDocente:{
                'cedula':'',
                'nombre':'',
                'apellidos':'',
                'asignatura':'',
                'delete': 1
            },
            costoTotal: 0,
            listDocente:{
                'cedula':'',
                'nombre':'',
                'apellidos':'',
                'asignatura':'',
                'delete': ''
            },
            arrayEditar:{
                'cedula':'',
                'nombre':'',
                'apellidos':'',
                'asignatura':'',
            },
            idEditar:''
            
        };
    },

    mounted() {
       
    },

    methods: {
        
        totalCosto: function(){
           this.arrayInsumo.total_costo = this.arrayInsumo.unidades * this.arrayInsumo.costo_unidad;
        },

        async listarDocentes(){
          axios.get('docente/list').then((response) => {
                this.listDocente = response.data;
          }).catch((error) => {
                console.log(error);
          });
        },

        async saveDocente(){
            axios.post('docente/save',this.arrayDocente).then((result) => {
                this.listarDocentes();
                this.limpiarCampos();
                this.mensaje('Se ha registrado el docente');
                 console.log(error);
            }).catch((error) => {
                console.log(error);
          });
        },

        async cargarDatos(docente){
            this.arrayEditar={
                'cedula':docente.cedula,
                'nombre':docente.nombre,
                'apellidos':docente.apellidos,
                'asignatura':docente.asignatura
            }
             this.idEditar = docente.id;
        },

        async updateDocente(){
            axios.put('docente/update/'+this.idEditar,this.arrayEditar).then((result) => {
                console.log(result);
                this.listarDocentes();
                this.mensaje('Datos de doncente actualizados');
            }).catch((error) => {
                console.log(error);
          });
      
        },

        async deleteDocente(docente){

             Swal.fire({
                title: '¿Seguro que desea eliminar el registro?',
                text: "¡El cambio sería de forma permanente!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, deseo eliminarlo!'
                }).then((result) => {
                if (result.isConfirmed) {
                    axios.post('docente/delete',docente).then((result) => {
                    this.listarDocentes();
                    console.log(result);
                    }).catch((error) => {
                            console.log(error);
                    });
                    Swal.fire(
                    'Eliminado!',
                    'El registro ha sido eliminado.',
                    'success'
                    )
                }
                })
           
        },

        async limpiarCampos(){
            this.arrayDocente = {
                'cedula':'',
                'nombre':'',
                'apellidos':'',
                'asignatura':'',
                'delete': 1
            }
        },

        mensaje: function(text){
            Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: text,
            showConfirmButton: false,
            timer: 2000
            })
        }

        

    },

     created() {
     this.listarDocentes();
     },
};
</script>

