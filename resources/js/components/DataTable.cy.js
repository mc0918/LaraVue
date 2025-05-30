import DataTable from './DataTable.vue'

describe('<DataTable />', () => {
  it('renders', () => {
    // see: https://on.cypress.io/mounting-vue
      cy.mount(DataTable, {
          props: {
              fields: [
                  'name',
                  'capital',
                  'languages',
                  'landlocked',
                  'population',
                  'region',
                  'subregion',
                  'flag',
                  'coatOfArms'
              ],
              countries: [
                  {
                      name: "Country 1",
                      capital: "Capital 1",
                      languages: "Language 1",
                      landlocked: true,
                      population: 1,
                      region: "Region 1",
                      subregion: "Subregion 1",
                      flag: "Flag 1",
                      coatOfArms: "https://images.pexels.com/photos/32131630/pexels-photo-32131630/free-photo-of-scenic-road-through-canadian-rockies-in-jasper.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
                  },
                  {
                      name: "Country 2",
                      capital: "Capital 2",
                      languages: "Language 2",
                      landlocked: false,
                      population: 987654321,
                      region: "Region 2",
                      subregion: "Subregion 2",
                      flag: "Flag 2",
                      coatOfArms: "https://images.pexels.com/photos/31762654/pexels-photo-31762654/free-photo-of-adorable-otter-on-mossy-rock-in-sweden.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
                  }
              ]
          }
      });

      cy.get('tr').should('have.length', 3); //including headers

      // Ensure the search bar functions
      cy.get(`[data-cy="country-search"]`).type("Country 1");
      cy.get('tr').should('have.length', 2);
      cy.get('tr').contains('Country 1').should('exist');
  })
})
