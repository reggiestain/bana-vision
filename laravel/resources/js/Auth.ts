export class Auth{
  constructor(auth) {
    this.auth = auth;
  }

  /***************************************************
  * check if auth user is owner of post
  ****************************************************
  *
  *
  */
  auth_owner_of_post(authenticated_user,post_user)
  {
    var truth_value = false;
    if(authenticated_user !== null && post_user !== null)
    truth_value = (authenticated_user._id == post_user._id)?true:false;
    return truth_value;
  }

  /*************************************************
  * check if user is of a certain type
  *************************************************
  *
  *
  * types_array an array of the acceptable values
  */
  user_is_of_type(user_type,types_array)
  {
    return types_array.includes(user_type);
  }
}