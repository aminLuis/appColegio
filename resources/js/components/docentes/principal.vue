<template>
    <div>
        
        <div class="tabs-container">

            <div class="tabs-item" @click="tabsClick('insumos')" :class="{'tabs-item-active': tab==='insumos'}">
                Registro docentes
            </div>

            <div class="tabs-item" @click="tabsClick('bebidas')" :class="{'tabs-item-active': tab==='bebidas'}">
                Bebidas
            </div>

            <div class="tabs-item" @click="tabsClick('nuevoInventario')" :class="{'tabs-item-active': tab==='nuevoInventario'}">
                Nuevo inventario
            </div>

        </div>
         <br>
        <component :is="currentTab"/>

    </div>
</template>

<script>

import insumos from './registro.vue';
import bebidas from './bebidas.vue';
import nuevoInventario from './nuevoInventario.vue';

export default {
   
    data() {
        return {
            tab: '',
            currentTab: null,
        };
    },

    mounted() {
    },

    methods: {
     
         tabsClick: function(select){
          
          this.tab = select;
          
          if(select=='insumos'){
              this.currentTab = insumos;
          }
          if(select=='bebidas'){
              this.currentTab = bebidas;
          }
          if(select=='nuevoInventario'){
              this.currentTab = nuevoInventario;
          }
        
        }

    },
};
</script>

<style>
    
.tabs-container{
    display: flex;
}

.tabs-item{
    padding: 10px;
    cursor: pointer;
}

.tabs-item:hover{
    background-color: green;
    color: white;
    border-radius: 5px;
}

.tabs-item-active{
    background-color: green;
    color: white;
    border-radius: 5px;
}

.contenedor{
 border-style: groove;
 padding: 5px;
 border-radius: 5px;
}

</style>