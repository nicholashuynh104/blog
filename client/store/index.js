import axios from 'axios';

export const state = () => ({
    admins: {},
    token: localStorage.getItem('token') || "",
    isloading: false,
})

export const mutations = {
    setAdmins(state, admins) {
        state.admins = admins;
    },
}

export const actions = {
    // Admins side
    // admin login
    async adminLogins({ commit }, data) {
        commit('setIsLoading', true);
        const admins = await axios.post('http://localhost:8000/api/login', data);
        if (admins.data.success) {
            this.$toast.show(admins.data.message, {
                type: "success",
            });
            commit('setToken', admins.data.token);
            localStorage.setItem('token', admins.data.token);
            this.$router.push('/admin/dashboard')
        } else {
            this.$toast.show(admins.data.message, {
                type: "error",
            });
        }
    },
}
