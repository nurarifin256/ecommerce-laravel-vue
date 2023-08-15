<script setup>
import { ref } from "vue";
import api from "../../api";

const initialState = {
    firstname: "",
    lastname: "",
};

// cara pertama
// const formData = ref(initialState);

// function reset() {
//     formData.value.firstname = ""
//     formData.value.lastname = ""
// }

// cara kedua
const formData = ref({ ...initialState });


function reset() {
    // cara ini juga bisa
    // Object.assign(formData.value, initialState);

    // cara ini juga bisa
    formData.value = initialState
}

const save = async () => {
    const response = await api.post("/api/people/save", formData.value)
    console.log(response);
};
</script>
<template>
    <div class="container">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary mt-5" data-toggle="modal" data-target="#exampleModal">
            Launch demo modal
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="reset">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="row">
                                <div class="col">
                                    <input type="text" class="form-control" v-model="formData.firstname"
                                        placeholder="First name">
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" v-model="formData.lastname"
                                        placeholder="Last name">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="reset">Close</button>
                        <button type="button" class="btn btn-primary" @click="save">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>