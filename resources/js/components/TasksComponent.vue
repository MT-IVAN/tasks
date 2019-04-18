<template>
    <div class="card p-12">
        <div v-if="task.status=='creado'" class="card-header bg-danger progress-bar" >Estado de la tarea: <strong>{{task.status}}</strong></div>
        <div v-if="task.status=='ejecucion'" class="card-header bg-info progress-bar">Estado de la tarea: <strong>{{task.status}}</strong></div>
        <div v-if="task.status=='terminado'" class="card-header bg-success progress-bar">Estado de la tarea: <strong>{{task.status}}</strong></div>
                <div class="card-body">
                    
                    
                    <textarea v-if="editMode" type="text" v-model="task.description" > </textarea>
                    <h3 v-else style="white-space: pre-line;" >{{task.description}}</h3>
                <hr>      


                <div class="panel-footer">
                <button v-if="task.status=='creado'" class="btn btn-outline-info btn-sm" v-on:click="onClickUpdateStatus()" >Iniciar tarea</button>
                <button v-if="task.status=='ejecucion'" class="btn btn-outline-info btn-sm" v-on:click="onClickUpdateStatus()" >Terminar tarea</button>
                <button v-if="task.status=='terminado'" class="btn btn-outline-info btn-sm" disabled>Tarea terminada</button>


                <button class="btn btn-outline-dark float-right btn-sm" v-on:click="onClickDelete()">Eliminar</button> 
                <button class="btn btn-outline-info float-right btn-sm" v-if="editMode"  v-on:click="onClickUpdate()">Guardar cambios </button>
                <button class="btn btn-outline-info float-right btn-sm" v-else  v-on:click="onClickEdit()">Editar </button>
                           
                </div>
                
                
               

        </div>
                
    </div>
    

</template>

<script>
    export default {
        props: ['task'],
        data(){
            return {
                editMode: false
            };
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods:{
            onClickDelete() {
                axios.delete(`tasks/${this.task.id}`).then(() => {
                    this.$emit('delete');
                });
            },
            onClickEdit() {
                this.editMode = true;
            },

            onClickUpdate(){
                const params = {
                    description: this.task.description
                };

                    axios.put(`tasks/${this.task.id}` , params).then((response)=>{
                         this.editMode = false;
                        const task = response.data;
                        this.$emit('update', task);

                    });
                   
            },
            onClickUpdateStatus(){
                const params = {
                    status: ''
                };

                if(this.task.status == 'creado'){
                    params.status = 'ejecucion';
                }else if(this.task.status == 'ejecucion'){
                    params.status = 'terminado';
                }
                axios.put(`tasks/update/status/${this.task.id}` , params).then((response)=>{
                        const task = response.data;
                        this.$emit('update2', task);

                    });

            }
            
        }
    }
</script>
