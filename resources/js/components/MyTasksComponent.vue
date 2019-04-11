<template>
    <div class="row justify-content-center">
        <div class="col-md-8">
            

            <form-component 
            @new="addTask"></form-component>

            <tasks-component v-for="(task, index) in tasks" 
            :key="task.id" 
            :task="task"
            @delete="deleteTask(index)"
            @update="updateTask(index, ...arguments)"></tasks-component><!--task el objeto que se envia tambien puede ser {id:'', description:''...}-->


        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                tasks: []
            }
        },
        mounted() {
            axios.get('tasks')
            .then((response)=>{
                this.tasks = response.data;
            });
        },
        methods:{
            addTask(task){
                this.tasks.push(task); 
            },
            deleteTask(index){
                this.tasks.splice(index,1);
            },
            updateTask(index, task){
                this.tasks[index]= task;
            }
        }
    }
</script>
