import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex)

const store = new Vuex.Store({
    state: {
        tasks: null
    },
    getters: {},
    mutations: {
        addTasks(state, tasks) {
            state.tasks = tasks;
        },
    },
    actions: {
        getTask(context) {
            window.axios.get('/api/tasks').then( (response) => {
                context.commit('addTasks', response.data);
            });
        },
        async createTask(context, data) {
            return await window.axios.post('/api/tasks', data);
        },
        async stopTask(context, taskName) {
            return await window.axios.get('/api/tasks/'+taskName+'/stop',).then( (response) => {
                console.log(response);
            });
        }
    }
})

export default store
