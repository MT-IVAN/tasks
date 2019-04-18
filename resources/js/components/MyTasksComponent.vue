<template>
    <div>
        <div class="card-columns">

            <tasks-component v-for="(task, index) in tasks" 
            :key="task.id" 
            :task="task"
            @delete="deleteTask(index)"
            @update="updateTask(index, ...arguments)"
            @update2="updateTask2(index, ...arguments)"></tasks-component><!--task el objeto que se envia tambien puede ser {id:'', description:''...}-->
            
           

        </div>

             <hr>
             <div class='justify-content-center col-md-6'>
             <form-component 
            @new="addTask"></form-component>
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
                this.tasks[index].description= task.description;
                console.log(task);
            },
            updateTask2(index,task){
                this.tasks[index].status = task.status;
                console.log(task);
            }
        }
    }
</script>