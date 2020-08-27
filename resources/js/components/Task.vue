<template>
    <div>
        <div class="task">
            <div class="row">
                <div class="col-lg-6 col-6">
                    <label class="counter">{{task.taskTimers.length}}</label>
                    <label style="font-weight: bold;">{{task.name}}</label>
                </div>
                <div class="col-lg-6 col-6" style="text-align: right">
                    <i class="fas fa-stopwatch d-sm-none"></i>
                    <label class="total-time d-none d-sm-inline-block">Total time:</label>
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
</template>

<script>
    export default {
        name: 'task',
        props: ['task'],
        filters: {
            formatTime: function (time) {
                let date = new Date(time);
                return date.toLocaleTimeString([], { hour12: false});
            }
        }
    }
</script>
