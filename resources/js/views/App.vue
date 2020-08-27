<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <task-bar></task-bar>
                <tasks-history></tasks-history>
            </div>
        </div>
    </div>
</template>

<script>
import TaskBar from "../components/TaskBar";
import TasksHistory from "../components/TasksHistory";

export default {
    components: {TaskBar, TasksHistory},
    data(){
        return {
        }
    },
    mounted() {
        this.$store.dispatch('getTask');
    },
}
</script>

