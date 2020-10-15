import Vue from 'vue';
import Vuex from 'vuex';
import gp_array from "./arrays/gp_array";
import osb_array from "./arrays/osb_array";
import peny_array from "./arrays/peny_array";
import shtraf_array from "./arrays/shtraf_array";
import count_error_array from "./arrays/count_error_array";

Vue.use(Vuex);

export default new Vuex.Store(
    {
        modules: {
            gp_array,
            osb_array,
            peny_array,
            shtraf_array,
            count_error_array
        }
    });
