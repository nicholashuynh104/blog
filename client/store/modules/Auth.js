import axios from "axios"

export default {
    namespaced: true,
    state() {
      return {
        admins: {},
        token: localStorage.getItem('token') || "",
        isloading: false,
      }
    },
    getters() {
      return {
        token: (state) => {
          return state.token;
        },
        admins: (state) => {
          return state.users
        },
        isloading: (state) => {
          return state.isloading
        }
      }
    },
    mutations() {
      return {
        setAdmins(state, admins) {
          state.admins = admins;
        },
        setToken(state, token) {
          state.token = token;
        },
      }
    },
    actions() {
      return {
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
    }
    }
  }
};
