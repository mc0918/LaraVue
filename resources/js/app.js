import { createApp } from 'vue'
import DataTable from './components/DataTable.vue'
import "bootstrap/dist/css/bootstrap.min.css";


const app = createApp()

app.component('datatable', DataTable)

app.mount('#app')
