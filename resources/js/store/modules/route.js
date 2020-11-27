/** VUEX module for route management */

export default {
  namespaced: true,
  state: {
    // initial state
    lastRoute: null,
    currentRoute: null,
  },
  getters: {
    // getters
    lastRoute: state => {
      return state.lastRoute;
    },
    currentRoute: state => {
      return state.currentRoute;
    },
  },
  mutations: {
    // mutations
    SET_LAST_ROUTE: (state, route) => {
      state.lastRoute= route;
    },
    SET_CURRENT_ROUTE: (state, route) => {
      state.currentRoute= route;
    },
  },
  actions: {
    // actions
    SET_LAST_ROUTE: ({ commit }, route) => {
      var hms = route.time;   // your input string
      var a = hms.split(':'); // split it at the colons
      // minutes are worth 60 seconds. Hours are worth 60 minutes.
      var seconds = (+a[0]) * 60 * 60 + (+a[1]) * 60 + (+a[2]);
      route.hours = seconds / 3600;

      let latlngs = route.coordenadas ? route.coordenadas : [];
      if (latlngs.length > 0) {
        let lat1 = latlngs[0].latitud;
        let lon1 = latlngs[0].longitud;
        let lat2 = latlngs[latlngs.length-1].latitud;
        let lon2 = latlngs[latlngs.length-1].longitud;
        route.kilometresTraveled = calcCrow(lat1, lon1, lat2, lon2).toFixed(1);
      }

      commit('SET_LAST_ROUTE', route);
    },
    SET_CURRENT_ROUTE: ({ commit }, route) => {
      var hms = route.time;   // your input string
      var a = hms.split(':'); // split it at the colons
      // minutes are worth 60 seconds. Hours are worth 60 minutes.
      var seconds = (+a[0]) * 60 * 60 + (+a[1]) * 60 + (+a[2]);
      route.hours = seconds / 3600;

      let latlngs = route.coordenadas ? route.coordenadas : [];
      if (latlngs.length > 0) {
        let lat1 = latlngs[0].latitud;
        let lon1 = latlngs[0].longitud;
        let lat2 = latlngs[latlngs.length-1].latitud;
        let lon2 = latlngs[latlngs.length-1].longitud;
        route.kilometresTraveled = calcCrow(lat1, lon1, lat2, lon2).toFixed(1);
      }

      commit('SET_CURRENT_ROUTE', route);
    },
  },
};

//This function takes in latitude and longitude of two location and returns the distance between them as the crow flies (in km)
function calcCrow(lat1, lon1, lat2, lon2) {
    var R = 6371; // km
    var dLat = toRad(lat2-lat1);
    var dLon = toRad(lon2-lon1);
    var lat1 = toRad(lat1);
    var lat2 = toRad(lat2);

    var a = Math.sin(dLat/2) * Math.sin(dLat/2) +
      Math.sin(dLon/2) * Math.sin(dLon/2) * Math.cos(lat1) * Math.cos(lat2); 
    var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
    var d = R * c;
    return d;
  }

  // Converts numeric degrees to radians
  function toRad(Value) {
    return Value * Math.PI / 180;
  }