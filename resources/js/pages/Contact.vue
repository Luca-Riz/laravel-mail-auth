<template>
  <div class="container">
    <div class="row">
      <div class="col">
        <h3>Contatti</h3>
        <form>
          <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" name="name" class="form-control" id="nome">
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" name="email">
          </div>
          <div class="mb-3">
            <label for="msg" class="form-label">Messaggio</label>
            <textarea name="message" id="msg" cols="30" rows="10" class="form-control"></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Contact"
}
</script>

<style lang="scss" scoped>

</style>