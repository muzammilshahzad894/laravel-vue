<template>
    <div class="todo-list">
        <h1>My To-Do List</h1>
        <div class="p-inputgroup">
            <InputText v-model="newTask" @keyup.enter="addTask" placeholder="Add a new task" />
            <Button @click="addTask" class="p-button-primary">Add</Button>
        </div>
        <ul class="p-list">
            <li v-for="task in tasks" :key="task.id" class="p-list-item">
                <span class="task-description">{{ task.description }}</span>
                <Button @click="removeTask(task.id)" icon="pi pi-trash"
                    class="p-button-danger p-button-rounded p-button-sm" />
            </li>
        </ul>
    </div>
</template>
  
<script>
import axios from 'axios';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';

export default {
    data() {
        return {
            newTask: '',
            tasks: [],
        };
    },
    mounted() {
        this.fetchTasks();
    },
    methods: {
        async fetchTasks() {
            const response = await axios.get('/api/tasks');
            this.tasks = response.data;
        },
        async addTask() {
            if (this.newTask.trim() !== '') {
                const response = await axios.post('/api/tasks', { description: this.newTask.trim() });
                this.tasks.push(response.data);
                this.newTask = '';
            }
        },
        async removeTask(taskId) {
            await axios.delete(`/api/tasks/${taskId}`);
            this.tasks = this.tasks.filter((task) => task.id !== taskId);
        },
    },
    components: {
        InputText,
        Button,
    },
};
</script>
  
<style scoped>
.todo-list {
    max-width: 400px;
    margin: auto;
}

h1 {
    text-align: center;
}

.p-inputgroup {
    margin-bottom: 1rem;
}

.task-description {
    margin-right: 1rem;
}

.p-list-item {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-top: 10px;
}

.p-button-sm {
    width: 2rem;
    height: 2rem;
}
</style>
  