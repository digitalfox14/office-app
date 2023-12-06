import axios from "axios";

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
            window.location.reload();
            store.commit(resp.data);
        }).catch((err) =>{
            console.log(err)
        });
    },
    getAttLog (store) {
        axios.get('/user/get-att').then((resp) => {
            store.commit('SET_ATTlOG', resp.data);
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
            window.location.reload();
        }).catch((err) =>{
            console.log(err)
        });
    }
}