<template>
    <span>{{ latlng }}</span>
</template>
<script>
import { mapGetters } from 'vuex';

export default {
    name: "CurrentRouteLatlng",
    data() {
        return {};
    },
    computed: {
        latlng() {
            return this.lastRoute && this.lastRoute.coordenadas ? 
                `${this.lastRoute.coordenadas[this.lastRoute.coordenadas.length - 1].latitud}, ${this.lastRoute.coordenadas[this.lastRoute.coordenadas.length - 1].longitud}` :
                '';
        },
        ...mapGetters({
            lastRoute: 'route/lastRoute',
        }),
    },
    methods: {},
};
</script>
