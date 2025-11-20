<x-layout.app>

    <style>
        .iti {
            width: 100%;
        }
    </style>
    <main class="h-full pb-16" id="app" style="overflow: scroll;">
        <div class="container px-6 mx-auto grid">
            <h2 class="mt-6 mb-3 text-2xl font-semibold text-gray-700 dark:text-gray-200">Create Re-Eligibility Link</h2>
            <form @submit.prevent="submit">
                <div class="step-form px-4 py-4 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                    <div style="display: flex; column-gap: 20px;">
                        <!-- Lead Name -->
                        <div style="width: 50%;">
                            <label class="block text-sm" style="margin-bottom: 20px;">
                                <span class="text-gray-700 dark:text-gray-400">Lead Name</span>
                                <input data-message="name_field_message"
                                    class="step_1 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700
                                    focus:border-purple-400 focus:outline-none focus:shadow-outline-purple
                                    dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                    v-model="formData.name">
                                <span class="text-xs text-red-600 dark:text-red-400" v-if="errors.lead_name">
                                    @{{ errors.lead_name[0] }}
                                </span>
                            </label>
                        </div>

                        <!-- Phone Number -->
                        <div style="width: 50%;">
                            <label class="block text-sm" style="margin-bottom: 20px;">
                                <span class="text-gray-700 dark:text-gray-400" style="margin-bottom: 20px;">Phone Number</span>
                                <br>
                                <input type="hidden" v-model="formData.countryCode" />
                                <input type="hidden" v-model="formData.phoneNumber" />
                                <input style="width: 100% !important; margin-top: 4px !important;" data-index="0"
                                    data-message="phone_field_message"
                                    class="phone block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input">
                                <span class="text-xs text-red-600 dark:text-red-400" v-if="errors.phone_number">
                                    @{{ errors.phone_number[0] }}
                                </span>
                            </label>
                        </div>
                    </div>
                    <button
                        class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        Submit
                    </button>
                </div>
            </form>

    </main>


    <script>
        const app = Vue.createApp({
            data() {
                return {
                    formData: {
                        name: "",
                        countryCode: "",
                        phoneNumber: "",
                    },
                    errors: {}
                }
            },
            mounted() {
                this.putCountryCodes();
                // console.log(this.phone);
            },
            methods: {
                debounce(func, delay = 300) {
                    let timeoutId;
                    return function(...args) {
                        const context = this;
                        clearTimeout(timeoutId);
                        timeoutId = setTimeout(() => {
                            func.apply(context, args);
                        }, delay);
                    };
                },
                async putCountryCodes() {
                    const inputs = document.querySelectorAll(".phone");

                    inputs.forEach(input => {
                        const iti = window.intlTelInput(input, {
                            initialCountry: "PK",
                            loadUtils: () => import(
                                "https://cdn.jsdelivr.net/npm/intl-tel-input@25.3.1/build/js/utils.js"
                            ),
                        });

                        input.addEventListener("countrychange", () => updatePhoneNumber(iti, input));
                        input.addEventListener("input", () => updatePhoneNumber(iti, input));
                    });

                    const updatePhoneNumber = (iti, input) => {
                        const countryData = iti.getSelectedCountryData();
                        // Handle main phone numbers
                        this.formData["countryCode"] = countryData.dialCode;
                        this.formData["phoneNumber"] = iti.getNumber().replace(/^\+/, '');
                    };
                },
                async submit() {
                    try {
                        const response = await axios.post(route("api.lead.store"), {
                            lead_name: this.formData.name,
                            county_code: this.formData.countryCode,
                            phone_number: this.formData.phoneNumber,
                        });

                        this.errors = {};

                        if (response.data.status === "200") {
                            window.location = route("leads");
                        }

                    } catch (err) {
                        if (err.response?.data?.errors) {
                            this.errors = err.response.data.errors;
                        } else {
                            console.error("Server error:", err);
                        }
                    }
                }
            },
        }).mount("#app");
    </script>
</x-layout.app>
