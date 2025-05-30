<script>
    import debounce from 'lodash/debounce';

    export default {
        name: "DataTable",
        props: {
            countries: Object,
            fields: Object
        },
        data() {
            return {
                query: '',
            };
        },
        methods: {
            filterCountries() {
                return this.countries.filter(country => {
                    if (country.name.toLowerCase().includes(this.query.toLowerCase())) {
                        return country;
                    }
                });
            },
            debouncedSearch: debounce(function () {
                this.filterCountries();
            }, 300)
        },

    }
</script>

<template>
    <div class="searchBar">
        <div class="input-group">
            <input type="search" class="form-control" v-model="query" @input="debouncedSearch" placeholder="Search by Country Name">
        </div>
    </div>
    <table id="tableComponent" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Save Country</th>
                <th v-for="field in fields" :key='field'>
                    {{ field.charAt(0).toUpperCase() + field.slice(1).toLowerCase() }}
                </th>
            </tr>
        </thead>
        <tbody>
        <tr v-for="country in filterCountries()" :key="country.name">
            <td>checkbox</td>
            <td v-for="field in fields">
                <div v-if="typeof country[field] === 'boolean'">
                    {{ country[field] ? "yes" : "no"}}
                </div>
                <div v-else-if="field === 'coatOfArms'">
                    <img :src="country[field]" alt="coat of arms" style="width: 10vw"/>
                </div>
                <div v-else>
                    {{country[field]}}
                </div>
            </td>
        </tr>

        </tbody>
    </table>
</template>

<style scoped>

</style>
