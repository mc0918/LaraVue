import { defineConfig } from "cypress";
import vitePreprocessor from "cypress-vite";

export default defineConfig({
  chromeWebSecurity: false,
  retries: 2,
  defaultCommandTimeout: 5000,
  watchForFileChanges: false,
  videosFolder: "tests/cypress/videos",
  screenshotsFolder: "tests/cypress/screenshots",
  fixturesFolder: "tests/cypress/fixture",
  e2e: {
    setupNodeEvents(on) {
      on("file:preprocessor", vitePreprocessor());
    },
    baseUrl: "http://localhost",
    specPattern: "tests/cypress/integration/**/*.cy.{js,jsx,ts,tsx}",
    supportFile: "tests/cypress/support/index.js",
  },

  component: {
    devServer: {
      framework: "vue",
      bundler: "vite",
    },
  },
});
