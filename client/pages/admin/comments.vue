<template>
  <div>
    <SidebarVue />
    <v-container>
      <v-card>
        <v-card-text class="d-flex justify-space-between align-center">
          <v-card-title> Comments ( {{ totalComment }} ) </v-card-title>
        </v-card-text>
        <hr />
        <v-card-subtitle>
          <div v-if="$store.state.isloading">
            <h1 class="text-center my-3">
              <img src="~/static/loading.svg" alt="" />
            </h1>
          </div>
          <div v-else>
            <v-simple-table>
              <template v-slot:default>
                <thead>
                  <tr>
                    <th class="text-enter">Id</th>
                    <th class="text-enter">Name</th>
                    <th class="text-enter">Email</th>
                    <th class="text-enter">Comment</th>
                    <th class="text-enter">Delete</th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    v-for="(comment, index) in $store.state.adminComments"
                    :key="index"
                  >
                    <td class="">{{ index + 1 }}</td>
                    <td class="">{{ comment.name }}</td>
                    <td class="">{{ comment.email }}</td>
                    <td class="">{{ comment.comment }}</td>
                    <td class="">
                      <v-btn
                        @click="delComment(comment.id)"
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
import { mapActions } from "vuex";
import axios from "axios";
export default {
  name: "CommentPage",
  components: {
    SidebarVue,
  },

  data: () => ({
    totalComment: 0,
  }),
};
</script>
<style>
</style>
