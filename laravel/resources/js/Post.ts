
import { normalize, schema } from 'normalizr';
export class Post{
  constructor(post) {

  }

  /*****************************************************************************
  * GET POSTS
  ******************************************************************************
  * @param  that => object calling this method
  * @param  url => url to fetch 
  * @param  post_number
  * @param  post_id => id of post updated
  * @param  return_val => type of post to update on store e.g events/comments/bursaries
  * @return [type]
  */
  get(that,url , post_number,post_id,return_val = null)
  {
    //fetch needs when page is loaded
    axios.get(url)
    .then(function (response) {
    	var data = response.data;

        //store fetched posts on vuex
        if(Array.isArray(data['posts'+post_number]))
        {
          data['posts'+post_number].forEach(function(post){
              that.$store.commit('increment',{property_name:return_val,property_values:post,property_id:post._id});
              that.$store.commit('pushList',{property_name:return_val+'List',property_values:post._id});
          });
    	 }
    	else
    	{
    		that.$store.commit('set',{property_name:return_val,property_values:data['posts'+post_number]});
    	}

        that.$store.commit('set',{property_name:'searchLoading',property_values:false});
        that.user = data.user;
    })
    .catch(function (error) {
      console.error();
        //show error alert
        /*that.$swal({
            text: 'An error has occured',
            icon: "error",
            buttons:false,
            timer: 3000,
        });

        /*var errors_ = error.response.data.errors;
        //iterate errors and display on appropriate input field
        Object.keys(errors_).forEach(function(err){
            errors_[err].forEach(function(msg){
                        that[err]= null;
                            that.errors[err] = msg;
           });
        });
        that.output = error;*/
    });
    //the page loaded with some posts
    if (Array.isArray(this.post) && this.post.length) {
      //remove empty results message
      this.$store.commit('setResultsEmpty',false);
    }
    return this;
  }

  /*****************************************************************************
  * MAKE POSTS
  ******************************************************************************
  * @param  that => object calling this method
  * @param  url => url to fetch 
  * @param  post_number
  * @param  post_id => id of post updated
  * @param  return_val => type of post to update on store e.g events/comments/bursaries
  * @return [type]
  */
  post(that,url,success_func,failure_func=()=>console.log("failure"))
  {
    /*console.log("this is this ");
    console.log(that);
    console.log("route info");
    console.log(that.$router);
if(success_func instanceof Function)
                  {
                    
                    success_func();
                  }*/
    var formObj = new FormData();

    //merge formdata from store with makepost component one
    Object.entries(that.$store.state.form_data).forEach(([key, value]) => {
      //check if the value is an array e.g array of images then append the values of the array 1 by 1 to formdata
       if(Array.isArray(value))
       {
          for (let i=0; i<value.length; i++)
          {
            formObj.append(key,value[i]);
          }
       }
       else
          formObj.append(key,value);          
    });
    
    that.$swal({
                text: "Adding Post",
                icon:that.image_url,
                buttons: false,
            });

     axios.post(url,formObj)
            .then(function (response) {
               that.$swal({
                    text: 'post added',
                    type: "success",
                    showConfirmButton:false,
                    timer: 3000,
                }).then((value)=>{
                  if(success_func instanceof Function)
                  {

                    success_func();
                  }
                });
                  that.$store.commit('increment',response.data[1]);
                  
            })
            .catch(function (error) {
                if( error.response )
                {
                  var errors = error.response.data.errors; // => the response payload 
                  var error_string = '';
                    Object.entries(errors).forEach(([key, value]) => {
                        value.forEach(function(errormsg){
                            that.errors_array.push(errormsg);
                            error_string = error_string + '\n ' + errormsg;
                        });
                    });

                    that.$swal({
                        text: error_string,
                        icon:that.image_url,
                 
                   
                    });

                }
            })
            .finally(function(){
               //reset the forms
                that.postType='';
                that.video='';
                that.image='';
                that.post='';
                that.needDueDate='';
                that.needUrgency='';
                that.needCategory='';
                that.needQuantity='';
                that.needTitle='';
                that.bursaryRequirement='';
                that.bursaryRequirements=[];
                that.bursaryPositionsAvailable=0;
                that.bursarySector='';
                that.bursaryApplicationLink='';
                that.bursaryClosingDate='';
                that.bursaryTitle='';
                that.eventTimeslotFrom='';
                that.eventTimeslotTo='';
                that.eventVenue='';
                that.eventDate='';
                that.eventName='';
                that.imageData = [];
            });
  }

   /*****************************************************************************
  * EDIT POSTS
  ******************************************************************************
  * @param  that => object calling this method
  * @param  url => url to fetch 
  * @param  post_number
  * @param  post_id => id of post updated
  * @param  return_val => type of post to update on store e.g events/comments/bursaries
  * @return [type]
  */
  edit()
  {
  	//
  }

   /*****************************************************************************
  * DELETE POSTS
  ******************************************************************************
  * @param  that => object calling this method
  * @param  url => url to fetch 
  * @param  post_number
  * @param  post_id => id of post updated
  * @param  return_val => type of post to update on store e.g events/comments/bursaries
  * @return [type]
  */
  delete(that,post_id,user_slug,delete_route)
  {
  	that.$swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) //user proceeded with delete
        {
          var link;
          if (user_slug == null) //link doesnt explictly state user slug
          {
            link = '../'+delete_route+'/'+post_id;
          } 
          else 
          {
            link = '../'+user_slug+'/'+delete_route+'/'+post_id;
          }

          //delete the post
          axios.get(link)
          .then(response => {
            //show success alert
            swal("post successfully deleted!", {
              icon: "success",
              buttons:false,
              timer: 3000,
            });

            //delete post from the view
            that.groupPosts.forEach(function(post,index){
              if (post.id == post_id)
              {
                that.groupPosts.splice(index,1);
              }
            });

          })
          .catch(function(error) 
          {
            //show error alert
                swal({
                      text: 'An error has occured',
                      icon: "error",
                      buttons:false,
                      timer: 3000,
                  });
          });

        } 
        else //user cancelled the delete
        {
          swal("Cancelled by user post not deleted!",{
            buttons:false,
            timer: 3000,
          });
        }
      });
  }

  /**********************************************************************
  * SET POST
  ***********************************************************************
  *
  *
  *
  */
  setPost()
  {
     //set all the values on the vue component data attribute using an array of callbacks from the backend
        Object.keys(data.callbacks).forEach(function(callback){
          that.$store.commit('set',data.callbacks[callback] ,callback);
      that.$data[callback] = data.callbacks[callback];
      });
  }


  chunk_posts(must_chunk)
  {
    var that = this; 
    var entries = Object.entries(this.$store.state[that.$route.name]);
    //check if already has post if nod add on the loop
    for (const [_id, post] of entries) 
    {
      if(!that.groupPosts.hasOwnProperty(_id))
      {
        Object.assign(that.groupPosts, { [_id] : post});

      }
    }

    var results;
    const chunksize = 3;
    const array_from_object = Object.values(this.groupPosts);
    //return chunk array or updated object
    results =(must_chunk)?_.chunk(array_from_object,chunksize):this.groupPosts;

    return results;
  }

  /**********************************************************************
  * SET RESPONSE DATA
  ***********************************************************************
  * update values in the store with values retrieved from the database
  *
  *
  */
    update_response_data()
    {

    }

  /**********************************************************************
  * SET RESPONSE DATA
  ***********************************************************************
  * update values in the store with values retrieved from the form inputs
  *
  * value : search query
  * target : the 
  */
  update_value(that,value,target)
          {
            //that[target] = value;
            let val = value;
           if (that.$store.state.form_data.hasOwnProperty([target]))
           { 
             let bj = value;
             console.log('target : ');
              /*console.log(bj);
             console.log('store target : ');
              console.log(that.$store.state.form_data[target]);*/
             
              val =  Object.assign({},that.$store.state.form_data[target],value);
              //console.log("combined val :")
              //console.log(val);
            }
            var obj = Object.assign(that.$store.state.form_data,{[target]:val,});
            that.$store.commit('set',{property_name:'form_data',property_values:obj});
          }

}