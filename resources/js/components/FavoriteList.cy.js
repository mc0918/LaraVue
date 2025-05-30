import FavoriteList from './FavoriteList.vue'

describe('<FavoriteList />', () => {
  it('renders', () => {
    // see: https://on.cypress.io/mounting-vue
    cy.mount(FavoriteList, {
        props: {
            checkedCountries: [
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
    })

    // cy.intercept("POST","/favorites", {
    //   statusCode: 200,
    //   body: [{
    //       countries: [{
    //           capital: "Ulan Bator",
    //           coatOfArms: "https://mainfacts.com/media/images/coats_of_arms/mn.png",
    //           country_list_id: 4,
    //           created_at: "2025-05-30T12:16:00.000000Z",
    //           flag: "🇲🇳",
    //           id: 6,
    //           landlocked: 1,
    //           languages: "Mongolian",
    //           name: "Mongolia",
    //           population: 3278292,
    //           region: "Asia",
    //           subregion: "Eastern Asia",
    //           updated_at: "2025-05-30T12:16:00.000000Z"
    //       }],
    //       created_at: "2025-05-30T12:16:00.000000Z",
    //       id: 4,
    //       name: "test",
    //       updated_at: "2025-05-30T12:16:00.000000Z"
    //   }]
    // });


  })
})
