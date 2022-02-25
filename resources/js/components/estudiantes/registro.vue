<template>
    <div class="contenedor">
        
        <button class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#modalNuevo">Nuevo estudiante</button>
        <br><br>

        <table class="table">

            <thead>
                <tr>
                    <th>Identificación</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Grado</th>
                    <th>Acción</th>
                </tr>
            </thead>

            <tbody>
                <tr v-for="estudiante in listEstudiante" :key="estudiante.id">
                    <td v-text="estudiante.identificacion"></td>
                    <td v-text="estudiante.nombre"></td>
                    <td v-text="estudiante.apellidos"></td>
                    <td v-text="estudiante.grado"></td>
                    <td>
                        <button @click="cargarDatos(estudiante)" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalEditar">
                            <i class="ni ni-ruler-pencil text-secondary"></i>
                        </button>
                        <button @click="deleteEstudiante(estudiante)" class="btn btn-danger btn-sm">
                            <i class="ni ni-fat-remove text-secondary"></i>
                        </button>
                    </td>
                </tr>
            </tbody>

        </table>

        <!-- Inicio modal nuevo estudiante -->

            <div class="modal fade" id="modalNuevo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                    <div class="modal-header bg-secondary">
                        <h5 class="modal-title" id="exampleModalLabel">Registro estudiante</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                       
                        <form  @submit.prevent="saveEstudiante">

                            <div class="row">
                                <div class="col">
                                    <label for="">Identificación</label>
                                    <input v-model="arrayEstudiante.identificacion" type="number" class="form-control form-control-sm">
                                </div>
                                <div class="col">
                                    <label for="">Nombre</label>
                                    <input v-model="arrayEstudiante.nombre" type="text" class="form-control form-control-sm">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <label for="">Apellidos</label>
                                    <input v-model="arrayEstudiante.apellidos" type="text" class="form-control form-control-sm">
                                </div>
                                <div class="col">
                                    <label for="">Grado</label>
                                    <input v-model="arrayEstudiante.grado" type="text" class="form-control form-control-sm">
                                </div>
                            </div>
                        <br>
                        <button class="btn btn-success">Registrar estudiante</button>

                        </form>

                    </div>
                   
                    </div>
                </div>
                </div>

        <!-- Final modal nuevo estudiante -->



        <!-- Inicio modal editar -->

            <div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                    <div class="modal-header bg-secondary">
                        <h5 class="modal-title" id="exampleModalLabel">Registro estudiante</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                       
                        <form  @submit.prevent="updateEstudiante">

                            <div class="row">
                                <div class="col">
                                    <label for="">Identificación</label>
                                    <input v-model="arrayEditar.identificacion" type="number" class="form-control form-control-sm">
                                </div>
                                <div class="col">
                                    <label for="">Nombre</label>
                                    <input v-model="arrayEditar.nombre" type="text" class="form-control form-control-sm">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <label for="">Apellidos</label>
                                    <input v-model="arrayEditar.apellidos" type="text" class="form-control form-control-sm">
                                </div>
                                <div class="col">
                                    <label for="">Grado</label>
                                    <input v-model="arrayEditar.grado" type="text" class="form-control form-control-sm">
                                </div>
                            </div>
                        <br>
                        <button class="btn btn-success">Guardar cambios</button>

                        </form>

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
            arrayEstudiante:{
                'identificacion':'',
                'nombre':'',
                'apellidos':'',
                'grado':'',
                'delete': true
            },
            listEstudiante:{
                'identificacion':'',
                'nombre':'',
                'apellidos':'',
                'grado':'',
                'delete': ''
            },
            arrayEditar:{
                'identificacion':'',
                'nombre':'',
                'apellidos':'',
                'grado':'',
            },

            idEditar:''
        };
    },

  
    methods: {

        async listarEstudiantes(){
             axios.get('estudiante/list').then((response) => {
                this.listEstudiante = response.data;
          }).catch((error) => {
                console.log(error);
          });
        },

        async saveEstudiante(){
            axios.post('estudiante/save',this.arrayEstudiante).then((result) => {
                this.listarEstudiantes();
                this.limpiarCampos();
                this.mensaje('Estudiante registrado');
                 console.log(error);
            }).catch((error) => {
                console.log(error);
          });
        },

        async updateEstudiante(){
            axios.put('estudiante/update/'+this.idEditar,this.arrayEditar).then((result) => {
                console.log(result);
                this.listarEstudiantes();
                this.mensaje('Datos de estudiante actualizados');
            }).catch((error) => {
                console.log(error);
          });
      
        },

        async deleteEstudiante(estudiante){
        
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
                    axios.post('estudiante/delete',estudiante).then((result) => {
                    this.listarEstudiantes();
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

        cargarDatos: function(estudiante){
            this.arrayEditar = {
                'identificacion': estudiante.identificacion,
                'nombre': estudiante.nombre,
                'apellidos':estudiante.apellidos,
                'grado':estudiante.grado
            }
            this.idEditar = estudiante.id;
        },

        limpiarCampos: function(){
            this.arrayEstudiante = {
                'identificacion':'',
                'nombre':'',
                'apellidos':'',
                'grado':''
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
     this.listarEstudiantes();
     },
};
</script>