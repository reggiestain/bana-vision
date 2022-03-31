<template
  ><div class="spend">
    <div class="top-details row">
      <div class="col-8 info-image">
        <div class="image_info">
          <img
            src="https://raw.githubusercontent.com/NtsikeleloBana/imagesbox/ff552ae56cdbf38c399dfa84b7f994d941dbaebb/undraw_best_place_r685.svg"
            alt=""
            class="info_image"
          />
        </div>
      </div>
      <div class="col-4 info-details">
        <div
          class="
          stretch-card grid-margin"
        >
          <div class="card bg-gradient-danger card-img-holder text-white">
            <div class="card-body">
              <img
                src="https://raw.githubusercontent.com/NtsikeleloBana/imagesbox/main/circle.png"
                class="card-img-absolute"
                alt="circle-image"
              />
              <h4 class="font-weight-normal mb-3">
                Zlto Account<i
                  class="mdi mdi-chart-line mdi-24px float-right"
                ></i>
              </h4>
              <h2 class="mb-5">Z 532</h2>
              <h6 class="card-text">Current Balance: Z532</h6>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row shops">
      <div class="textd">
        <p>Spend</p>
      </div>
      <div class="fourpan">
        <a class="pan1  " v-on:click="show(1)">
          <div class="box">
            <img
              src="https://github.com/NtsikeleloBana/imagesbox/blob/main/shoprite.jpg?raw=true"
              alt=""
              class="bimg"
            />
          </div>
          <div class="pantext"><p>Shoprite</p></div>
        </a>

        <a class="pan2 " v-on:click="show(2)">
          <div class="box">
            <img
              src="https://github.com/NtsikeleloBana/imagesbox/blob/main/pep.jpeg?raw=true"
              alt=""
              class="bimg"
            />
          </div>
          <div class="pantext"><p>Pep</p></div>
        </a>
        <a class="pan3 " v-on:click="show(3)">
          <div class="box">
            <img
              src="https://github.com/NtsikeleloBana/imagesbox/blob/main/eskom.png?raw=true"
              alt=""
              class="bimg"
            />
          </div>
          <div class="pantext"><p>Electricity</p></div>
        </a>
        <a class="pan4 " v-on:click="show(4)">
          <div class="box">
            <img
              src="https://github.com/NtsikeleloBana/imagesbox/blob/main/upps-main-03.jpg?raw=true"
              alt=""
              class="bimg"
            />
          </div>
          <div class="pantext"><p>Airtime</p></div>
        </a>
      </div>

      <div class="row product-selector" v-if="store.isHidden">
        <div class="card_">
          <div class="left">
            <img
              :src="stores.image"
              alt="MTN"
              width="150"
              height="150"
              class="brand-img bg"
            />
          </div>
          <div class="right">
            <div class="product-info">
              <div class="product-name">
                <h1>{{ store.storename }}</h1>
              </div>
              <div class="details">
                <h3>Airtime R{{ store.storeproducts.value }}</h3>
                <h2>{{ store.storeproducts.Zlto_prod_name }}</h2>
                <h4>Zlto {{ store.storeproducts.zlto_amount }}</h4>
              </div>
              <b-button v-b-modal.confirm-modal class="foot "
                ><i class="fa fa-shopping-bag"></i>BUY
              </b-button>
            </div>
          </div>
        </div>

        <div class="proc-btn">
          <b-button v-b-modal.confirm-modal class="procs-btn">BUY</b-button>
        </div>
        <b-modal id="confirm-modal" centered title="Confirmation">
          <h4 class="my-4">{{ store.storename }}</h4>
          <p class="my-4">Z : {{ store.storeproducts.zlto_amount }}</p>
          <p class="my-4">{{ store.storeproducts.Zlto_prod_name }}</p>
          <p class="my-4">R : {{ store.storeproducts.value }}</p>
        </b-modal>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data: () => {
    return {
      store: { storename: "", storeproducts: "", isHidden: false },
      stores: [
        {
          id: 1,
          storename: "Shopright",
          image: "/assets/img/shoprite.jpg",
          storeproducts: {
            zlto_amount: "300",
            Zlto_prod_name: "Shprite Voucher",
            value: "100",
          },
        },
        {
          id: 2,
          storename: "Pep",
          image: "/assets/img/pep.jpeg",
          storeproducts: {
            zlto_amount: "300",
            Zlto_prod_name: "Pep Voucher",
            value: "100",
          },
        },
        {
          id: 3,
          storename: "Eskom",
          image: "/assets/img/eskom.png",
          storeproducts: {
            zlto_amount: "300",
            Zlto_prod_name: "Eskom Voucher",
            value: "100",
          },
        },
        {
          id: 4,
          storename: "Airtime",
          image:
            "https://seeklogo.com/images/M/mtn-group-management-services-logo-74A8373CB9-seeklogo.com.png",
          storeproducts: {
            zlto_amount: "100",
            Zlto_prod_name: "Airtime Voucher",
            value: "20",
          },
        },
        {
          id: 5,
          storename: "Aubrey Driving School",
          image: "/assets/img/zilato.png",
          storeproducts: {
            zlto_amount: "300",
            Zlto_prod_name: "Voucher",
            value: "100",
          },
        },
      ],
    };
  },
  methods: {
    show(x) {
      for (var i = 0; i <= this.stores.length; i++) {
        if (x == this.stores[i].id) {
          this.store.storename = this.stores[i].storename;
          this.store.storeproducts = this.stores[i].storeproducts;
          this.store.isHidden = !this.store.isHidden;
        }
      }
    },
  },
};
</script>

<style lang="scss" scoped>
@import "../../../../node_modules/@mdi/font/css/materialdesignicons.min.css";
@import "../../../../node_modules/flag-icon-css/css/flag-icon.min.css";
@import "../../../../node_modules/font-awesome/css/font-awesome.min.css";
@import "../../../../node_modules/simple-line-icons/css/simple-line-icons.css";
@import "../../../../node_modules/ti-icons/css/themify-icons.css";
@import "../../../../node_modules/sweetalert2/dist/sweetalert2.min.css";
@import "../../../../node_modules/vue-snotify/styles/material.css";
@import "../../../../node_modules/codemirror/lib/codemirror.css";
@import "../../../../node_modules/c3/c3.min.css";
@import "../../../../node_modules/chartist/dist/chartist.min.css";
@import "../../../assets/scss/style.scss";

@import url("https://fonts.googleapis.com/css?family=Muli");

h1 {
  color: #478ac9;

  font-weight: bold;
  font-size: 22px;
  margin-top: 21px;
  display: inline-block;
}

i.fa.fa-search {
  margin-left: 90px;
}

.product-name i {
  color: #666;
  transition: 0.3s all ease;
  margin: 0px 12px;
}

.product-name i:hover {
  color: #ff6d39;
  cursor: pointer;
}

h3 {
  color: #666;

  margin-top: 10px;
  font-size: 20px;
  font-weight: 500;
}

h2 {
  color: #666;
  margin-top: 10px;
  font-weight: 600;
  font-size: 29px;
}

h4 {
  display: inline-block;
  color: #666;

  margin-top: 10px;
  font-weight: bold;
  font-size: 20px;
}

h4.dis {
  display: inline-block;
  color: #666;

  font-weight: 400;
  font-size: 17px;
  margin-left: 30px;
  text-decoration: line-through #ea3201;
}

h4.dis span {
  text-decoration: line-through #ea3201;
}

.discount {
  display: inline-block;
}

ul {
  list-style-type: none;
}

li {
  display: inline-block;
  margin-right: 25px;
}

ul li {
  color: #666;

  margin-top: 20px;
  font-weight: 500;
  font-size: 11px;
}

.foot {
  color: #fff;

  margin-left: 160px;
  font-weight: 500;
  background: #07cdae;
  height: 47px;
  width: 110px;
  padding: 5px 10px;
  border-radius: 5px;
  font-size: 11px;
  float: left;
  transition: 0.3s all ease;
}

.foot i:nth-child(1) {
  margin-left: 0;
  margin-right: 15px;
}

.foot:hover {
  background: #07cdae;
  cursor: pointer;
}

.left i {
  color: #ffd5c6;
  margin-top: 260px;
  transition: 0.3s all ease;
}

.left i:hover {
  cursor: pointer;
  color: #2a2f40;
}
.card_ {
  border-radius: 5px;
  background: transparent;
  // margin: 0 auto;
  // box-shadow: 0px 15px 50px 10px rgba(0, 0, 0, 0.4);
  margin-top: 2%;
}

.left {
  content: "";
  height: 197px;
  width: 165px;
  display: flex;
  align-items: center;
  background-color: #478ac9;
  margin-left: 120px;
  border-radius: 0% 50% 50% 0%;
  position: absolute;
  z-index: 5;
}

.left img {
  margin-left: -130px;
  margin-top: 60px;
}

.right {
  content: "";
  height: 197px;
  width: 339px;
  background-color: #fff;
  z-index: 3;
  margin-left: 200px;
  padding-left: 100px;
}

.product-info {
  position: absolute;
  height: 394px;
  width: 305px;
  z-index: 10;
}

.product {
  width: 400px;
  height: 200px;
  background: #fff;
  padding: 20px;
  margin: 10px;
  border-radius: 6px;
}
.product_store {
  display: flex;
  text-align: center;
}
.product_amount {
  right: 0;
  bottom: 0;
  position: absolute;
}
.product_value {
  right: 0;
  bottom: 0;
  position: absolute;
}
.product_name {
  right: 0;
  bottom: 0;
  position: absolute;
}
.procs-btn {
  border-radius: 6px !important;
  background-color: #07cdae;
  font-weight: bold;
  color: #fff;
  right: 0;

  position: absolute;
  width: 70px;
  height: 47px;
  padding: 15px 8px;
  outline: none;
  border: 1px solid #07cdae;
}

.shops {
  display: flex;
  flex-direction: column;
}
.grid-margin {
  margin-top: 2.5rem;
}
.top-details {
  min-height: 400px;
}
.info_image {
  width: 450px;
  height: 370px;
}
.footer {
  display: flex;
  justify-content: space-between;
  padding: 10px;
  align-items: center;
  width: 100%;
}

.dot {
  display: inline-block;
  height: 10px;
  width: 10px;
  background-color: #fff;
  border-radius: 50%;
  box-shadow: 3px 3px 3px 3px rgba(0, 0, 0, 0.2);
  margin-left: 5px;
}

.activedot {
  background-color: #fd5211;
  box-shadow: 4px 4px 5px 5px rgba(0, 0, 0, 0.2);
}

.threedots {
  padding: 5px;
  margin-left: 40%;
  display: flex;
}
.fourpan {
  display: flex;
  align-items: center;
  margin-bottom: 10px;
}
.pan1,
.pan2,
.pan3,
.pan4 {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  flex-grow: 1;
  min-width: 80px;
  flex-grow: 1;
}
.textd {
  padding: 10px;
  font-weight: 300;
  font-size: 20px;
  align-items: center;
  justify-content: space-between;
}
.arrow-left i {
  font-size: 50px;
  color: #fd5211;
}

.box {
  height: 120px;
  display: flex;
  margin-right: 21px;
  width: 160px;
  background-color: #fff;
  border-radius: 6px;
  margin-top: 10px;
  // box-shadow: 12px 3px 18px 4px rgb(0 0 0 / 20%);
  justify-content: center;
  align-items: center;
}
.bimg {
  height: 80px;
  width: 120px;
  border-radius: 6px;
}

.spend {
  padding-bottom: 10px;
}
</style>
