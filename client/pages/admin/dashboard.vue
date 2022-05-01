<template >
  <div>
    <SidebarVue />
    <DashboardVue />
  </div>
</template>
<script>
import DashboardVue from "../../components/admin/Dashboard.vue";
import SidebarVue from "../../components/admin/Sidebar.vue";
import { mapActions } from "vuex";

export default {
  name: "dashboardPage",
  // middleware: ["auth"],
  components: {
    SidebarVue,
    DashboardVue,
  },
  methods: {
    ...mapActions(['getAdminInfo']),
  },
  mounted() {
    this.getAdminInfo();
  }
};
</script>
<style>
</style>
