<template>
    <div class="contenedor">
       
        <div class="alert alert-info" role="alert">

            <div class="row">
                <div class="col">
                    <label for="">Identificación estudiante</label>
                    <v-select v-model="datos" label="identificacion" :options="listNotas" />
                </div>
                <div class="col"></div>
                <div class="col"></div>
            </div>
            
            <hr>
            
            <div class="row">
                <div class="col">
                    <label for="">Descripción nota</label>
                    <input v-model="datos.descripcion_nota" type="text" class="form-control" readonly>
                </div>
                <div class="col">
                    <label for="">Valor nota</label>
                    <input v-model="datos.valor_nota" type="text" class="form-control" readonly>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label for="">Grado del estudiante</label>
                    <input v-model="datos.grado" type="text" class="form-control" readonly>
                </div>
                <div class="col">
                    <label for="">Asignatura</label>
                    <input v-model="datos.asignatura" type="text" class="form-control" readonly>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label for="">Docente</label>
                    <input v-model="datos.docente" type="text" class="form-control" readonly>
                </div>
                <div class="col"></div>
            </div>

        </div>

    </div>
</template>

<script>
export default {
  
    data() {
        return {

            listNotas:[],
            datos:[]
            
        };
    },

    methods: {

        async listarNotas(){
          axios.get('nota_estudiante/list').then((response) => {
                this.listNotas = response.data;
          }).catch((error) => {
                console.log(error);
          });
        }
        
    },

     created() {
         this.listarNotas();
     }
};
</script>