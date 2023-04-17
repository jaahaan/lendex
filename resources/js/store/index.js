import Vue from 'vue'

import Vuex from 'vuex'
Vue.use(Vuex)
const store = new Vuex.Store({
  state: {
    counter:100,
    allNotiFalg:0,
    oneNotiFalg:0,
    newOrdersCount:0,
    authUser: window.authUser,
    load:false,
    notifications:[],
    allStores:[],
    allAccounts:[],
    sidebar:[],
    inVoiceItem:{},
    companyInfo:{},
    inVoiceModal:false,
    headerName:'DreamGallery',

    ////////////////////////////////
    currencyList:[
        {"cc":"BDT","symbol":"৳","name":"Bangladeshi taka"},
        {"cc":"EUR","symbol":"€","name":"European Euro"},
        {"cc":"GBP","symbol":"£","name":"British pound"},
        {"cc":"INR","symbol":"₹","name":"Indian rupee"},
        {"cc":"USD","symbol":"$","name":"United States dollar"},
    ]
  },

  /*All getters*/
  getters: {
    currencyList(state){
      return state.currencyList;
    },
    getCompanyInfo(state){
      return state.companyInfo;
    },
    getAllStores(state){
      return state.allStores;
    },
    authStores(state){
        if(state.authUser.store_id == 0){
            console.log(state.allStores)
            return state.allStores;
        }
        let stores = [];
        for(let d of state.allStores) {
            if(d.id == state.authUser.store_id ){
                stores.push(d);
            }
        }
        return stores
    },
    getAllAccounts(state){
      return state.allAccounts;
    },
    getSideBar(state){
      return state.sidebar;
    },
    allNotiFalg(state){
      return state.allNotiFalg;
    },
    newOrdersCount(state){
      return state.newOrdersCount;
    },
    oneNotiFalg(state){
      return state.oneNotiFalg;
    },
    getCounter(state){
      return state.counter
    },
    getHeader(state){
      return state.headerName
    },
    isLoggedIn(state){
      if(_.isEmpty(state.authUser)){
        return false
      }else{
        return true
      }

    },
    loggedInUser(state){
      return state.authUser
    },
    load(state){
      return state.load
    },
    noti(state){
      return state.notifications
    },
    getinVoiceItem(state){
      return state.inVoiceItem
    },
    getinVoiceModal(state){
      return state.inVoiceModal
    },
  },

  /*all mutations*/
  mutations: {
    allNotiFalg (state,data) {
       state.allNotiFalg = data;
    },
    newOrdersCount (state,data) {
       state.newOrdersCount = data;
    },
    setAllStores (state,data) {
       state.allStores = data;
    },
    setAllAccounts (state,data) {
       state.allAccounts = data;
    },
    setSideBar(state,data) {
       state.sidebar = data;
    },
    setCompanyInfo (state,data) {
       state.companyInfo = data;
    },

    oneNotiFalg (state,data) {
       state.oneNotiFalg = data;
    },
    update (state,data) {
       state.counter++
    },
    user(state,user){
      state.authUser=user
    },
    updateHeader(state,data){
      state.headerName=data
    },
    setinVoiceItem(state,data){
        state.inVoiceItem =data
    },
    setinVoiceModal(state,data){
       state.inVoiceModal=data
    },

  },

 /*all actions*/
  actions: {
    update ({commit},data) {
     commit('update',data)
    },
    user({commit},user){
      commit('user',user)
    },
    updateHeader({commit},data){
      commit('updateHeader',data)
    },
    setinVoiceItem({commit},data){
      commit('setinVoiceItem',data)
    },
    setinVoiceModal({commit},data){
      commit('setinVoiceModal',data)
    },
  }
})

export default store
