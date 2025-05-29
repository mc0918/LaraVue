<script setup>
    import { ref } from 'vue'

    const count = ref(0)
</script>

<template>
    <table id="tableComponent" class="table table-bordered table-striped">
        <thead>
            <tr>
                <td>banana</td>
                <td>orangutan</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    fruite
                </td>
                <td>monkee</td>
            </tr>
        </tbody>
    </table>
</template>

<style scoped>

</style>

<!-- table header w/ API buttons   -->
<!-- table rows   -->
