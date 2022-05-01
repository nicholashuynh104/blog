<template>
  <div>
    <SidebarVue />
    <v-container>
      <v-card>
        <v-card-text class="d-flex justify-space-between align-center">
          <v-card-title> Category ( {{ totalCategory }} ) </v-card-title>
          <v-card-actions>
            <nuxt-link to="/admin/create-category">
              <v-btn color="red lighten-2">New </v-btn>
            </nuxt-link>
          </v-card-actions>
        </v-card-text>
        <hr />

        <v-card-subtitle>
          <div v-if="isloading">
            <h1 class="text-center my-3">
              <img src="~/static/loading.svg" alt="" />
            </h1>
          </div>
          <div v-else>
            <v-simple-table>
              <template v-slot:default>
                <thead>
                  <tr>
                    <th class="text-left">Id</th>
                    <th class="text-left">Category</th>
                    <th class="text-left">Status</th>
                    <th class="text-left">Edit</th>
                    <th class="text-left">Delete</th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                  >
                    <td class="text-left">1</td>
                    <td class="text-left">category name</td>
                    <td class="text-left">1</td>
                    <td class="text-left">
                      <nuxt-link :to="`/admin/update-category/`">
                        <v-btn
                          text
                          class="ma-2"
                          @click="edit_dialog = true"
                          variant="text"
                          color="blue"
                        >
                          <v-icon color="blue darken-3"> mdi-pencil</v-icon>
                        </v-btn>
                      </nuxt-link>
                    </td>
                    <td class="text-left">
                      <v-btn
                        text
                        class="ma-2"
                        variant="text"
                        color="red"
                      >
                        <v-icon color="red darken-3"> mdi-delete</v-icon>
                      </v-btn>
                    </td>
                  </tr>
                </tbody>
              </template>
            </v-simple-table>
          </div>
        </v-card-subtitle>
      </v-card>
    </v-container>
  </div>
</template>
<script>
import SidebarVue from "../../components/admin/Sidebar.vue";
export default {
  name: "CategoryPage",
  data: () => ({
    totalCategory: 0,
  }),

  components: {
    SidebarVue,
  },
  async mounted() {
    const config = {
      headers: {
        Authorization: "Bearer " + localStorage.getItem("token"),
      },
    };
    this.isloading = true;

  },
};
</script>
<style>
</style>
