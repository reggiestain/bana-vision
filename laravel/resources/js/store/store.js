import Vue from 'vue';
import Vuex from 'vuex';
import auth from './auth'
Vue.use(Vuex);

export const store = new Vuex.Store({
    modules: {
    auth
  },
    state: {
        user:{},
        zlto_user:{},
        count: 0,
        post:'',
        schools:{},
        needs:{},
        'needs-gratitude':{},
        'needs-overview':{},
        featured_student:{},
        student_project:{},
        student_award:{},
        events:{},
        followings:{},
        followers:{},
        followingsList:[],
        followersList:[],
        bursaries:{},
        comments:{},
        usable:{},
        schoolsList:[],
        needsList:[],
        eventsList:[],
        bursariesList:[],
        commentsList:[],
        feedList:[],
        school_activities:{},
        school_facilities:{},
        school_activitiesList:[],
        school_facilitiesList:[],
        featured_studentList:[],
        student_projectList:[],
        student_awardList:[],
        feed:{},
        search_results:{},
        search_resultsList:[],
        token:null,
        searchLoading:false,
        scroll:true,
        pic_post_id:0,
        profilepic:'',
        coverpic:'',
        currentComponent: 'register-1',
        registerParty:'School',
        resultsEmpty:true,
        current_component:'home',
        current_post_component:'',
        form_data:{},
    },
      getters:{
   getPosts:(state)=>(payload) => {
    console.log(state[payload.property_name] );
    if (typeof state[payload.property_name] === 'undefined') {
            //Vue.set(state, payload, false);
            //Vue.set(state[payload.property_name],payload.property_id,payload.property_values);
            Vue.set(state[payload.property_name],'user_id','payload.property_values');
        }
       return state[payload.property_name];
      //return id => state.events.find(element => element.id === id);
     /*  return id => state.collection.find((element) => {
        console.log("FOUND", element)
        return element.id === id
      }); */
    },
     user (state) {
      return state.user
    },
    zlto_user (state) {
      return state.zlto_user
    },
     usable (state) {
      return state.usable
    },
    needs_overview (state) {
      return state['needs-overview']
    },
    results_empty(state){
        return state.resultsEmpty
    }
  },
 /* getters: {
    events (state) {
      return state.events.user_id
    },

    user (state) {
      return state.user
    },
  },*/
    mutations: 
    {
        //property name is ths state name youre trying to change
        //values are the values youre trying to set to the property
        set(state,payload)
        {
            state[payload.property_name] = payload.property_values ;
        },
        increment (state,payload )
        {
    		/*//state[payload.property_name].push(payload.property_values) ;
           //check if state property is nested or not
            //var state_ = (payload.hasOwnProperty('property_sub_name'))?state[payload.property_name][payload.property_sub_name]:state[payload.property_name];
            if(Array.isArray(payload.property_values))
            {*/
                 
                //state[payload.property_name].push(payload.property_values);
                Vue.set(state[payload.property_name],payload.property_id,payload.property_values);
           /*     //state[payload.property_name][payload.property_sub_name].push(payload.property_values);
            }
            else
            {
               Vue.set(state[payload.property_name],payload.property_id,payload.property_values);
            }*/
  		},
        pushList(state,payload)
        {
            state[payload.property_name].push(payload.property_values);
        },
        changePosts (state,n)
        {
            state.posts = Array.from(n);
        },
        decrement: state => state.count--,
    }
})