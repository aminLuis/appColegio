<template>
    
    <div class="contenedor">


     <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalNueva">Asignar nota</button>|
     <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalNota">Crear nota</button>

     <br><br>

     <table class="table table-sm table-hover">

         <thead>
             <tr>
                 <th>Descripción nota</th>
                 <th>Acción</th>
             </tr>
         </thead>

         <tbody>
             <tr v-for="nota in listNota" :key="nota.id">
                 <td v-text="nota.descripcion"></td>
                 <td>
                     <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalEditar">
                            <i class="ni ni-ruler-pencil text-secondary"></i>
                        </button>
                        <button class="btn btn-danger btn-sm">
                            <i class="ni ni-fat-remove text-secondary"></i>
                        </button>
                 </td>
             </tr>
         </tbody>

     </table>


     <!-- Modal nueva-->
        <div class="modal fade" id="modalNueva" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title text-white" id="exampleModalLabel">Registro nota</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                <form @submit.prevent="saveNotaEstudiante">

                    <div class="row">
                        <div class="col">
                            <label for="">Estudiante</label>
                            <v-select v-model="estudiante" label="nombre" :options="listEstudiante" />
                        </div>
                        
                    </div>
                    <hr>
                    <div class="row">

                        <div class="col">
                            <label for="">Apellidos</label>
                            <input v-model="estudiante.apellidos" type="text" class="form-control form-control-sm" readonly required>
                        </div>
                        <div class="col">
                            <label for="">Identificación</label>
                            <input v-model="estudiante.identificacion" type="text" class="form-control form-control-sm" readonly required>
                        </div>
                        <div class="col">
                            <label for="">Grado</label>
                            <input v-model="estudiante.grado" type="text" class="form-control form-control-sm" readonly required>
                        </div>

                    </div>
                    
                    <hr>
                    <div class="row">

                        <div class="col">
                            <label for="">Docente</label>
                            <v-select v-model="docente" label="nombre" :options="listDocente" />
                        </div>

                    </div>

                    <div class="row">

                        <div class="col">
                            <label for="">Apellidos</label>
                            <input v-model="docente.apellidos" type="text" class="form-control form-control-sm" readonly required>
                        </div>

                        <div class="col">
                            <label for="">Identificación</label>
                            <input v-model="docente.cedula" type="text" class="form-control form-control-sm" readonly required>
                        </div>

                        <div class="col">
                            <label for="">Asignatura</label>
                            <input v-model="docente.asignatura" type="text" class="form-control form-control-sm" readonly required>
                        </div>

                    </div>
                    
                    <hr>
                    <div class="row">
                        <div class="col">
                            <label for="">Nombre nota</label>
                            <v-select v-model="nota" label="descripcion" :options="listNota" />
                        </div>
                        <div class="col">
                            <label for="">Valor de la nota</label>
                            <input v-model="total_nota" type="number" step="any" class="form-control form-control-sm" required>
                        </div>
                    </div>
                <br>
                <button class="btn btn-success">Guardar nota</button>
                </form>

            </div>
           
            </div>
        </div>
        </div>

        <!-- Final modal nueva -->

        <!-- Inicio modal crear nota -->

            <div class="modal fade" id="modalNota" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Crear nota</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                   
                    <form @submit.prevent="saveNota">

                        <div class="row">
                            <div class="col">
                                <label for="">Descripción nota</label>
                                <input v-model="arrayNota.descripcion" type="text" class="form-control form-control-sm" required>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <label for="">Docente</label>
                                <v-select v-model="docenteNota" label="nombre" :options="listDocente" />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="">ID</label>
                                <input v-model="docenteNota.id" type="text" class="form-control form-control-sm" required readonly>
                            </div>
                            <div class="col">
                                <label for="">Asignatura</label>
                                <input v-model="docenteNota.asignatura" type="text" class="form-control form-control-sm" required readonly>
                            </div>
                        </div>

                        <br>
                        <button class="btn btn-success btn-sm">Guardar</button>
                    </form>

                </div>
                
                </div>
            </div>
            </div>

        <!-- Final modal crear nota -->


    </div>

</template>

<script>
export default {
    name: 'PlantillaColegioRegistro',

    data() {
        return {
            listEstudiante:[],
            estudiante:[],
            listDocente:[],
            docente:[],
            arrayNota:{
                'descripcion':'',
                'idDocente':'',
                'asignatura':'',
                'delete': true
            },
            listNota:[],
            docenteNota:[],
            arrayNotaEstudiante:{
                'identificacion':'',
                'grado':'',
                'docente':'',
                'asignatura':'',
                'descripcion_nota':'',
                'valor_nota':'',
                'delete': true
            },
            nota:[],
            total_nota:''
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

        async listarDocentes(){
          axios.get('docente/list').then((response) => {
                this.listDocente = response.data;
          }).catch((error) => {
                console.log(error);
          });
        },

        async listarNotas(){
            axios.get('nota/list').then((response) => {
                this.listNota = response.data;
            }).catch((error) => {
                    console.log(error);
            });
        },

        limpiarCamposNotas: function(){
            this.arrayNota = {
                'idDocente': '',
                'asignatura': ''
            }
        },

        limpiarNotaEstudiante: function(){
            this.estudiante=[];
            this.docente=[];
            this.nota=[];
            this.total_nota='';
        },

        async saveNota(){
            this.arrayNota.idDocente = this.docenteNota.id;
            this.arrayNota.asignatura = this.docenteNota.asignatura;
            
            axios.post('nota/save',this.arrayNota).then((result) => {
                this.listarNotas();
                this.limpiarCamposNotas();
                this.mensaje('Descripción nota registrada');
                 console.log(error);
            }).catch((error) => {
                console.log(error);
          });
        },

         async saveNotaEstudiante(){
           
           this.arrayNotaEstudiante = {
               'identificacion': this.estudiante.identificacion,
               'grado': this.estudiante.grado,
               'docente': this.docente.nombre,
               'asignatura': this.docente.asignatura,
               'descripcion_nota': this.nota.descripcion,
               'valor_nota': this.total_nota,
               'delete': true
           }
            
            axios.post('nota_estudiante/save',this.arrayNotaEstudiante).then((result) => {
                //this.listarNotas();
                this.limpiarNotaEstudiante();
                this.mensaje('Nota estudiante registrada');
                 console.log(error);
            }).catch((error) => {
                console.log(error);
          });
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
     this.listarDocentes();
     this.listarNotas();
     },
};
</script>