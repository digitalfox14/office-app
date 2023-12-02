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
    userAttendance (store) {
        axios.post('/user/attendance').then((resp) => {
            store.commit(resp.data);
        }).catch((err) =>{
            console.log(err)
        });
    },
    getAttLog (store) {
        axios.get('/user/createAttLog').then((resp) => {
            store.commit('SET_ATTlOG', resp.data);
        }).catch((err) =>{
            console.log(err)
        });
    }
}