<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        <h4>Tambah Data Product</h4>
                        <hr>

                        <form @submit.prevent="store">
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
                            <br />
                            <button type="submit" class="btn btn-primary">SIMPAN</button>
                        </form>                        

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import { reactive, ref } from 'vue'
import { useRouter } from 'vue-router'
import axios from 'axios'
export default {
    name: 'CreatePost',

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

        //method store
        function store() {

            let name   = post.name
            let price = post.price
            let final_price = post.final_price

            axios.post('http://localhost:8000/api/product', {
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
            store
        }
    }

}
</script>