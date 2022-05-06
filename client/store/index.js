import axios from "axios"

export default ({
  namespaced: true,
  state: {
    admins: {},
    token: localStorage.getItem('token') || "",
    isloading: false,
    //category
    category: []
  },
  // getters: {
  //   token: (state) => {
  //     return state.token;
  //   },
  //   admins: (state) => {
  //     return state.users
  //   },
  //   isloading: (state) => {
  //     return state.isloading
  //   },
  //   //category
  //   category: (state) => {
  //     return state.category
  //   }
  // },
  mutations: {
    setAdmins(state, admins) {
      state.admins = admins;
    },
    setToken(state, token) {
      state.token = token;
    },
    setCategory(state, category) {
      state.category = category;
    },
    setIsLoading(state, isloading) {
      state.isloading = isloading;
    },
  },
  actions: {
    // Admins side
    // admin login
    async adminLogins({ commit }, data) {
      commit('setIsLoading', true);
      const admins = await axios.post('http://localhost:8000/api/login', data);
      if (admins.data.success) {
          this.$toast.show(admins.data.message, {
              type: "success",
              duration: 600,
              position: "bottom-right"
          });
          commit('setToken', admins.data.token);
          localStorage.setItem('token', admins.data.token);
          this.$router.push('/admin/dashboard')
      } else {
          this.$toast.show(admins.data.message, {
              type: "error",
              duration: 600,
              position: "bottom-right"
          });
      }
  },

  async getAdminInfo({ commit }) {
    const config = {
      headers: {
          "Authorization": "Bearer " + localStorage.getItem("token"),
      }
    };
    const admins = await axios.get('http://localhost:8000/api/admin/info', config);
    commit('setAdmins',admins.data)
  },

  async adminLogout({ commit },_) {
    const config = {
      headers: {
          "Authorization": "Bearer " + localStorage.getItem("token"),
      }
    };
    const admins = await axios.post('http://localhost:8000/api/admin/logout',_,config);
    commit('setAdmins', '');
    commit('setToken', '');
    localStorage.setItem('token','');
    this.$router.push('/admin');
    this.$toast.show('logout Successfully', {
      type: "success",
      duration: 600,
    });
  },

  //category
  //create new category
  async createCategory({ commit}, data) {
    const config = {
      headers: {
        "Authorization": "Bearer " + localStorage.getItem("token"),
      }
    };
    const category = await axios.post('http://localhost:8000/api/admin/category', data, config);
    if (category.data.success) {
      this.$toast.show(category.data.message, {
          type: "success",
          duration: 600,
          position: "bottom-right"
      });
      commit('setIsLoading', true);
      data.category_name = '';
      this.$router.push('/admin/Category')
    } else {
      this.$toast.show(category.data.message, {
          type: "error",
          duration: 600,
          position: "bottom-right"
      });
      commit("setIsLoading", false)
    }
  },
  //Get all category
  async getCategories({ commit}) {
    const config = {
      headers: {
        "Authorization": "Bearer " + localStorage.getItem("token"),
      }
    };
    const categories = await axios.get('http://localhost:8000/api/admin/categories',config);
    if (categories.data.success) {
      commit('setIsLoading', false);
      commit('setCategory', categories.data.category);
    }
  },
  //Delete category
  async deleteCategory(_,id) {
    const config = {
      headers: {
        "Authorization": "Bearer " + localStorage.getItem("token"),
      }
    };
    const categories = await axios.delete(`http://localhost:8000/api/admin/category/${id}`,config);
    if (categories.data.success) {
      this.$toast.show(categories.data.message, {
          type: "success",
          duration: 600,
          position: "bottom-right"
      });
    } else {
      this.$toast.show(categories.data.message, {
          type: "error",
          duration: 600,
          position: "bottom-right"
      });
    }
  },
  //update category
  async updateCategory({ commit}, data) {
    const config = {
      headers: {
        "Authorization": "Bearer " + localStorage.getItem("token"),
      }
    };
    const categories = await axios.post(`http://localhost:8000/api/admin/category/${data.id}`,data, config);
    if (categories.data.success) {
      this.$router.push('/admin/Category'),
      this.$toast.show(categories.data.message, {
          type: "success",
          duration: 600,
          position: "bottom-right"
      });
    } else {
      this.$toast.show(categories.data.message, {
          type: "error",
          duration: 600,
          position: "bottom-right"
      });
    }
  },
  }
})
