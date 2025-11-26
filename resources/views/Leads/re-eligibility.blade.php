<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Re-Eligibility Form</title>
    <link rel="stylesheet" href="{{ asset('/assets/css/tailwind.output.css') }}" />
    <script src="{{ asset('/assets/js/init-alpine.js') }}"></script>
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

</head>

<body>
    <style>
        .loader {
            width: 20px;
            height: 20px;
            border: 5px solid #FFF;
            border-bottom-color: transparent;
            border-radius: 50%;
            display: inline-block;
            box-sizing: border-box;
            animation: rotation 1s linear infinite;
        }

        .loader.big {
            width: 40px;
            height: 40px;
        }

        .loader.purple {
            border: 5px solid #7e3af2;
            border-bottom-color: transparent;
        }
    </style>
    <div id="app" class="min-h-screen flex items-center justify-center bg-gray-100 p-6">
        <template v-if="expiresIn === null">
            <span class="text-center loader big purple"></span>
        </template>
        <template v-else-if="!submitted">
            <div class="w-full max-w-xl bg-white px-8 rounded-lg shadow-md" style="padding: 0px 50px 50px 50px;">
                <div class="w-full text-center" style="margin: 15px 0px;" v-if="expiresIn">
                    <p class="font-semibold text-black">
                        You have
                        <span class="text-red-600 font-semibold" v-text="expiresIn"></span>
                        before this form expires.
                    </p>
                </div>
                <h1 class="text-2xl font-bold text-black">Priority Re-Eligibility Form</h1>
                <div class="flex justify-between items-center mb-6">
                </div>
                <!-- Vue Form -->
                <form @submit.prevent="submitForm" class="space-y-4 text-black">
                    <!-- Auto-filled fields -->
                    <div>
                        <label class="block font-semibold mb-1">Your Name:</label>
                        <input type="text" v-model="form.name" readonly
                            class="w-full border border-gray-300 rounded px-3 py-2 text-black bg-white">
                    </div>
                    <div>
                        <label class="block font-semibold mb-1">Your Number:</label>
                        <input type="text" v-model="form.number" readonly
                            class="w-full border border-gray-300 rounded px-3 py-2 text-black bg-white">
                    </div>

                    <!-- Question 1 -->
                    <div>
                        <label class="block font-semibold mb-1">1. What was the main reason for not purchasing the
                            membership?</label>
                        <select v-model="form.reason"
                            class="w-full border border-gray-300 rounded px-3 py-2 text-black bg-white">
                            <option disabled value="">Select a reason</option>
                            <option>Financial reason</option>
                            <option>The reciprocal club I need is not yet available</option>
                            <option>Waiting for the club to become fully operational</option>
                        </select>
                    </div>

                    <!-- Question 2 -->
                    <div>
                        <label class="block font-semibold mb-1">2. When should we contact you again?</label>
                        <select v-model="form.contact_time"
                            class="w-full border border-gray-300 rounded px-3 py-2 text-black bg-white">
                            <option disabled value="">Select timeframe</option>
                            <option>After 1 month</option>
                            <option>After 3 months</option>
                            <option>After 6 months</option>
                            <option>After 1 year</option>
                        </select>
                    </div>

                    <!-- Terms -->
                    <div class="text-sm text-black">
                        <input type="checkbox" v-model="form.agree" id="terms">
                        <label for="terms">
                            I understand that membership fees will increase over time. If I choose to purchase
                            later, I
                            agree to pay the updated fee applicable at that time.
                        </label>
                    </div>

                    <!-- Submit -->
                    <div>
                        <button type="submit" :disabled="is_submitting"
                            class="w-full bg-black text-white font-semibold px-4 py-2 rounded hover:bg-gray-800 transition">
                            <span v-if="is_submitting">Submitting...</span>
                            <span v-else>Submit</span>
                        </button>
                    </div>
                </form>
            </div>
        </template>
        <template v-else>
            <!-- Success message -->
            <div class="w-full max-w-xl bg-white px-8 rounded-lg shadow-md" style="padding: 0px 50px 50px 50px;">
                <div class="text-center py-20">
                    <h1 class="text-2xl font-bold mb-4 text-black">Form Submitted Successfully!</h1>
                    <p class="text-black">Thank you, your response has been recorded. Our team will get back to you if
                        required.</p>
                </div>
            </div>
        </template>
    </div>
    @routes
    <script>
        const app = Vue.createApp({
            data() {
                return {
                    form: {
                        name: '{{ ucfirst($link->lead_name) ?? '' }}',
                        number: '{{ $link->phone_number ?? '' }}',
                        reason: '',
                        contact_time: '',
                        agree: false,
                    },
                    linkId: '{{ $link->id ?? '' }}',
                    submitted: false,
                    is_submitting: false,

                    expiresIn: null, // countdown
                    expiresAt: '{{ $link->expires_at ? $link->expires_at->format('Y-m-d\\TH:i:s\\Z') : '' }}',
                    timer: null
                }
            },
            mounted() {
                this.startCountdown();
            },
            methods: {
                startCountdown() {
                    if (!this.expiresAt) return;

                    const endTime = new Date(this.expiresAt).getTime();

                    this.timer = setInterval(() => {
                        const now = new Date().getTime();
                        const distance = endTime - now;

                        if (distance <= 0) {
                            clearInterval(this.timer);
                            location.reload();
                            return;
                        }

                        const hours = Math.floor(distance / (1000 * 60 * 60));
                        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                        this.expiresIn = `${hours}h ${minutes}m ${seconds}s`;
                    }, 1000);
                },
                submitForm() {
                    if (!this.form.reason || !this.form.contact_time || !this.form.agree) {
                        Swal.fire({
                            title: "Please fill all fields and agree to the terms.",
                            confirmButtonText: "OK",
                        });
                        return;
                    }

                    this.is_submitting = true;

                    // Send data to backend (axios example)
                    axios.post('https://www.privyr.com/api/v1/incoming-leads/0vZfjMQw/9lyI47FM#generic-webhook', {
                            name: this.form.name,
                            phone: this.form.number,
                            display_name: this.form.name,
                            other_fields: {
                                reason: this.form.reason,
                                contact_time: this.form.contact_time,
                            },
                        })
                        .then(res => {
                            // Mark link as used in our backend
                            axios.put(route('api.lead.used', this.linkId))
                                .then(() => {
                                    this.is_submitting = false;
                                    this.submitted = true; // show submitted message
                                })
                                .catch(err => console.error(err));
                        })
                        .catch(err => {
                            console.error(err);
                            alert('There was an error submitting the form.');

                        });
                }
            }
        });
        app.mount('#app');
    </script>
</body>

</html>
