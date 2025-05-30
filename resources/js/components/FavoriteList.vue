<script>
export default {
    name: "FavoriteList",
    props: {
        checkedCountries: Array
    },
    methods: {
        saveFavorite(event) {
            event.preventDefault();

            console.log(JSON.stringify(this.checkedCountries));
            const requestOptions = {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify(this.checkedCountries)
            };

            fetch("/save", requestOptions)
                .then(response => response.json())
                .then(data => console.log(data.success));
        },
        viewFavorites() {
            fetch("/favorites")
                .then(response => response.json())
                .then(data => console.log(data));
        }
    }
}
</script>


<template>
        <button class="button" @click="saveFavorite">
            Save Selected To New List
        </button>
        <button class="button">
            View Favorites
        </button>
</template>

<style scoped>
    .button {
        background-color: cornflowerblue;
        border: 1px solid darkslateblue;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        transition-duration: 0.4s;
    }

    .button:hover {
        background-color: midnightblue;
        color: white;
    }
</style>
