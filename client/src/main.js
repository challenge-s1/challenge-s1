import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import { createStore } from 'vuex'

// import './assets/main.css'
import "@fortawesome/fontawesome-free/css/all.min.css";
import "@/assets/styles/tailwind.css";

const store = createStore({
    state() {
        return {
            user: {}
        }
    },
    getters: {
        user(state) {
            // state variable contains our state data
            return state.user;
        },
        isLoggedIn(state) {
            return Object.keys(state.user).length != 0 && state.user.hasOwnProperty('token');
        },
        isPastrieOwner(state) {
            return Object.keys(state.user).length != 0 && state.user.hasOwnProperty('token') && state.user.roles[0] == 'ROLE_PATISSIER';
        },
        isAdmin(state) {
            return Object.keys(state.user).length != 0 && state.user.hasOwnProperty('token') &&  state.user.roles[0] == 'ROLE_ADMIN';
        },
        // isTokenExpired(state) {
        //     return Object.keys(state.user).length != 0 && state.user.hasOwnProperty('token') && store.state.user.token.exp < Date.now() / 1000;
        // },
        /*isAdmin(state) {
            return Object.keys(state.user).length != 0 && state.user.hasOwnProperty('token') && state.user.roles == 'ROLE_ADMIN';
        }*/
    },
    mutations: {
        addToken(state, token) {
            state.user.token = token;
        },
        addId(state, id) {
            state.user.id = id;
        },
        addRoles(state, roles) {
            state.user.roles = roles;
        },
        addfirstname(state, firstname) {
            state.user.firstname = firstname;
        },
        addlastname(state, lastname) {
            state.user.lastname = lastname;
        },


        /*addUser(state, newUser) {
            console.log(newUser);
            if (newUser.id !== undefined && typeof newUser.firstName == 'string' && typeof newUser.lastName == 'string') {
                state.user = {
                    id: newUser.id,
                    firstName: newUser.firstName,
                    lastName: newUser.lastName,
                    city: newUser.city,
                    postalCode: newUser.postalCode,
                    address: newUser.address,
                    country: newUser.country,
                    roles: newUser.roles,

                }
            } else {
                console.log('Invalid user');
            }
        },*/
        removeUser(state) {
            state.user = {};
        },
        loadStore() {
            if (localStorage.getItem('store')) {
                try {
                    this.replaceState(JSON.parse(localStorage.getItem('store')));
                }
                catch (e) {
                    console.log('Could not initialize store', e);
                }
            }
        }
    }
})
store.subscribe((mutation, state) => {
    localStorage.setItem('store', JSON.stringify(state));
});
const app = createApp(App)

app.use(router).use(store)

app.mount('#app')
