<template>
    <div class="taskbar">
        <div class="row">
            <div class="col-lg-9 col-5">
                <input class="task-name" type="text" placeholder="What are you working on?" v-model="task.name" :disabled="timer.running">
            </div>
            <div class="col-lg-3 col-7" style="text-align: right">
                <span class="timer">{{timer.hours}}:{{timer.minutes}}:{{timer.seconds}}</span>
                <button style="margin-left: 10px; margin-bottom:3px" v-if="!timer.running" :disabled="task.name === null || task.name == ''" class="btn btn-primary" @click="this.startTask">START</button>
                <button style="margin-left: 10px; margin-bottom:3px" v-if="timer.running" class="btn btn-danger" @click="this.stopTask">STOP</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'task-bar',
    data() {
        return {
            task: {
                name: null,
            },
            timer: {
                running: false,
                days: '00',
                hours: '00',
                minutes: '00',
                seconds: '00',
            }
        }
    },
    computed: {
        seconds() {
            return 1000;
        },
        minutes() {
            return this.seconds * 60;
        },
        hours() {
            return this.minutes * 60;
        },
        days() {
            return this.hours * 24;
        }

    },
    methods: {
         startTask() {
             this.$store.dispatch('createTask', this.task);
             const startDate = new Date();
             this.timer.running = true;
             const timeHandler = setInterval(() => {
                const now = new Date();
                const diff = now.getTime() - startDate.getTime();

                if (!this.timer.running) {
                    this.task.name = null;
                    clearInterval(timeHandler)
                    this.timer.minutes ='00';
                    this.timer.seconds = '00';
                    this.timer.hours = '00';
                    return;
                }
                //const days = Math.floor(diff / this.days);
                const hours = Math.floor((diff % this.days) / this.hours);
                const minutes = Math.floor((diff % this.hours) / this.minutes);
                const seconds = Math.floor((diff % this.minutes) / this.seconds);


                this.timer.minutes = minutes < 10 ? '0' + minutes : minutes;
                this.timer.seconds = seconds < 10 ? '0' + seconds : seconds;
                this.timer.hours = hours < 10 ? '0' + hours : hours;
                //this.timer.days = days < 10 ? '0' + days : days;

            }, 1000)
        },
        stopTask() {
            this.$store.dispatch('stopTask', this.task.name).then( () => {
                this.$store.dispatch('getTask');
                this.timer.running = false;
            });
        }
    }
}
</script>

<style>
    span.timer {
        font-size: 28px;
    }
    div.taskbar {
        width: 100%;
        border: 1px solid #dbdbdb;
        height: 60px;
        background: white;
        border-radius: 3px;
        padding: 5px;
    }
    input.task-name {
        padding: 5px;
        height: 100%;
        width: 100%;
        border: 0;
    }
    div.taskbar-controllers > button {
        text-align: right;
    }
</style>
