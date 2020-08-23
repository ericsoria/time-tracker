<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <task-bar></task-bar>
                <div style="margin-top: 50px">
                    <slot v-for="(tasksArray , date) in tasks">
                        <div class="card" style="margin: 10px 0">
                            <div class="card-header" style="font-weight: bold">
                                {{ date | dateFormat }}
                            </div>
                            <slot v-for="task in tasksArray">
                                <div class="card-body">
                                    <div class="task">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label class="counter">{{task.taskTimers.length}}</label>
                                                <label style="font-weight: bold;">{{task.name}}</label>
                                            </div>
                                            <div class="col-lg-6" style="text-align: right">
                                                <label class="total-time">Total time:</label>
                                                <span style="font-weight: bold">{{task.totalTime}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <slot v-for="(taskTime, index) in task.taskTimers">
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
                            </slot>
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
            return date.toLocaleTimeString([], { hour12: false});
        }
    }
}
</script>

<style>
    #app {
        background: #f6f9fc;
        width: 100%;
        height: 100%;
        padding:20px;
    }
    .task {
        background: whitesmoke;
        border-top-left-radius: 3px;
        border-top-right-radius: 3px;
        width: 100%;
        border: 1px solid #dbdbdb;
        padding: 10px;
        height: 45px;
    }
    .subtask {
        background: white;
        height: 40px;
        border-top-left-radius: 0px;
        border-top-right-radius: 0px;
        border-top: none;

    }
    label.counter {
        background-color: #007bff;
        color: white;
        padding: 1px 5px;
        font-size: 10px;
    }
   .total-time {
        color: #007bff;
        font-weight: bold;
    }
</style>
