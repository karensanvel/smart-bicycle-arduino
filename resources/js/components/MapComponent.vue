<template>
    <div class="map" id="map"></div>
</template>
<script>
import L from "leaflet";
import axios from 'axios';

export default {
    name: "MapComponent",
    data() {
        return {
            map: null,
            tileLayer: null,
            marker: null,
            layer: {
                id: 0,
                name: "Route traveled",
                active: false,
                pointList: []
            }
        };
    },
    mounted() {
        this.initMap();
        this.initLayer();

        setTimeout(() => {
            this.activateAlarm();
        }, 1000)
    },
    methods: {
        initLayer() {
            var self = this;

            var markerIcon = L.icon({
                iconUrl: "images/marker.png",
                iconSize: [32, 32]
            });
            this.marker = L.marker([32.533, -117.05], {
                icon: markerIcon
            }).on('click', function (e) {
                self.map.setView(e.target.getLatLng(), 15)
            }).addTo(this.map);
        },
        initMap() {
            this.map = L.map("map").setView([32.533, -117.05], 12);
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
        activateAlarm() {
            axios.get('api/getLastData/').then((res => {
                var self = this;
                if (res.data.datos[0].alarm === "1") {
                    this.map.removeLayer(this.marker);
        
                    var markerIcon = L.icon({
                        iconUrl: "images/sos.png",
                        iconSize: [60, 60],
                        className: 'blink'
                    });
                    this.marker = L.marker([32.533, -117.05], {
                        icon: markerIcon
                    }).on('click', function (e) {
                        self.map.setView(e.target.getLatLng(), 16)
                    }).addTo(this.map).bindPopup(
                        'El usuario ha activado la alarma.'
                    ).openPopup();
                } else {
                    var markerIcon = L.icon({
                        iconUrl: "images/marker.png",
                        iconSize: [32, 32]
                    });
                    this.marker = L.marker([32.533, -117.05], {
                        icon: markerIcon
                    }).on('click', function (e) {
                        self.map.setView(e.target.getLatLng(), 16)
                    }).addTo(this.map);
                }
            }))
        }
    }
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
