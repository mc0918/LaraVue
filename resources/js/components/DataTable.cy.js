import DataTable from './DataTable.vue'

describe('<DataTable />', () => {
  it('renders', () => {
    // see: https://on.cypress.io/mounting-vue
    cy.mount(DataTable, {
        props: {
            fields: [
                "name"
            ],
            countries: [
                {
                    name: "United States",
                },
                {
                    name: "Mexico"
                }
            ]
        }
    })
  })
})
