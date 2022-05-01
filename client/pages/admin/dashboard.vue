<template >
  <div>
    <SidebarVue />
    <DashboardVue />
  </div>
</template>
<script>
import DashboardVue from "../../components/admin/Dashboard.vue";
import SidebarVue from "../../components/admin/Sidebar.vue";

export default {
  name: "dashboardPage",
  // middleware: ["auth"],
  components: {
    SidebarVue,
    DashboardVue,
  },
};
</script>
<style>
</style>
