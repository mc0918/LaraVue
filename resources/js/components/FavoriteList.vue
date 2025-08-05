<script>
import {count} from "rxjs";

export default {
    name: "FavoriteList",
    props: {
        checkedCountries: Array
    },
    data() {
        return {
            favoriteCountries: [],
            open: false
        }
    },
    methods: {
        count,
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
                .then(data => {
                    this.favoriteCountries = data.sort((a, b) => {a.name.localeCompare(b.name)});
                });
            this.open = !this.open;
        },
        deleteList(id) {
            fetch("/delete/" + id, { method: 'DELETE' })
                .then(() => this.favoriteCountries = this.favoriteCountries.filter(list => list.id !== id));
        },
        deleteCountry(listId, countryId) {
            fetch("/delete/" + listId + "/country/" + countryId, { method: 'DELETE' })
                .then(() => {
                    this.favoriteCountries = this.favoriteCountries.filter(list => list.id !== listId);
                    this.open = !this.open;
                });
        }
    }
}
</script>


<template>
    <button class="button" @click="saveFavorite">
        Save Selected To New List
    </button>
    <button class="button" @click="viewFavorites">
        View Favorites
    </button>
    <li v-if="open" v-for="list in favoriteCountries" :key="list.id">
        <button @click="deleteList(list.id)">
            <svg
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                    fill-rule="evenodd"
                    clip-rule="evenodd"
                    d="M17 5V4C17 2.89543 16.1046 2 15 2H9C7.89543 2 7 2.89543 7 4V5H4C3.44772 5 3 5.44772 3 6C3 6.55228 3.44772 7 4 7H5V18C5 19.6569 6.34315 21 8 21H16C17.6569 21 19 19.6569 19 18V7H20C20.5523 7 21 6.55228 21 6C21 5.44772 20.5523 5 20 5H17ZM15 4H9V5H15V4ZM17 7H7V18C7 18.5523 7.44772 19 8 19H16C16.5523 19 17 18.5523 17 18V7Z"
                    fill="currentColor"
                />
                <path d="M9 9H11V17H9V9Z" fill="currentColor" />
                <path d="M13 9H15V17H13V9Z" fill="currentColor" />
            </svg>
        </button>
        List name: {{list.name}} has {{list.countries.length}} favorite countries:

        <ul v-for="country in list.countries">
            <li>
                <p>
                    {{country.name}}
                    <button @click="deleteCountry(list.id, country.id)">
                        <svg
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                fill-rule="evenodd"
                                clip-rule="evenodd"
                                d="M17 5V4C17 2.89543 16.1046 2 15 2H9C7.89543 2 7 2.89543 7 4V5H4C3.44772 5 3 5.44772 3 6C3 6.55228 3.44772 7 4 7H5V18C5 19.6569 6.34315 21 8 21H16C17.6569 21 19 19.6569 19 18V7H20C20.5523 7 21 6.55228 21 6C21 5.44772 20.5523 5 20 5H17ZM15 4H9V5H15V4ZM17 7H7V18C7 18.5523 7.44772 19 8 19H16C16.5523 19 17 18.5523 17 18V7Z"
                                fill="currentColor"
                            />
                            <path d="M9 9H11V17H9V9Z" fill="currentColor" />
                            <path d="M13 9H15V17H13V9Z" fill="currentColor" />
                        </svg>
                    </button>
                </p>

            </li>
        </ul>
    </li>
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
