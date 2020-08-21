<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <task-bar></task-bar>
            </div>
        </div>
    </div>
</template>

<script>
import TaskBar from "../components/TaskBar";

export default {
    components: {TaskBar}
}
</script>

<style>
    #app {
        background: #fafafa;
        width: 100%;
        height: 100vh;
        padding:20px;
    }
</style>
