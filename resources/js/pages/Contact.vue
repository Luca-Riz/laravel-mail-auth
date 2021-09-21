<template>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Contatti</h1>
                <div v-if="success" class="alert alert-success">
                    Messaggio inviato
                </div>
                <form @submit.prevent="sendForm">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome</label>
                        <input v-model="name" type="text" name="name" class="form-control" id="nome">
                        <p v-for="(error, index) in errors.name" :key="index">
                            {{ error }}
                        </p>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input v-model="email" type="email" class="form-control" id="email" name="email">
                         <p v-for="(error, index) in errors.email" :key="index">
                            {{ error }}
                        </p>
                    </div>
                    <div class="mb-3">
                        <label for="msg" class="form-label">Messaggio</label>
                        <textarea v-model="message" name="message" id="msg" cols="30" rows="10" class="form-control"></textarea>
                        <p v-for="(error, index) in errors.message" :key="index">
                            {{ error }}
                        </p>
                    </div>
                    <button type="submit" class="btn btn-primary"> {{ sending ? 'invio in corso' : 'invia'}}</button>
                </form>
            </div>
        </div>
    </div>    
</template>

<script>
export default {
    name: "Contact",
    data() {
        return {
            name: '',
            email: '',
            message: '',
            errors: {},
            sending: false,
            success: false
        }
    },
    methods: {
        sendForm() {
            this.sending = true;
            this.success = false;
            axios.post('/api/contacts', {
                'name': this.name,
                'email': this.email,
                'message': this.message
            })
                .then(response => {
                   if(!response.data.success){
                       this.errors = response.data.errors;
                    //    console.log(this.errors);
                       this.success = false;
                   } else {
                    this.success = true,
                    // console.log(response);
                    this.sending = false;
                    this.name ='',
                    this.email='',
                    this.message = ''
                   }
                })
                .catch(error =>{
                    console.log(error);
                });

        }
    }
}
</script>

<style lang="scss">

</style>