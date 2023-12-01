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
    }
}