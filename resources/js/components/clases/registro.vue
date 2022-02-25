<template>
    <div class="contenedor">
        
        <h3>Clases</h3>

        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalNueva">Crear nueva</button>
        <br><br>

        <table class="table">

            <thead>
                <tr>
                    <th>Asignatura</th>
                    <th>Horas</th>
                    <th>Cedula docente</th>
                    <th>Docente</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                <tr v-for="clase in listClase" :key="clase.id">
                    <td v-text="clase.asignatura"></td>
                    <td v-text="clase.horas"></td>
                    <td v-text="clase.cedula_docente"></td>
                    <td v-text="clase.docente"></td>
                    <td>
                        <button @click="cargarDatos(clase)" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalEditar">
                            <i class="ni ni-ruler-pencil text-secondary"></i>
                        </button>
                        <button @click="deleteClase(clase)" class="btn btn-danger btn-sm">
                            <i class="ni ni-fat-remove text-secondary"></i>
                        </button>
                    </td>
                </tr>
            </tbody>

        </table>

        <!-- Inicio modal nueva clase -->
        
            <div class="modal fade" id="modalNueva" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Nueva clase</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                 
                    <form @submit.prevent="saveClase">

                          <div class="row">

                              <div class="col">
                                  <label for="">Asignatura</label>
                                  <input v-model="arrayClase.asignatura" type="text" class="form-control form-control-sm" required>
                              </div>

                              <div class="col">
                                  <label for="">Horas</label>
                                  <input v-model="arrayClase.horas" type="number" class="form-control form-control-sm" required>
                              </div>

                          </div>

                          <div class="row">

                              <div class="col">
                                  <label for="">Cédula docente</label>
                                  <input v-model="arrayClase.cedula_docente" type="number" class="form-control form-control-sm" required>
                              </div>

                              <div class="col">
                                  <label for="">Docente</label>
                                  <input v-model="arrayClase.docente" type="text" class="form-control form-control-sm" required>
                              </div>

                          </div>
                          <br>
                          <button class="btn btn-success btn-sm">Regitrar clase</button>

                    </form>

                </div>
                <div class="modal-footer">
                   
                </div>
                </div>
            </div>
        </div>

            
        <!-- Final modal -->


        <!-- Inicio modal editar -->

            <div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Editar clase</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                 
                    <form @submit.prevent="updateClase">

                          <div class="row">

                              <div class="col">
                                  <label for="">Asignatura</label>
                                  <input v-model="arrayEditar.asignatura" type="text" class="form-control form-control-sm" required>
                              </div>

                              <div class="col">
                                  <label for="">Horas</label>
                                  <input v-model="arrayEditar.horas" type="number" class="form-control form-control-sm" required>
                              </div>

                          </div>

                          <div class="row">

                              <div class="col">
                                  <label for="">Cédula docente</label>
                                  <input v-model="arrayEditar.cedula_docente" type="number" class="form-control form-control-sm" required>
                              </div>

                              <div class="col">
                                  <label for="">Docente</label>
                                  <input v-model="arrayEditar.docente" type="text" class="form-control form-control-sm" required>
                              </div>

                          </div>
                          <br>
                          <button class="btn btn-success btn-sm">Regitrar clase</button>

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
            arrayClase:{
                'asignatura':'',
                'horas':'',
                'cedula_docente':'',
                'docente':'',
                'delete':1
            },
            listClase:{
                'asignatura':'',
                'horas':'',
                'cedula_docente':'',
                'docente':'',
                'delete':1
            },

            arrayEditar:{
                'asignatura':'',
                'horas':'',
                'cedula_docente':'',
                'docente':'',
                'delete':1
            },
             'idEditar':''

        };
    },

    methods: {

        async listarClases(){
          axios.get('clase/list').then((response) => {
                this.listClase = response.data;
          }).catch((error) => {
                console.log(error);
          });
        },

        async saveClase(){
            axios.post('clase/save',this.arrayClase).then((result) =>{
                this.listarClases();
                this.limpiarCampos();
                this.mensaje('Se ha registrado la clase');
                console.log(result);
            }).catch((error)=>{
                console.log(error);
            });
        },

        async updateClase(){
            axios.put('clase/update/'+this.idEditar,this.arrayEditar).then((result) => {
                console.log(result);
                this.listarClases();
                this.mensaje('Datos de clase actualizados');
            }).catch((error) => {
                console.log(error);
            });
        },

        cargarDatos: function(clase){
            this.arrayEditar = {
                'asignatura':clase.asignatura,
                'horas':clase.horas,
                'cedula_docente':clase.cedula_docente,
                'docente':clase.docente
            }
            this.idEditar = clase.id;
        },

        async deleteClase(clase){
           
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
                    axios.post('clase/delete',clase).then((result) => {
                    this.listarClases();
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

        limpiarCampos: function(){
            this.arrayClase={
                'asignatura':'',
                'horas':'',
                'cedula_docente':'',
                'docente':''
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

    created(){
        this.listarClases();
    }
};
</script>