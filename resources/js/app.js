import { createApp } from 'vue'
import DataTable from './components/DataTable.vue'
import FavoriteList from "./components/FavoriteList.vue";
import "bootstrap/dist/css/bootstrap.min.css";


const app = createApp()

app.component('datatable', DataTable)
app.component('favoriteList', FavoriteList)

app.mount('#app')
