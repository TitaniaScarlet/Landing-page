<template>
  <div class="container">
    <p v-if="isReverse == true">{{message}}</p>
<div v-if="isReverse == false">
    <div class="row">
      <div class="col-6">
        <label for="name">Имя</label>
        <input id="name" type="text" class="form-control" name = "name" v-model="name" >
      </div>
      <div class="col-2">
        <label for="code">Код</label>
        <input id="code" type="text" class="form-control" name="code" v-model="code" maxlength="2" required>
      </div>
      <div class="col-4">
        <label for="tel">Номер телефона</label>
        <input id="tel" type="text" class="form-control" name="tel" v-model="tel" maxlength="7" required>
      </div>
    </div>
    <hr>
    <div v-for="(order, index) in orders">
      <div class="row">
        <div class="col-6">
          <h6>{{order.title}}</h6>
        </div>
        <div class="col-2">
          <input type="text" class="form-control" name = "quantity" v-model="order.quantity">
        </div>
        <div col-4>
          <h6>{{sum(index, order.price, order.quantity)}} р</h6>
        </div>
        <div class="col-2">
          <button v-on:click="orders.splice(order, 1)"><i class="fas fa-trash"></i></button></p>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-8">
        <p>Итого:</p>
      </div>
      <div class="col-4">
        <p>{{total}} р</p>
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
export default {
  data: function() {
    return {
      orders: [],
      name: '',
      tel: '',
      code: '',
      totalSum: 0,
    message: "Ваш заказ принят. Спасибо, что выбрали нас",
    isReverse: false,
    errors: [],
    };
  },
  mounted() {
    this.json()
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

      axios({
        method: 'post',
        url: 'basket/order',
        params: {orders: this.orders, name: this.name, code: this.code, tel: this.tel}
      }).then((response) => {
      })
      .catch(error => {
        console.log(error);
        this.errored = true;
      })
      .finally(() => (
        this.orders = [],
        this.isReverse = true
      ));
    },
  }

}
</script>
