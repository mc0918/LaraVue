<script>
    export default {
        props: {
            countries: Object,
            fields: Object
        },
        setup(props) {
            console.log(props.countries);
        }
    }
</script>

<template>
    <table id="tableComponent" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th v-for="field in fields" :key='field'>
                    {{ field }}
                </th>
            </tr>
        </thead>
        <tbody>
        <tr v-for="country in countries" :key="country.name">
            <td v-for="field in fields">
                {{country[field]}}
            </td>
        </tr>

        </tbody>
    </table>
</template>

<style scoped>

</style>

<!-- table header w/ API buttons   -->
<!-- table rows   -->
