<template>
  <div>
    {{ lastRoute }}
  </div>
</template>

<script>
import { mapGetters } from 'vuex';

export default {
  name: 'LastRouteTravelTime',
  data() {
    return {};
  },
  computed: {
    ...mapGetters({
      lastRoute: 'route/lastRoute', 
    }),
  },
}
</script>

<style>

</style>