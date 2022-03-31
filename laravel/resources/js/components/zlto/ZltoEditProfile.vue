<template>
  <div class="Edit-profile">
    <link
      href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css"
      rel="stylesheet"
    />
    <div class="container rounded bg-white mt-5 mb-5">
      <div class="row">
        <div class="col-md-8 border-right">
          <div class="p-3 py-5">
            <div class="d-flex justify-content-between align-items-center mb-3">
              <h6 class="text-right">Edit your profile</h6>
            </div>
            <div class="row mt-2">
              <div class="col-md-6">
                <label class="labels">Name</label
                ><input
                  type="text"
                  class="form-control"
                  placeholder="first name"
                  value="Name"
                />
              </div>
              <div class="col-md-6">
                <label class="labels">Surname</label
                ><input
                  type="text"
                  class="form-control"
                  value="Surname"
                  placeholder="Surname"
                />
              </div>
            </div>
            <div class="row mt-2">
              <div class="col-md-6">
                <label class="labels">Date of Birth</label
                ><input type="date" class="form-control" />
              </div>
              <div class="col-md-6">
                <label class="labels">Gender</label
                ><select name="gender" id="gender">
                  <option value="male">Male</option>
                  <option value="female">Female</option>
                  <option value="other">Other</option>
                  <option value="Prefer">Prefer not to say</option>
                </select>
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-md-12">
                <label class="labels">Bio</label
                ><input
                  type="text"
                  class="form-control"
                  placeholder="Biography"
                  value="Biography"
                />
              </div>
              <div class="col-md-4 margin-top">
                <label class="labels">Code</label
                ><select name="countrycode" id="countrycode">
                  <option value="+27">+27</option>
                  <option value="+44">+44</option>
                  <option value="+237">+237</option>
                  <option value="+255">+255</option>
                </select>
              </div>
              <div class="col-md-8">
                <label class="labels">Phone Number </label
                ><input
                  type="tel"
                  class="form-control"
                  placeholder="063 444 4444"
                  value=""
                />
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-md-6">
                <label class="labels">Country</label
                ><input
                  type="text"
                  class="form-control"
                  placeholder="country"
                  value="South Africa"
                />
              </div>
              <div class="col-md-6">
                <label class="labels">City</label
                ><input
                  type="text"
                  class="form-control"
                  value="Johannesburg"
                  placeholder="Johannesburg"
                />
              </div>
            </div>
            <div class="mt-5 text-center">
              <button class="btn btn-primary profile-button" type="button">
                Update Profile
              </button>
            </div>
          </div>
        </div>
        <div class="col-md-4 ">
          <div class="p-3 py-5">
            <div
              class="d-flex justify-content-between align-items-center experience"
            >
              <span>Verify Account</span>
            </div>
            <div class="d-flex flex-row mt-3 exp-container">
              <img
                src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT0Q_RiUXj3WIyBcoDfqm0gdotM-mi4dkrdUQ&usqp=CAU"
                width="45"
                height="45"
              />
              <div class="work-experience ml-1">
                <span class="font-weight-bold d-block">Email Verification</span
                ><span class="d-block text-black-50 labels"
                  >Mthokozi12@gmail.com&nbsp;&nbsp;<i
                    class="bx bxs-badge-check"
                    style="color:#57ab28"
                  ></i></span
                ><span class="d-block text-black-50 labels">May 2021</span>
              </div>
            </div>
            <hr />
            <div class="d-flex flex-row mt-3 exp-container">
              <img
                src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT0Q_RiUXj3WIyBcoDfqm0gdotM-mi4dkrdUQ&usqp=CAU"
                width="45"
                height="45"
              />
              <div class="work-experience ml-1">
                <span class="font-weight-bold d-block">Phone number</span
                ><span class="d-block text-black-50 labels"
                  >063 444 4444 &nbsp;&nbsp;
                  <i class="bx bxs-badge-check" style="color:#57ab28"></i></span
                ><span class="d-block text-black-50 labels">June 2021</span>
              </div>
            </div>
            <hr />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {};
</script>

<style scoped>
.margin-top {
  margin-top: 2rem;
}
.form-control:focus {
  box-shadow: none;
  border-color: #478ac9;
}

.profile-button {
  background: #478ac9;
  box-shadow: none;
  border: none;
}

.profile-button:hover {
  background: #478ac9;
}

.profile-button:focus {
  background: #478ac9;
  box-shadow: none;
}

.profile-button:active {
  background: #478ac9;
  box-shadow: none;
}

.back:hover {
  color: #478ac9;
  cursor: pointer;
}

.labels {
  font-size: 11px;
}
</style>
