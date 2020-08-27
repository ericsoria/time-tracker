<template>
    <div style="margin-top: 50px">
        <slot v-for="(tasksArray , date) in tasks">
            <div class="card" style="margin: 10px 0">
                <div class="card-header" style="font-weight: bold">
                    {{ date | dateFormat }}
                </div>
                <slot v-for="task in tasksArray">
                    <div class="card-body">
                    <task :task ="task"></task>
                    </div>
                </slot>
            </div>
        </slot>
    </div>
</template>

<script>
    import {mapState} from "vuex";
    import Task from "../components/Task"
    export default {
        name: 'tasks-history',
        components: {
            Task,
        },
        computed: {
            ...mapState(['tasks'])
        },
        filters: {
            dateFormat: function (d) {
                let today = new Date();
                let date = new Date(d);

                if (today.getDate() === date.getDate()) {
                    return 'Today';
                }

                return date.getDay() + '/' + (date.getMonth()+1) + '/' + date.getFullYear()
            }
        }
    }
</script>
