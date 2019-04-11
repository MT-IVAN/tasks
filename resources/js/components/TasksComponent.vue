<template>
    <div class="card">
        <div class="card-header">Publicado en {{task.created_at}}</div>

                <div class="card-body">
                    
                    
                    <input v-if="editMode" type="text" v-model="task.description" >
                    <p v-else>{{task.description}}</p>
                    


                    <div class="panel-footer">
                        <button class="btn btn-success" v-if="editMode"  v-on:click="onClickUpdate()">Guardar cambios</button>
                        <button class="btn btn-default" v-else  v-on:click="onClickEdit()">Editar</button>

                        <button class="btn btn-danger" v-on:click="onClickDelete()">Eliminar</button>
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
                   
            }
            
        }
    }
</script>
