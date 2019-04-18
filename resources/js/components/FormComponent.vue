<template>
    <div>
                <div class="card-header">Mi siguiente tarea sera</div>

                <div class="card-body">
                   
                    <!-- https://www.youtube.com/watch?v=bmtD9GUaszw&pbjreload=10 -->
                    <form action="" v-on:submit.prevent="newTask()"><!--prevent se lo usa para que no recague pagina. No method GET -->
                        <div class="form_group">
                            <label for="task">Mi siguiente tarea es</label>
                            <input autocomplete="off" type="text" class="form-control" name="task" v-model="modelDescription" >
                            <div v-if="modelDescription.length == 0 ">
                            <button type="submit" class="btn btn-primary" disabled>Crear tarea</button>
                            </div>
                            
                            <div v-else-if="modelDescription.length > 100 || modelDescription.length < 3 ">
                            <button type="submit" class="btn btn-primary" disabled>Crear tarea</button>
                            <div class="alert alert-danger" role="alert">
                            La tarea solo puede contener 100 caracteres y minimo 2 caracteres
                            </div>
                            </div>
                            <div v-else-if="modelDescription.length <= 100">
                             <button type="submit" class="btn btn-primary">Crear tarea</button>
                            </div>
                        </div>        
                    </form>    
                </div>
            </div>
</template>

<script>
    export default {
        data(){
            return {
                modelDescription: '',
                status: ''
            };
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods:{
            newTask(){
                const params= {
                    description: this.modelDescription,
                    status: "creado"
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
