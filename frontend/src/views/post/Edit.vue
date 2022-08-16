<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        <h4>Edit Data Product</h4>
                        <hr>

                        <form @submit.prevent="update">
                            <div class="form-group">
                                <label for="name" class="font-weight-bold">Nama Product</label>
                                <input type="text" class="form-control" v-model="post.name" placeholder="Masukkan Nama Product">
                                <!-- validation -->
                                <div v-if="validation.name" class="mt-2 alert alert-danger">
                                    {{ validation.name[0] }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="price" class="font-weight-bold">Harga</label>
                                <input type="text" class="form-control" v-model="post.price" placeholder="Masukkan Harga Product">
                                <!-- validation -->
                                <div v-if="validation.price" class="mt-2 alert alert-danger">
                                    {{ validation.price[0] }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="final_price" class="font-weight-bold">Harga</label>
                                <input type="text" class="form-control" v-model="post.final_price" placeholder="Masukkan Harga Final Product">
                                <!-- validation -->
                                <div v-if="validation.final_price" class="mt-2 alert alert-danger">
                                    {{ validation.final_price[0] }}
                                </div>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary">SIMPAN</button>
                        </form>                        

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { reactive, ref, onMounted } from 'vue'
import { useRouter, useRoute } from 'vue-router'
import axios from 'axios'

export default {
    name: 'EditPost',

    setup() {

        //state posts
        const post = reactive({
            name: '',
            price: '',
            final_price: ''
        })

        //state validation
        const validation = ref([])

        //vue router
        const router = useRouter()

        //vue router
        const route = useRoute()

        //mounted
        onMounted(() => {

            //get API from Laravel Backend
            axios.get(`http://localhost:8000/api/product/${route.params.id}`)
            .then(response => {
              
              //assign state posts with response data
              post.name    = response.data.data.name  
              post.price  = response.data.data.price
              post.final_price  = response.data.data.final_price  

            }).catch(error => {
                console.log(error.response.data)
            })

        })

        //method update
        function update() {

            let name   = post.name
            let price = post.price
            let final_price = post.final_price

            axios.put(`http://localhost:8000/api/product/${route.params.id}`, {
                name: name,
                price: price,
                final_price: final_price
            }).then(() => {

                //redirect ke post index
                router.push({
                    name: 'post.index'
                })

            }).catch(error => {
                //assign state validation with error 
                validation.value = error.response.data
            })

        }

        //return
        return {
            post,
            validation,
            router,
            update
        }

    }
}
</script>

<style>
    body{
        background: lightgray;
    }
</style>