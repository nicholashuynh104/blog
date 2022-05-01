<template >
  <div>
    <SidebarVue />
    <v-container>
      <v-row justify="center" class="mt-10">
        <v-col xl="6" lg="6" md="6" sm="8" xs="12">
          <nuxt-link to="/admin/post">
            <v-btn color="secondary" class="mb-4">Go Back</v-btn></nuxt-link
          >
          <v-card>
            <v-card-title> Add Post</v-card-title>
            <v-card-subtitle>
              <form action="" class="form" @submit.prevent="addPost">
                <v-text-field
                  label="Enter Titile"
                  class="form__control"
                  hide-details="auto"
                  outlined
                  v-model="title"
                >
                </v-text-field>

                <select
                  name=""
                  id=""
                  placeholder="Select Category"
                  class="selectBox"
                  v-model="cat_id"
                >
                  <option

                  >
                    category_name
                  </option>
                </select>
                <v-textarea
                  class="form__control"
                  label="Enter description"
                  outlined
                  v-model="description"
                ></v-textarea>
                <v-file-input
                  accept="image/*"
                  label="File input"
                  outlined
                  @change="onChangeFile"
                ></v-file-input>

                <v-btn color="error" type="submit" class="login__btn">
                  save</v-btn
                >
              </form>
            </v-card-subtitle>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>
<script>
import SidebarVue from "../../../components/admin/Sidebar.vue";
import { mapActions } from "vuex";
export default {
  name: "createPostPage",
  components: {
    SidebarVue,
  },
  data: () => ({
    cat_id: "",
    title: "",
    file: "",
    description: "",
  }),

};
</script>
<style>
</style>
