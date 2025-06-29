import { defineStore } from 'pinia'
import axios from 'axios'

export const useTaskStore = defineStore('taskStore', {
    state: () => ({
        tasks: []
    }),

    actions: {
        async fetchTasks() {
            const response = await axios.get('/api/tasks')
            this.tasks = [];
            // this.tasks = response.data
        },

        async getTask(id) {
            const response = await axios.get(`/api/tasks/${id}`)
            return response.data
        },

        async createTask(taskData) {
            const response = await axios.post('/api/tasks', taskData)
            this.tasks.push(response.data)
            return response.data
        },

        async updateTask(id, updatedData) {
            const response = await axios.put(`/api/tasks/${id}`, updatedData)
            const index = this.tasks.findIndex(task => task.id === id)
            if (index !== -1) {
                this.tasks[index] = response.data
            }
            return response.data
        },

        async deleteTask(id) {
            await axios.delete(`/api/tasks/${id}`)
            this.tasks = this.tasks.filter(task => task.id !== id)
        },

        async toggleTask(id) {
            const response = await axios.patch(`/api/tasks/${id}/toggle`)
            const index = this.tasks.findIndex(task => task.id === id)
            if (index !== -1) {
                this.tasks[index] = response.data.task
            }
            return response.data.task
        }
    }
})