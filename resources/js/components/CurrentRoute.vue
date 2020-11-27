<template>
    <div>
        <div class="map" id="currentRoute"></div>
    </div>
</template>
<script>
import L from "leaflet";
import axios from 'axios';
import { mapActions, mapGetters } from 'vuex';

export default {
    name: "CurrentRoute",
    data() {
        return {
            map: null,
            tileLayer: null,
            markers: {
                sos: null,
                beginning: null,
                end: null,
            },
            polyline: null,
        };
    },
    computed: {
        ...mapGetters({
            currentRoute: 'route/currentRoute',
        }),
    },
    watch: {
        currentRoute: function(newRoute) {
            this.initLayer(newRoute.coordenadas);
        }
    },
    created() {},
    mounted() {
        this.initMap();
    },
    methods: {
        initLayer(data) {
            var self = this;
            var latlngs = [];
            this.markers.beginning ? this.map.removeLayer(this.markers.beginning) : null;
            this.markers.end ? this.map.removeLayer(this.markers.end) : null;
            this.polyline ? this.map.removeLayer(this.polyline) : null;

            for (let i = 0; i < data.length; i++) {
               latlngs.push([data[i].latitud, data[i].longitud]);
            }

            this.polyline = L.polyline(latlngs, {color: 'red'}).addTo(this.map);

            this.map.fitBounds(this.polyline.getBounds());

            var markerBeginningIcon = L.icon({
                iconUrl: "images/cyclist.png",
                iconSize: [32, 32]
            });

            this.markers.beginning = L.marker(latlngs[0], {
                icon: markerBeginningIcon
            }).addTo(this.map);

            var markerEndIcon = L.icon({
                iconUrl: "images/marker.png",
                iconSize: [32, 32]
            });

            this.markers.end = L.marker(latlngs[latlngs.length-1], {
                icon: markerEndIcon
            }).addTo(this.map);

            // var markerIcon = L.icon({
            //     iconUrl: "images/marker.png",
            //     iconSize: [32, 32]
            // });
            // this.marker = L.marker([32.533, -117.05], {
            //     icon: markerIcon
            // }).on('click', function (e) {
            //     self.map.setView(e.target.getLatLng(), 15)
            // }).addTo(this.map);
        },
        initMap() {
            this.map = L.map("currentRoute").setView([32.533, -117.05], 12);
            this.tileLayer = L.tileLayer(
                "https://cartodb-basemaps-{s}.global.ssl.fastly.net/rastertiles/voyager/{z}/{x}/{y}.png",
                {
                    maxZoom: 18,
                    attribution:
                        '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>, &copy; <a href="https://carto.com/attribution">CARTO</a>'
                }
            );
            this.tileLayer.addTo(this.map);
        },
    },
};
</script>
<style lang="css" scope>
.map {
    height: 450px;
}
.leaflet-popup-content {
    color: red;
}
.blink {
    animation: fade 1s infinite alternate;
}
@keyframes fade { 
    from { 
        opacity: 0.3;
    }
}
/* https://travishorn.com/interactive-maps-with-vue-leaflet-5430527353c8 */
</style>
