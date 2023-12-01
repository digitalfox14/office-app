import { createStore } from 'vuex'


import userModule from '@/store/modules/user'


const store = createStore({
    modules: {
        userModule,
    }
});

export default store;