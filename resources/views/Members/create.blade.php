<x-layout.app>
        <style>
          .iti {
            width: 100%;
          }
        </style>
        <main id="app" class="h-full pb-16 overflow-y-auto">
          <!-- Remove everything INSIDE this div to a really blank page -->
          <div class="container px-6 mx-auto grid">
            <h2
              class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
            >
              Create Member
            </h2>
            <div v-show="current_step === 1" class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
              <h5 style="margin-bottom: 20px;" class="dark:text-gray-200">Personal Information</h5>
              <div style="display: flex; column-gap: 20px;">
                <div style="width: 33.33%;">
                  <label class="block text-sm" style="margin-bottom: 20px;">
                    <span class="text-gray-700 dark:text-gray-400">Member's name</span>
                    <input v-model="member_name" data-message="member_field_message" class="step_1 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="shahmir ahsanullah">
                    <span style="display: none;" class="member_field_message text-xs text-red-600 dark:text-red-400">
                      Member's field is required
                    </span>
                  </label>
                </div>
                <div style="width: 33.33%;">
                  <label class="block text-sm" style="margin-bottom: 20px;">
                    <span class="text-gray-700 dark:text-gray-400">Date of Birth</span>
                    <input v-model="date_of_birth" data-message="date_of_birth_field_message" type="date" class="step_1 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="shahmir ahsanullah">
                    <span style="display: none;" class="date_of_birth_field_message step_1_message text-xs text-red-600 dark:text-red-400">
                      Date of Birth field is required
                    </span>
                  </label>
                </div>
                <div style="width: 33.33%;">
                  <label class="block text-sm" style="margin-bottom: 20px;">
                    <span class="text-gray-700 dark:text-gray-400">CNIC/Passport</span>
                    <input v-model="cnic" data-message="cnic_field_message" class="step_1 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="XXXX-XXXXXXX-X">
                    <span style="display: none;" class="cnic_field_message step_1_message text-xs text-red-600 dark:text-red-400">
                      CNIC/Passport field is required
                    </span>
                  </label>
                </div>
              </div>
              <div style="display: flex; column-gap: 20px;">
                <div style="width: 50%;">
                  <label class="block text-sm" style="margin-bottom: 20px;">
                    <span class="text-gray-700 dark:text-gray-400">Gender</span>
                    <select v-model="gender" data-message="gender_field_message" class="step_1 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input">
                      <option value="male">Male</option>
                      <option value="female">Female</option>
                    </select>
                    <span style="display: none;" class="gender_field_message step_1_message text-xs text-red-600 dark:text-red-400">
                      Gender field is required
                    </span>
                  </label>
                </div>
                <div style="width: 50%;">
                  <label class="block text-sm" style="margin-bottom: 20px;">
                    <span class="text-gray-700 dark:text-gray-400">Marital Status</span>
                    <select v-model="marital_status" data-message="marital_field_message" class="step_1 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input">
                      <option value="single">Single</option>
                      <option value="married">Married</option>
                      <option value="divorced">Divorced</option>
                    </select>
                    <span style="display: none;" class="marital_field_message step_1_message text-xs text-red-600 dark:text-red-400">
                      Marital field is required
                    </span>
                  </label>
                </div>
              </div>
              <div style="display: flex; justify-content: center;">
                <div v-for="step in total_steps" class="step bg-purple-600" :style="{ 'background': step <= current_step ? '' : 'gray' }" style="width: 5px; height: 5px; border-radius: 100%; margin-right: 5px;">&nbsp;</div>
              </div>
            </div>
            <div v-show="current_step === 2" class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
              <h5 style="margin-bottom: 20px;" class="dark:text-gray-200">Contact Details</h5>
              <div style="display: flex; column-gap: 20px;">
                <div style="width: 33.33%;">
                  <label class="block text-sm" style="margin-bottom: 20px;">
                    <span class="text-gray-700 dark:text-gray-400" style="margin-bottom: 20px;">Phone</span>
                    <br>
                    <input style="width: 100% !important; margin-top: 4px !important;" v-model="phone" data-message="phone_field_message" class="phone step_2 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Phone Number">
                    <span style="display: none;" class="phone_field_message text-xs text-red-600 dark:text-red-400">
                      Phone number field is required
                    </span>
                  </label>
                </div>
                <div style="width: 33.33%;">
                  <label class="block text-sm" style="margin-bottom: 20px;">
                    <span class="text-gray-700 dark:text-gray-400">Alternate Phone Number</span>
                    <input v-model="alt_phone_number" style="width: 100% !important; margin-top: 4px !important;" id="alt_phone_number" data-message="alt_ph_number_field_message" type="text" class="phone step_2 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Alternate Phone Number">
                    <span style="display: none;" class="alt_ph_number_field_message step_1_message text-xs text-red-600 dark:text-red-400">
                      Alternate Phone Number field is required
                    </span>
                  </label>
                </div>
                <div style="width: 33.33%;">
                  <label class="block text-sm" style="margin-bottom: 20px;">
                    <span class="text-gray-700 dark:text-gray-400">Email</span>
                    <input v-model="email" type="email" style="width: 100% !important; margin-top: 4px !important;" data-message="email_message" class="step_2 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="example@example.com">
                    <span style="display: none;" class="email_message step_1_message text-xs text-red-600 dark:text-red-400">
                      Email field is required
                    </span>
                  </label>
                </div>
              </div>
              <div style="display: flex; column-gap: 20px;">
                <div style="width: 50%;">
                  <label class="block text-sm" style="margin-bottom: 20px;">
                    <span class="text-gray-700 dark:text-gray-400">Residential Address</span>
                    <input v-model="residential_address" type="text" style="width: 100% !important; margin-top: 4px !important;" data-message="residential_address_message" class="step_2 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Residential Address">
                    <span style="display: none;" class="residential_address_message step_2_message text-xs text-red-600 dark:text-red-400">
                      Residential Address field is required
                    </span>
                  </label>
                </div>
                <div style="width: 50%;">
                  <label class="block text-sm" style="margin-bottom: 20px;">
                    <span class="text-gray-700 dark:text-gray-400">City/Country</span>
                    <input v-model="city_country" type="text" style="width: 100% !important; margin-top: 4px !important;" data-message="city_country_message" class="step_2 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Residential Address">
                    <span style="display: none;" class="city_country_message step_1_message text-xs text-red-600 dark:text-red-400">
                      City/Country field is required
                    </span>
                  </label>
                </div>
              </div>
              <div style="display: flex; justify-content: center;">
                <div v-for="step in total_steps" class="step bg-purple-600" :style="{ 'background': step <= current_step ? '' : 'gray' }" style="width: 5px; height: 5px; border-radius: 100%; margin-right: 5px;">&nbsp;</div>
              </div>
            </div>
            <div v-show="current_step === 3" class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
              <h5 style="margin-bottom: 20px;" class="dark:text-gray-200">Membership Details</h5>
              <div style="display: flex; column-gap: 20px;">
                <div style="width: 33.33%;">
                  <label class="block text-sm" style="margin-bottom: 20px;">
                    <span class="text-gray-700 dark:text-gray-400">Membership Type</span>
                    <select v-model="membership_type" data-message="membership_type_field_message" class="step_3 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input">
                      <option value="permanent">Permanent</option>
                      <option value="permanent+">Permanent+</option>
                      <option value="founder">Founder</option>
                      <option value="corporate-applicant">Corporate Applicant</option>
                      <option value="permanent se">Permanent SE</option>
                      <option value="temporary">Temporary</option>
                    </select>
                    <span style="display: none;" class="membership_type_field_message step_3_message text-xs text-red-600 dark:text-red-400">
                      Membership Type is required
                    </span>
                  </label>
                </div>
                <div style="width: 33.33%;">
                  <label class="block text-sm" style="margin-bottom: 20px;">
                    <span class="text-gray-700 dark:text-gray-400">Card Type</span>
                    <select v-model="card_type" data-message="membership_type_field_message" class="step_3 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input">
                      <option value="Provisional Membership">Provisional Membership</option>
                      <option value="Cleared">Cleared</option>
                    </select>
                    <span style="display: none;" class="member_number_message step_1_message text-xs text-red-600 dark:text-red-400">
                      Card Type field is required
                    </span>
                  </label>
                </div>
                <div style="width: 33.33%;">
                  <label class="block text-sm" style="margin-bottom: 20px;">
                    <span class="text-gray-700 dark:text-gray-400">File Number</span>
                    <input v-model="file_number" type="text" style="width: 100% !important; margin-top: 4px !important;" data-message="email_message" class="step_3 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="File Number">
                    <span style="display: none;" class="email_message step_1_message text-xs text-red-600 dark:text-red-400">
                      File Number field is required
                    </span>
                  </label>
                </div>
              </div>
              <div style="display: flex; column-gap: 20px;">
                <div style="width: 50%;">
                  <label class="block text-sm" style="margin-bottom: 20px;">
                    <span class="text-gray-700 dark:text-gray-400">Date of Applying</span>
                    <input v-model="date_of_applying" type="date" style="width: 100% !important; margin-top: 4px !important;" data-message="date_of_applying_message" class="step_3 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Residential Address">
                    <span style="display: none;" class="date_of_applying_message step_1_message text-xs text-red-600 dark:text-red-400">
                      Date of Applying field is required
                    </span>
                  </label>
                </div>
                <div style="width: 50%;">
                  <label class="block text-sm" style="margin-bottom: 20px;">
                    <span class="text-gray-700 dark:text-gray-400">Membership Number</span>
                    <input v-model="membership_number" type="text" style="width: 100% !important; margin-top: 4px !important;" data-message="membership_number_message" class="step_3 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Membership Number">
                    <span style="display: none;" class="membership_number_message step_1_message text-xs text-red-600 dark:text-red-400">
                      Membership Number field is required
                    </span>
                  </label>
                </div>
              </div>
              <div style="display: flex; justify-content: center;">
                <div v-for="step in total_steps" class="step bg-purple-600" :style="{ 'background': step <= current_step ? '' : 'gray' }" style="width: 5px; height: 5px; border-radius: 100%; margin-right: 5px;">&nbsp;</div>
              </div>
            </div>
            <div style="display: flex; column-gap: 10px;">
              <button @click="previous" :disabled="current_step < 2" style="background: #1f2937;" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-700 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                Previous
              </button>
              <button @click="next" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                Next
              </button>
            </div>
          </div>
          
        </main>
        <script>
          const app = Vue.createApp({
            data() {
              return {
                current_step: 1,
                total_steps: 4,

                member_name: "",
                date_of_birth: "",
                cnic: "",
                gender: "male",
                marital_status: "married",

                phone: "",
                alt_phone_number: "",
                email: "",
                residential_address: "",
                city_country: "",

                membership_type: "permanent",
                membership_number: "",
                card_type: "Provisional Membership",
                file_number: "",
                date_of_applying: ""
              }
            },
            methods: {
              validate_inputs() {
                const inputs = document.querySelectorAll(`.step_${this.current_step}:not(.optional)`);
                console.log(inputs);
                let doesntHaveErrors = true;

                inputs.forEach(input => {
                  const message = document.querySelector(`.${input.dataset.message}`);
                  
                  if(!input.value) {
                    message.style.display = "block";
                    input.classList.add("block", "w-full", "mt-1", "text-sm", "border-red-600", "dark:text-gray-300", "dark:bg-gray-700", "focus:border-red-400", "focus:outline-none", "focus:shadow-outline-red", "form-input");
                    doesntHaveErrors = false;
                  } else {
                    input.classList.remove("border-red-600");
                    message.style.display = "none";
                  }
                });

                return doesntHaveErrors;
              },
              next() {
                if(!this.validate_inputs()) return;
                this.current_step++;
              },
              previous() {
                this.current_step--;
              }
            },
            mounted() {
              const input = document.querySelector("#phone");
              const inputs = document.querySelectorAll(".phone");

              inputs.forEach(input => {
                const iti = window.intlTelInput(input, {
                  loadUtils: () => import("https://cdn.jsdelivr.net/npm/intl-tel-input@25.3.1/build/js/utils.js"),
                });
              });

                const phones = document.querySelectorAll(".phone")
                
                const updatePhoneNumber = () => {
                  // const countryData = iti.getSelectedCountryData();
                  // const country_code = document.getElementById("country_code");
                  // const phone_number = document.getElementById("phone_number");
                  // country_code.value = countryData.dialCode;
                  // phone_number.value = iti.getNumber().replace(/^\+/, '');
                }

                inputs.forEach(input => {
                  input.addEventListener("countrychange", function () {
                      updatePhoneNumber();
                  });
                });
                
                phones.forEach(phone => {
                  phone.addEventListener("input", function() {
                      updatePhoneNumber();
                  })
                })
            }
          }).mount("#app");
        </script>
</x-layout.app>

