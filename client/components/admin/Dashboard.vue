<template>
  <div>
    <v-container>
      <div v-if="isloading">
        <h3 class="text-center my-4 text-white">
          <img src="~/static/loading.svg" alt="" />
        </h3>
      </div>
      <div v-else>
        <v-row>
          <v-col xl="4" lg="4" md="4" sm="6">
            <v-card class="d-flex justify-space-between">
              <v-card-header name>
                <v-card-title>Post</v-card-title>
                <v-card-subtitle>{{ totalPost }}</v-card-subtitle>
              </v-card-header>
              <v-card-actions>
                <v-icon large color="blue-grey darken-2">
                  mdi-post
                </v-icon></v-card-actions
              >
            </v-card>
          </v-col>
          <v-col xl="4" lg="4" md="4" sm="6">
            <v-card class="d-flex justify-space-between">
              <v-card-header name>
                <v-card-title>Category</v-card-title>
                <v-card-subtitle>{{ totalCategory }}</v-card-subtitle>
              </v-card-header>
              <v-card-actions>
                <v-icon large color="blue-grey darken-2">
                  mdi-widgets
                </v-icon></v-card-actions
              >
            </v-card>
          </v-col>
          <v-col xl="4" lg="4" md="4" sm="6">
            <v-card class="d-flex justify-space-between">
              <v-card-header name>
                <v-card-title>Comments</v-card-title>
                <v-card-subtitle>{{ totalComment }}</v-card-subtitle>
              </v-card-header>
              <v-card-actions>
                <v-icon large color="blue-grey darken-2">
                  mdi-gavel
                </v-icon></v-card-actions
              >
            </v-card>
          </v-col>
          <v-col xl="4" lg="4" md="4" sm="6">
            <v-card class="d-flex justify-space-between">
              <v-card-header name>
                <v-card-title>Contacts</v-card-title>
                <v-card-subtitle>{{ totalContact }}</v-card-subtitle>
              </v-card-header>
              <v-card-actions>
                <v-icon large color="blue-grey darken-2">
                  mdi-gavel
                </v-icon></v-card-actions
              >
            </v-card>
          </v-col>
          <v-col xl="4" lg="4" md="4" sm="6">
            <v-card class="d-flex justify-space-between">
              <v-card-header name>
                <v-card-title>Subscribe</v-card-title>
                <v-card-subtitle>{{ totalSubscribe }}</v-card-subtitle>
              </v-card-header>
              <v-card-actions>
                <v-icon large color="blue-grey darken-2">
                  mdi-gavel
                </v-icon></v-card-actions
              >
            </v-card>
          </v-col>
        </v-row>
      </div>
    </v-container>
  </div>
</template>

<script>
// import DashboardVue from "./Dashboard.vue";

export default {
  name: "DasboardComp",
  components: {
    // DashboardTableVue,
  },
  data: () => ({
    totalCategory: 0,
    totalPost: 0,
    totalComment: 0,
    totalContact: 0,
    totalSubscribe: 0,
    isloading: false,
  }),
  async mounted() {
    this.isloading = true;
  }
}
</script>

<style>

</style>
