<template>
    <div class="container">
        <div class="row">
            <h3 class="center">Contact Us</h3>
            <errors :content="errors"></errors>
            <form @submit.prevent="formSubmit">
                <div class="form-group">
                    <label for="title">Title *</label>
                    <input type="text" id="title" name="title" class="form-control" placeholder="Enter Your Title" v-model="contact.title"/>
                </div>
                <div class="form-group">
                    <label for="message">Message *</label>
                    <textarea id="message" name="message" class="form-control" placeholder="Enter Your Message" v-model="contact.message"></textarea>
                </div>
                <div class="form-group">
                    <div class="g-recaptcha" data-sitekey="6LdLzTsUAAAAABIspvbhxdVDVM3GLLKluMQpXwC-"></div>
                </div>
                <div class="form-group">
                    <div class="submit">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import Errors from '../components/Errors';

    export default {
        components: {
            Errors,
        },

        data() {
            return {
                contact: {
                    title: '',
                    message: ''
                },
                errors: []
            }
        },

        methods: {
            formSubmit() {
                axios.post('contact', {
                    user: this.$store.getters.getAuth.name,
                    email: this.$store.getters.getAuth.email,
                    title: this.contact.title,
                    message: this.contact.message,
                    recaptcha: grecaptcha.getResponse(),
                })
                    .then(() => {
                        this.contact.title = '';
                        this.contact.message = '';
                        grecaptcha.reset();
                    })
                    .catch((error) => {
                        this.errors = [];

                        console.log(error.response.data.errors);

                        if (error.response.data.errors.title) {
                            Array.prototype.push.apply(this.errors, error.response.data.errors.title);
                        }

                        if (error.response.data.errors.message) {
                            Array.prototype.push.apply(this.errors, error.response.data.errors.message);
                        }

                        if (error.response.data.errors.recaptcha) {
                            Array.prototype.push.apply(this.errors, error.response.data.errors.recaptcha);
                        }
                    });
            }
        }
    }
</script>