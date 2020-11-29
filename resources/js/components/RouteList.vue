<template>
    <div class="p-1 px-2">
        <h6 class="text-center">Routes list</h6>
        <table class="table table-hover table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Date</th>
                    <th scope="col">Start</th>
                    <th scope="col">Finish</th>
                    <th scope="col">Time</th>
                </tr>
            </thead>
            <tbody>
                <tr @click="onSetCurrentRoute(route)" v-for="(route, index) in routes" :key="route.id" :class="[{ 'active': currentRoute && currentRoute.id === route.id }, 'pointer']">
                    <th scope="row">{{ index + 1 }}</th>
                    <td>{{ getDate(route.created_at) }}</td>
                    <td>{{ getTime(route.created_at) }}</td>
                    <td>{{ getTime(route.ended_at) }}</td>
                    <td>{{ getTotalTime(route) }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
import axios from 'axios';
import { mapActions, mapGetters } from 'vuex';
import moment from 'moment';

export default {
    name: "RouteList",
    data() {
        return {
            routes: [],
        };
    },
    computed: {
        ...mapGetters({
            currentRoute: 'route/currentRoute',
        }),
    },
    created() {
        this.fetchRoutes();
        // setInterval(() => {
        // }, 2000)
    },
    methods: {
        getTime(date) {
            return moment(date).format('LTS');
        },
        getDate(date) {
            return moment(date).format('L');
        },
        getTotalTime(route) {
            let coordinates = route.coordenadas;
            let start, end;

            if (route.created_at && route.ended_at) {
                let start = moment(route.created_at);
                let end = moment(route.ended_at);
                return calculate(start, end);
            } else if (!route.ended_at && coordinates.length > 0) {
                let start = moment(route.created_at);
                let end = moment(coordinates[coordinates.length-1].created_at);
                return calculate(start, end);
            }

            function calculate(start, end) {
                let h  = end.diff(start, 'hours');
                let m  = end.diff(start, 'minutes') - (60 * h);
                let s  = end.diff(start, 'seconds') - (60 * 60 * h) - (60 * m);

                // Formating in hh:mm:ss (appends a left zero when num < 10)
                let hh = ('0' + h).slice(-2);
                let mm = ('0' + m).slice(-2);
                let ss = ('0' + s).slice(-2);

                return `${hh}:${mm}:${ss}`;
            }

            return '00:00:00'
        },
        fetchRoutes() {
            axios.get('api/getAllRoutes/').then(res => {
                console.log(res);
                this.routes = res.data;
            });
        },
        onSetCurrentRoute(route) {
            route.time = this.getTotalTime(route);

            this.setCurrentRoute(route);
        },
        ...mapActions({
            setCurrentRoute: 'route/SET_CURRENT_ROUTE',
        }),
    },
};
</script>
<style lang="css" scope>
.active {
    color: #212529;
    background-color: rgba(0, 0, 0, 0.075);
}
.pointer {
    cursor: pointer;
}
</style>
