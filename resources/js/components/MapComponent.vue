<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="map" id="map"></div>
            </div>
        </div>
    </div>
</template>
<script>
import L from "leaflet";

export default {
    name: "MapComponent",
    data() {
        return {
            map: null,
            tileLayer: null,
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
    },
    methods: {
        initLayer() {
            var p = new L.LatLng(44.4294834, 26.1002004);
            this.layer.pointList.push(p);
            var p = new L.LatLng(44.4296068, 26.0988593);
            this.layer.pointList.push(p);

            var routepolyline = new L.Polyline(this.layer.pointList, {
                color: "blue",
                weight: 5,
                opacity: 0.5,
                smoothFactor: 1
            }).addTo(this.map);

            if (this.layer.pointList.length > 0) {
                this.map.setView(this.layer.pointList[0], 11, {
                    animation: true
                });
            }

            // var sec = 0;
            // var bicycleIcon = L.icon({
            //     iconUrl:
            //         "https://image.flaticon.com/icons/png/512/1183/1183088.png",
            //     iconSize: [32, 32]
            // });
            // var bicycle = L.marker([44.4294834, 26.1002004], {
            //     icon: bicycleIcon
            // }).addTo(this.map);

            // var self = this;
            // var timer = setInterval(function() {
            //     if (sec < self.layer.pointList.length - 1) {
            //         sec++;
            //         self.map.setView(self.layer.pointList[sec], 11, {
            //             animation: true
            //         });
            //         bicycle.setLatLng(self.layer.pointList[sec]);
            //     }
            // }, 300);
        },
        initMap() {
            this.map = L.map("map").setView([38.63, -90.23], 12);
            this.tileLayer = L.tileLayer(
                "https://cartodb-basemaps-{s}.global.ssl.fastly.net/rastertiles/voyager/{z}/{x}/{y}.png",
                {
                    maxZoom: 18,
                    attribution:
                        '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>, &copy; <a href="https://carto.com/attribution">CARTO</a>'
                }
            );
            this.tileLayer.addTo(this.map);
        }
    }
};
</script>
<style lang="css" scope>
.map {
    height: 450px;
}
/* https://travishorn.com/interactive-maps-with-vue-leaflet-5430527353c8 */
</style>
