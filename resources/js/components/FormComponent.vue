<template>
    <div class="card">
                <div class="card-header">Mi siguiente tarea sera</div>

                <div class="card-body">
                   

                    <form action="" v-on:submit.prevent="newTask()"><!--prevent se lo usa para que no recague pagina. No method GET -->
                        <div class="form_group">
                            <label for="task">Mi siguiente tarea es</label>
                            <input type="text" class="form-control" name="task" v-model="modelDescription" >
                            <h4>hgodsf</h4>
                        </div>
                        
                        
                        <div v-if="modelDescription.length > 5">
                           <p>mayor</p>
                        </div>
                        <div v-else-if="modelDescription.length < 5">
                            menor
                        </div>



                        <button type="submit" class="btn btn-primary">Crear tarea</button>
                    </form>    
                </div>
            </div>
</template>

<script>
    export default {
        data(){
            return {
                modelDescription: ''
            };
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods:{
            newTask(){
                const params= {
                    description: this.modelDescription
                };
                this.modelDescription = '';

                axios.post('tasks', params)
                .then((response)=> {
                    const task = response.data;
                     this.$emit('new', task);
                });

            }
        }
    }
</script>
