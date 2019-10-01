<template>
  <div class="container">
    <p v-if="errReverse == true">{{errRequired}}</p>

    <p v-if="isReverse == true">{{message}}</p>
<div v-if="isReverse == false">
    <div class="row">
      <div class="col-sm-6 col-12">
        <label for="name">Имя</label>

    <input id="name" type="text" class="form-control" name = "name" v-model="name">

      </div>
      <div class="col-sm-6 col-12">
        <label for="text">Номер телефона</label>
      <input type="text" class="form-control" ref="field" v-model="tel">
    </div>
    </div>
    <hr>
    <div v-for="(order, index) in orders">
      <div class="row">
        <div class="col-5">
          <p >{{order.title}}</p>
        </div>
        <div class="col-3">
          <input type="number" class="form-control" name = "quantity" v-model="order.quantity">
        </div>
        <div class="col-2">
          <p class="float-right">{{sum(index, order.price, order.quantity)}} р</p>
        </div>
        <div class="col-2">
          <button class="btn float-right" v-on:click="orders.splice(order, 1)"><i class="fas fa-trash"></i></button></p>
        </div>
      </div>
      <hr>
    </div>
    <div class="row">
      <div class="col-8">
        <p class="font-weight-bold">Итого:</p>
      </div>
      <div class="col-2">
        <p class="float-right font-weight-bold">{{total}} р</p>
     </div>
     <div class="col-2">
    </div>
    </div>

    <button v-on:click="add" class="btn btn-block btn-secondary">Заказать</button>
  </div>

  </div>
</template>

<script>
// Validator.localize('ru', ru);
// Vue.use(VeeValidate, {
//   locale: 'ru',
// });
import Inputmask from 'inputmask';

export default {
  props: {
  mask: { type: String }
},
  data: function() {
    return {
      orders: [],
      name: null,
      tel: null,
      totalSum: 0,
    message: "Ваш заказ принят. Спасибо, что выбрали нас",
    isReverse: false,
    errRequired: 'Имя и телефон обязательны для заполнения',
    errReverse: false,
    error: []
    };
  },
  mounted() {
    var im = new Inputmask("+375 (99) 999-99-99");
  im.mask(this.$refs.field);
    this.json();
  },
  computed: {
    sum: function() {
      return function(index, price, quantity) {
        return  this.orders[index].sum = quantity*price
      }
    },
    total: function(){
      if(this.orders != null) {
      let sum = this.totalSum;
      return this.orders.reduce((sum, item) => sum + item.sum, 0);
    }
}
  },
  methods: {
    json: function() {
      axios.get('basket/create').
      then((response) => {
        this.orders = response.data.orders
      });
    },
    add: function() {
      console.log(this.orders)
      console.log(this.name)
      console.log(this.tel)
if(this.name == null || this.tel == null) {
    this.errReverse = true
}
else {
  axios({
    method: 'post',
    url: 'basket/order',
    params: {orders: this.orders, name: this.name, tel: this.tel}
  }).then((response) => {
    this.orders = [],
      this.isReverse = true
  })
    .catch(error => {
    console.log(error);
    this.errored = true;
  })
  .finally(() => (
    this.orders = [],
    this.isReverse = true,
    this.errReverse = false
  ));
}

    },
  }

}
</script>
