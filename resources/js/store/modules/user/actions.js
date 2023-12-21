import axios from "axios";
import { Value } from "sass";

export default {
    logoutUser (store) {
        axios.post('/user/logout', {}).then((respones) => {
            window.location.reload();
        }).catch((err) => {
            console.log(err)
        });
    },

    getUser (store) {
        axios.get('/user/refresh').then((resp) => {
            store.commit('SET_USER', resp.data);
        }).catch((err) => {
            console.log(err);
        });
    },
    punchIn (store) {
        axios.post('/user/punch-in').then((resp) => {
            store.commit('SET_PUNCH', resp.data);
            store.dispatch('getAttendanceLog');
        }).catch((err) =>{
            console.log(err)
        });
    },
    getAttendanceLog (store) {
        axios.get('/user/get-attendance').then((resp) => {
            store.commit('SET_ATTENDANCE', resp.data);
        }).catch((err) =>{
            console.log(err)
        });
    },
    punch (store) {
        axios.get('/user/punch-log').then((resp) => {
            store.commit('SET_PUNCH', resp.data);
        }).catch((err) => {
            console.log(err)
        });
    },
    punchOut (store, $id) {
        axios.post('/user/punch-out/' +$id).then((resp) => {
            store.commit('SET_PUNCH', resp.data);
            store.dispatch('getAttendanceLog');
        }).catch((err) =>{
            console.log(err)
        });
    },
    getUserAttendance (store, params) {
        axios.get('/user/get-user-attendance', { params }).then((resp) => {
            store.commit('SET_USER_ATTENDANCE', resp.data);
        }).catch((err) => {
            console.log(err)
        });
    },

    // filterAttendance(store, params) {
    //     axios.get('/user/filter-attendance', { params }).then((resp) => {
    //         console.log(resp.data);
    //         store.commit('SET_USER_ATTENDANCE', resp.data);
    //     }).catch((err) => {
    //         console.log(err)
    //     });
    // }
}