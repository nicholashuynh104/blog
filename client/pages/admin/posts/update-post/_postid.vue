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
            <v-card-title> Update Post</v-card-title>
            <v-card-subtitle>
              <form action="" class="form" @submit.prevent="update">
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
                <img
                  :src="'http://localhost:8000/storage/'"
                  alt=""
                  width="70"
                  cover
                />

                <input type="hidden" />
                <br />
                <v-btn color="error" type="submit" class="login__btn">
                 update</v-btn
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
import SidebarVue from "~/components/admin/Sidebar.vue";
import axios from "axios";
import { mapActions } from "vuex";

export default {
  name: "updatePostPage",
  components: {
    SidebarVue,
  },
  data: () => ({
    title: "",
    description: "",
    cat_id: "",
    old_image: "",
    new_image: "",
  }),
};
</script>
<style>
</style>
