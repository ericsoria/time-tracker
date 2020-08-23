<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <task-bar></task-bar>
                <div style="margin-top: 50px">
                    <slot v-for="task in tasks">
                        <div class="card" style="margin: 10px 0">
                            <div class="card-header" style="font-weight: bold">
                                {{ task.task_timers[0].dateTime | dateFormat }}
                            </div>
                            <div class="card-body">
                                <div class="task">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label class="counter">{{task.task_timers.length}}</label>
                                            {{task.name}}
                                        </div>
                                        <div class="col-lg-6" style="text-align: right">
                                            <span>Total: {{task.totalTime}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <slot v-for="(taskTime, index) in task.task_timers">
                                        <div class="task subtask">
                                           <div class="row">
                                               <div class="col-lg-6 col-12 offset-lg-3" style="text-align: center">
                                                   <label>From: </label>
                                                   <label style="font-weight: bold">{{taskTime.startTime | formatTime}}</label>

                                                   <label>To: </label>
                                                   <label style="font-weight: bold">{{taskTime.endTime | formatTime}}</label>
                                               </div>
                                               <div class="col-lg-3 col-12" style="text-align: center">
                                                   <label>Time:</label>
                                                   <label style="font-weight: bold">{{taskTime.elapsedTime}}</label>
                                               </div>
                                           </div>
                                        </div>
                                    </slot>
                                </div>
                            </div>
                        </div>
                    </slot>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import TaskBar from "../components/TaskBar";
import { mapState } from 'vuex';

export default {
    components: {TaskBar},
    data(){
        return {
        }
    },
    computed: {
        ...mapState(['tasks'])
    },
    mounted() {
        this.$store.dispatch('getTask');
    },
    filters: {
        dateFormat: function (d) {
            let today = new Date();
            let date = new Date(d);

            if (today.getDate() === date.getDate()) {
                return 'Today';
            }

            return date.getDay() + '/' + (date.getMonth()+1) + '/' + date.getFullYear()
        },
        formatTime: function (time) {
            let date = new Date(time);

            return date.toLocaleTimeString([], { hour12: true});
        }
    }
}
</script>

<style>
    #app {
        background: #f6f9fc;
        width: 100%;
        height: 100vh;
        padding:20px;
    }
    .task {
        width: 100%;
        border: 1px solid #dbdbdb;
        padding: 10px;
    }
    .subtask {
        background: whitesmoke;
    }
    label.time {
        border: 1px solid #dbdbdb;
        padding: 4px;
    }
    .time-box input {
        display: inline;
    }

    input[type="text"]:disabled {
        background: white;
    }

    input[type="text"] {
        text-align: center;
    }
    label.counter {
        background: #a9a9a9;
        color: white;
        padding: 1px 5px;
        font-size: 10px;
    }
</style>
