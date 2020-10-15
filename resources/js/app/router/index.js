import VueRouter from 'vue-router';
import Main from "../views/Main";
import NotFound from '../views/NotFound';

export default new VueRouter({
    routes : [
        {
            path: '/', component: Main, name: 'main'
        },
        {
            path: '*', component: NotFound, name: 'not-found', meta: {
                requestAuth: false
            }
        }
    ], mode : 'history'
});
