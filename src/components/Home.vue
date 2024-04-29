<template>
  <h1>Bem vindo ao MyPage</h1>
  <h3>
    Projeto de portfólio de <a href="https://github.com/luciobrito">github</a>
  </h3>
  <div class="card-container">
    <v-card title="O que é o mypage?" class="card"
      ><p>Serve como uma aplicação web para fins de portfólio e aprendizado. Foi
      feita usando uma API Rest em Laravel e Front com VueJS e vuetify.</p></v-card
    >
    <v-card title="Sobre" class="card"
      >
      <p>MyPage é uma rede social parecida com Twitter e Facebook</p></v-card
    >
  </div>
</template>

<style lang="scss">
h1, h3 {
  text-align: center;
}
.card-container {
  margin: 0px;
  display: flex;
  flex-direction: row;
  flex-wrap: nowrap;
}
.card{
  margin:10px;
  width: 50%;
  flex: 25%;
  p{
    padding: 0px 15px 10px 15px
  }
}
@media screen and (max-width: 600px){
  .card-container{
    flex-direction: column;
  }
  .card{
    width:100%
  }
}
</style>
<script></script>
